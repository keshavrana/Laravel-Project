<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\LoginLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|unique:registers',
            'user_name' => 'required',
            'password' => 'required'
        ]);
        $register = new Register;
        $register->email = $request->email;
        $register->user_name = $request->user_name;
        $register->password = Hash::make($request->password);
        $result = $register->save();
        if ($result) {
            return redirect('/login');
        } else {
            return redirect('/');
        }
    }

    public function loginView()
    {
        return view('login');
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function github()
    {
        return Socialite::driver('github')->redirect();
    }
    public function githubRedirect()
    {
        $user_info = Socialite::driver('github')->user();
        $user = Register::firstOrCreate([
            'email' => $user_info->email
        ], [
            'user_name' => $user_info->name,
            'password' => Hash::make($user_info->name),

        ]);
        return redirect('/userdashboard');
    }


    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect()
    {
        $user_info = Socialite::driver('google')->user();
        $user = Register::firstOrCreate([
            'email' => $user_info->email
        ], [
            'user_name' => $user_info->name,
            'password' => Hash::make($user_info->name),
        ]);
        return redirect('/userdashboard');
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required'
            // 'captcha' => 'required|captcha'
        ]);
        $ip = $request->getClientIp();
        $email = $request->email;
        //Check Time;
        $check = LoginLog::where(['ip'=>$ip,'email'=>$email])->get();
        if(count($check) == 3){
        $total_attempt = LoginLog::where(['ip'=>$ip,'email'=>$email])->orderBy('created_at','desc')->first();
        $last_time = date('Y-m-d H:s:i',strtotime($total_attempt->created_at));

        $now_time = date('Y-m-d H:s:i',strtotime(Carbon::now()));

        $to = Carbon::createFromFormat('Y-m-d H:s:i', $last_time);
        $from = Carbon::createFromFormat('Y-m-d H:s:i', $now_time);
  
        $diff_in_hours = $to->diffInMinutes($from);

        //dd($diff_in_hours);
        if($diff_in_hours >= 3){
            $total_attempt = LoginLog::where(['ip'=>$ip,'email'=>$email])->get();
            $count = count($total_attempt);
            for ($i=0; $i < $count ; $i++) { 
                $total_attempt = LoginLog::where(['ip'=>$ip,'email'=>$email])->delete();
            }
            return redirect()->back()->with('success', 'Your Account Has Been UnBlocked Now');
        }
        else{
            $wait = 3 - $diff_in_hours;
            return redirect()->back()->with('message', 'Your Account Bloked Kindly Wait For '.$wait.' Minute ');
        }

    }
               
      






       
        $password = Register::where('email', $email)->first();
        if (Hash::check($request->password, $password->password)) {
            $total_attempt = LoginLog::where(['ip'=>$ip,'email'=>$email])->get();
            $count = count($total_attempt);
            if($count == 3){
                return redirect()->back()->with('message', 'Your Account Bloked Kindly Wait');
            }else{
                for ($i=0; $i < $count ; $i++) { 
                    $total_attempt = LoginLog::where(['ip'=>$ip,'email'=>$email])->delete();
                }
                return redirect('/userdashboard');
            }
           
        } else {
          
            $total_attempt = LoginLog::where(['ip'=>$ip,'email'=>$email])->get();
            $count = count($total_attempt);
            if($count >= 3){
                return redirect()->back()->with('message', 'Your Account Has Been Blocked');
            }
            else{
                $log = new LoginLog;
                $log->status = 'failed';
                $log->logtime = Carbon::now();
                $log->ip = $ip;
                $log->email = $email;
                $log->save();
                $total_attempt = LoginLog::where(['ip'=>$ip,'email'=>$email])->get();
                $count = count($total_attempt);
                $left = 3 - $count;
                if($left == 0){
                    return redirect()->back()->with('message', 'Your Account Has Been Blocked');
                }
                return redirect()->back()->with('message', ''.$left.' Attempt Remaining!');
            }

            
        }
    }
}

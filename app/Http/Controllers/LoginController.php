<?php

namespace App\Http\Controllers;

use App\Models\Register;
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
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);
        $email = $request->email;
        $password = Register::where('email', $email)->first();
        if (Hash::check($request->password, $password->password)) {
            return redirect('/userdashboard');
        } else {
            return redirect()->back()->with('failed', 'Failed! Please Enter Valid Credential');
        }
    }
}

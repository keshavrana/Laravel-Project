<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request,$lang = null)
    {
        if($lang == 'hi' || $lang == 'en' || $lang == null){
            App::setLocale($lang);
            $request->session()->put('lang',$lang);
            return view('user.index');
        }
        else{
            $request->session()->forget('lang');
            return view('user.index');
        }
        
    }
    public function addUser()
    {
        $url = url('/addnewuser');
        $label = "Component User Form";
        $user = "";
        return view('user.adduser',compact('user','url','label'));
    }
    public function addnewuser(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);
        $new_user = new User;
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = $request->password;
        $result = $new_user->save();
        if($result){
            return redirect('/userlist');
        }
        else{
            dd("Kuch to gadbad hai daya");
        }
    }
    public function userlist(){
        $data = User::all();
        return view('user.userlist',compact('data'));
    }
    public function userEdit($id){
        $user = User::find($id);
        if(is_null($user)){
            return redirect('userlist');
        }
        else{
            $label = "Update Component User Form";
            $url = url('updateuser').'/'.$id;
            return view('user.adduser',compact('user','url','label'));

        }
    }
    public function updateUser(Request $request,$id){
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $new_user = User::find($id);
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $result = $new_user->update();
        if($result){
            return redirect('/userlist');
        }
        else{
            dd("Kuch to gadbad hai daya");
        }
    }

    public function collectiveform(){
        return view('user.collectiveform');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use App\User;
class LoginController extends Controller
{
    public function LoadFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function FacebookResponse()
    {
        $info = Socialite::driver('facebook')->user();
        //print_r($user);
        $user = new User();
        $user->name = $info->name;
        $user->username = $info->username;
        $user->password = '';
        $user->email = $info->email;
        $user->dp = $info->avatar;
        $user->type = 'Teacher';
        $user->status = 'Inactive';
        $save = $user->save();
        
        if($save){
            return view('Teacher.teacherDash');
        }else{
            return redirect()->route('user.login');
        }
        //
    }

}

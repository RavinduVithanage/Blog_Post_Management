<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function register(){
        return view("auth.register");
    }
    public function Userregister(Request $request){

        // validate the Request
      
        $validate = $request->validate([
            'name'=>['required','string','max:255'],
            'email'=>['required','string','unique:users'],
            'password'=>['required','string','confirmed',Password::defaults()],
        ]);

        //create  user

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        auth('')->login($user);

        return to_route('posts.index');
    }
}

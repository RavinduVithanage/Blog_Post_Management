<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserLoginController extends Controller
{
    public function loginUser(){
        return view("auth.login");
    }
    
    public function loggedUser(Request $request){

        $request->validate(
            [   
                'email' => 'required|email',
                'password' => 'required|min:8|string',
            ]
        );
        
       if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('posts.index')); // Correct usage
    } else {
            return back()->withErrors(['email'=> 'the provide candicate do not match record']);
        }    
        
    }
    public function logoutUser(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        
        return to_route('posts.index');
    }
    
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function frontLogin(){
        if(Auth::user()){
            return redirect('/');
        } else {
            return view('auth.front.login');
        }
    }

    public function frontLogout(){
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }
    
}

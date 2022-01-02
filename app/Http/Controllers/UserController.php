<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('sing-in');
    }
    public function store()
    {   
        $attributes = request()->validate([
            'name'=>'required|max:255|min:5',
            'email'=>'required|email|max:255|min:5|unique:users,email',
            'password'=>'required|max:255|min:6'
        ]);
        $attributes['password'] = bcrypt($attributes['password']);
        $user = User::create($attributes);
        auth()->login($user);
        return redirect()->intended('/');
    }
    public function authenticate()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' =>  'required',
        ]);

        if (auth()->attempt($credentials)) {

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}

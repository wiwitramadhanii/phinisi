<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function login_process(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $users = $request->only('email', 'password');

        if (Auth::attempt($users)) {
            return redirect()->route('admin.dashboard')->with('success', 'Successful login!');
        }
        return back()->withErrors(['login' => 'Incorrect email or password.'])->withInput($request->only('email'));
    }

    public function logout(){

        Auth::logout();
        return redirect()->route('login')->with('success', 'Successful logout!');
    }

    public function register(){
        return view('auth.register');
    }

    public function register_process(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $users['name'] = $request->name;
        $users['email'] = $request->email;
        $users['password'] = Hash::make($request->password);

        User::create($users);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Successful Register!');
        }
        return back()->withErrors(['register' => 'Incorrect email or password.'])->withInput($request->only('email'));
    }
}

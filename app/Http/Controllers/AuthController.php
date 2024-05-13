<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class AuthController extends Controller
{
    /**
     */
    public function index(){
        return view('auth.index');
    }

    /**
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|min:6',
            'password' => 'required|min:7',
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->has('remember'))) {
            return redirect()->route('dashboard');
        }else{
            return redirect('/')->withInput()->with('info','Invalid Credentials!');
        }
    }

    public function logout()
    {
        Auth::logout();
        
        return redirect('/')->with('info','Successfully logged out!');
    }


    public function show(){
        return view('auth.show');
    }
}

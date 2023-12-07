<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function postlogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ],[
            'email' => 'Email Harus Diisi',
            'email.email' => 'Format Email Salah',
            'password' => 'Password Harus Diisi',
            'password.min' => 'Password Harus Diisi Minimal 8 Karakter',
       ]);

        $infologin = [ 
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            if(auth()->user()->level == 1){
                return redirect('/admin/event');
            }
            else{
                Alert::error('Error', 'Username Atau Password Salah!');
                return redirect('/admin/site/login');
            }
        }else{
            Alert::error('Error', 'Username Atau Password Salah!');
            return redirect('/admin/site/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

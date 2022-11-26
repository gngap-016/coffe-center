<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //

    public function loginView()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $emailCheck = User::where('email', $request->email)->count();
        if ($emailCheck == 0) {
            return redirect()->back()->with('error', 'Alamat email salah');
        } else {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->intended(route('admin.account.index'))->with('success', 'Login berhasil');
            }
            return redirect()->back()->with('error', 'Kata sandi salah');
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('loginView')->with('success', 'Berhasil keluar');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function loginView()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        dd();
    }

    public function logout(Request $request)
    {
        dd();
    }

    public function changePassword(Request $request)
    {
        dd();
    }
}

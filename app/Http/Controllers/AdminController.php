<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        dd();
    }

    public function account()
    {
        return view('admin.account');
    }

    public function changePassword(Request $request)
    {
        dd();
    }
}

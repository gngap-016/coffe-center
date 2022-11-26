<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index()
    {
        return view('admin.setting');
    }

    public function store(Request $request)
    {
        dd();
    }
}

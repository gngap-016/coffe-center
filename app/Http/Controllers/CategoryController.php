<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('admin.category');
    }

    public function store(Request $request)
    {
        dd();
    }

    public function update(Request $request)
    {
        dd();
    }

    public function destroy(Request $request)
    {
        dd();
    }
}

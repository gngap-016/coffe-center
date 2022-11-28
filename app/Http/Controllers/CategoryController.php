<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::select('categories.*')->get();
        return view('admin.category', compact(['categories']));
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

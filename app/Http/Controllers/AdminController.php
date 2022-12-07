<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
        $user = User::select('users.*')->first();
        $total_category = Category::select('categories.*')->count();
        $total_product = Product::select('products.*')->count();
        return view('admin.account', compact(['user', 'total_category', 'total_product']));
    }

    public function changePassword(Request $request)
    {
        dd();
    }
}

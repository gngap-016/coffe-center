<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $coffee = Product::select('products.*', 'c.name as category_name')
            ->join('categories as c', 'c.id', 'products.category_id')
            ->where('products.status', 1)
            ->where('c.status', 1)
            ->where('raw', 0)
            ->paginate(5);

        $seeds = Product::select('products.*', 'c.name as category_name')
            ->join('categories as c', 'c.id', 'products.category_id')
            ->where('products.status', 1)
            ->where('c.status', 1)
            ->where('raw', 1)
            ->paginate(5);
        return view('user.landing', compact(['seeds', 'coffee']));
    }

    public function coffee()
    {
        $coffee = Product::select('products.*', 'c.name as category_name')
            ->join('categories as c', 'c.id', 'products.category_id')
            ->where('products.status', 1)
            ->where('c.status', 1)
            ->get();
        return view('user.coffee', compact(['coffee']));
    }

    public function cart()
    {
        return view('user.cart');
    }

    public function order()
    {
        dd();
    }

    public function more()
    {
        dd();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::select('products.*', 'c.name as category_name')
            ->join('categories as c', 'c.id', 'products.category_id')
            ->get();
        $categories = Category::select('categories.*')->get();
        return view('admin.product', compact(['products', 'categories']));
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

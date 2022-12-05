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

    public function addProduct(Request $req)
    {
        $product = new Product;
        $product->name = $req->product_name;
        $product->quantity = $req->product_quantity;
        $product->description = $req->product_description;
        $product->category_id = $req->category_id;
        $product->price = $req->product_price;
        $product->status = $req->product_status;
        // $product->thumbnail = $req->;
        // $product->banner = $req->;
        $product->raw = $req->product_raw;
        // dd($product);
        

        return redirect('/product');
    }

    public function update(Request $req, $id)
    {
        $product = Product::find($id);
        $product->name = $req->product_name;
        $product->quantity = $req->product_quantity;
        $product->description = $req->product_description;
        $product->category_id = $req->category_id;
        $product->price = $req->product_price;
        $product->status = $req->product_status;
        // $product->thumbnail = $req->;
        // $product->banner = $req->;
        $product->raw = $req->product_raw;
        // dd($product);
        $product->save();

        return redirect('/product');
    }

    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        return redirect('/product');
    }
}

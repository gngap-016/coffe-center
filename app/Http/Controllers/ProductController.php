<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;


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
        $product = $req->validate([
            'product_name' => 'required',
            'product_quantity' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_banner' => 'image|file|max:1024',
        ]);
        $product = new Product;
        $product->name = $req->product_name;
        $product->quantity = $req->product_quantity;
        $product->description = $req->product_description;
        $product->category_id = $req->category_id;
        $product->price = $req->product_price;
        $product->status = $req->product_status;

        if ($req->hasFile('product_banner')) {
            $filenamewithextension = $req->file('product_banner')->getClientOriginalName();

            $fileName = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            $extension = $req->file('product_banner')->getClientOriginalExtension();

            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            $req->file('product_banner')->storeAs('public/product_images', $fileNameToStore);
            $req->file('product_banner')->storeAs('public/product_images/thumbnail', $fileNameToStore);

            $thumbnailPath = public_path('storage/product_images/thumbnail/' . $fileNameToStore);
            $product_image = Image::make($thumbnailPath)->resize(220, 161);
            $product_image->save($thumbnailPath);

            $product->banner = '/' . $fileNameToStore;
            $product->thumbnail = '/' . $fileNameToStore;
        }


        $product->raw = $req->product_raw;
        // dd($product);
        $product->save();
        return redirect('/product');
    }

    public function update(Request $req, $id)
    {
        $product = $req->validate([
            'product_name' => 'required',
            'product_quantity' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_banner' => 'image|file|max:1024',
        ]);

        $product = Product::find($id);
        $product->name = $req->product_name;
        $product->quantity = $req->product_quantity;
        $product->description = $req->product_description;
        $product->category_id = $req->category_id;
        $product->price = $req->product_price;
        $product->status = $req->product_status;

        if ($req->hasFile('product_banner')) {

            if ($req->oldImage) {
                Storage::delete('public/product_images' . $req->oldImage);
                Storage::delete('public/product_images/thumbnail' . $req->oldImage);
            }
            // dd($req->oldImage);
            $filenamewithextension = $req->file('product_banner')->getClientOriginalName();

            $fileName = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            $extension = $req->file('product_banner')->getClientOriginalExtension();

            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            $req->file('product_banner')->storeAs('public/product_images', $fileNameToStore);
            $req->file('product_banner')->storeAs('public/product_images/thumbnail', $fileNameToStore);

            $thumbnailPath = public_path('storage/product_images/thumbnail/' . $fileNameToStore);
            $product_image = Image::make($thumbnailPath)->resize(220, 161);
            $product_image->save($thumbnailPath);
            // dd($product);
            $product->banner = '/' . $fileNameToStore;
            $product->thumbnail = '/' . $fileNameToStore;
        }

        $product->raw = $req->product_raw;
        $product->save();

        return redirect('/product');
    }

    public function destroy(Request $req, $id)
    {
        // dd($req->oldImage);
        if ($req->oldImage) {
            Storage::delete('public/product_images' . $req->oldImage);
            Storage::delete('public/product_images/thumbnail' . $req->oldImage);
        }
        $product = Product::find($id)->delete();
        return redirect('/product');
    }
}

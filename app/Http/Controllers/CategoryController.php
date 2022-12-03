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
        // return view('admin.category')->with([
        //     'categories' => Category::all(),
        // ]);
    }


    public function addCategory(Request $request)
    {
        $categories = new Category;
        $categories->name = $request->category_name;
        $categories->status = $request->category_status;
        $categories->save();

        return redirect('/category');
    }

    public function update(Request $request, $id)
    {
        $categories = Category::find($id);
        $categories->name = $request->category_name;
        $categories->status = $request->category_status;
        $categories->save();

        return redirect('/category');
    }

    public function destroy($id)
    {
        $categories = Category::find($id)->delete();
        return redirect('/category');
        
    }
}

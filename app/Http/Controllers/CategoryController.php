<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Hamcrest\Core\AllOf;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function addCategory(Request $request)
    {        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $kategori = new Category();
        $kategori->name = $request->name;
        if ($kategori->save()) {
            return redirect()->route('productroom');
        } else {
            return back()->withErrors('Gagal menyimpan Kategori');
        }
    }

    function viewCategory(){
        $categories = Category::all();
        return view('productroom', compact('categories'));
    }
}

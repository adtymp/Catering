<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Hamcrest\Core\AllOf;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $originalName = time() . '_' . $request->file('icon')->getClientOriginalName();
            $image = $request->file('icon')->storeAs('categories', $originalName, 'public');
        } else {
            return back()->withErrors(['icon' => 'File icon tidak ditemukan.']);
        }

        $kategori = new Category();
        $kategori->name = $request->name;
        $kategori->icon = $image;

        if ($kategori->save()) {
            return redirect()->route('productroom.view');
        } else {
            return back()->withErrors('Gagal menyimpan Kategori');
        }
    }


    function viewCategory()
    {
        $categories = Category::all();
        return view('productroom', compact('categories'));
    }
}

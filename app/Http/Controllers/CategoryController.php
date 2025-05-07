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
            return redirect()->route('productroom');
        } else {
            return back()->withErrors('Gagal menyimpan Kategori');
        }
    }

    public function editCategory($id)
    {
        return redirect()->route('productroom')->with('editCategoryId', $id);
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $kategori = Category::findOrFail($id);
        $kategori->name = $request->name;

        if ($request->hasFile('icon')) {
            $originalName = time() . '_' . $request->file('icon')->getClientOriginalName();
            $image = $request->file('icon')->storeAs('categories', $originalName, 'public');
            $kategori->icon = $image;
        }
        

        if ($kategori->save()) {
            return redirect()->route('productroom');
        } else {
            return back()->withErrors('Gagal menyimpan Kategori');
        }
    }

    public function deleteCategory($id){
        $kategori = Category::find($id);
        $kategori->delete();

        return redirect()->route('productroom');
    }
}

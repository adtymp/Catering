<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function addPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $tittle = 'Banner';

        if ($request->hasFile('image')) {
            $originalName = time() . '_' . $request->file('image')->getClientOriginalName();
            $imageBanner = $request->file('image')->storeAs('banners', $originalName, 'public');
        } else {
            return back()->withErrors(['image' => 'File image tidak ditemukan.']);
        }

        $banner = new Banner();
        $banner->tittle = $tittle;
        $banner->image = $imageBanner;

        if ($banner->save()) {
            return redirect()->route('productroom');
        } else {
            return back()->withErrors('Gagal menyimpan banner');
        }
    }

    public function editPost($id)
    {
        return redirect()->route('productroom')->with('editBannerId', $id);
    }

    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $originalName = time() . '_' . $request->file('image')->getClientOriginalName();
            $imageBanner = $request->file('image')->storeAs('banners', $originalName, 'public');
        } else {
            return back()->withErrors(['image' => 'File image tidak ditemukan.']);
        }

        $banner = Banner::findOrFail($id);
        $banner->image = $imageBanner;

        if ($banner->save()) {
            return redirect()->route('productroom');
        } else {
            return back()->withErrors('Gagal Mengupdate banner');
        }
    }

    public function deletePost($id){
        $banner = Banner::find($id);
        $banner->delete();

        return redirect()->route('productroom');
    }
}

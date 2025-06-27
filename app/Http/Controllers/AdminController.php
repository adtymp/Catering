<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $users = User::all();

        return view('admin', compact('users'));
    }

    public function addAdmin(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        if ($user->save()) {
            $user->assignRole('admin');
            return redirect()->route('admin')->with('success', $user->name . ' Telah ditambahkan');
        } else {
            return back()->withErrors('Gagal menyimpan User');
        }
    }

    public function editAdmin($id){
        return redirect()->route('admin')->with('editAdmin', $id);
    }

    public function updateAdmin(){

    }

    public function deleteAdmin(Request $request, $id){
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();
        $admin = User::findOrFail($id);


        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['password' => 'Password tidak valid.']);
        }
        
        if ($user->id === $admin->id) {
            return back()->withErrors(['error' => 'Anda tidak bisa menghapus akun Anda sendiri.']);
        }
    
        $admin->delete();
    
        return redirect()->route('admin')->with('success', $admin->name . ' berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin', compact('users'));
    }

    public function addAdmin(Request $request)
    {
        $pesanValidasi = [
            'name.required' => 'Nama lengkap wajib diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email ini sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'passwordConfirm.required' => 'Konfirmasi password wajib diisi',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'passwordConfirm' => 'required|same:password',
        ], $pesanValidasi);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            $user->assignRole('admin');

            DB::commit();

            return redirect()
                ->route('admin')
                ->with('success', 'Admin ' . $user->name . ' berhasil ditambahkan');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) {
                return back()
                    ->withErrors(['email' => 'Email ini sudah terdaftar'])
                    ->withInput();
            }

            return back()
                ->withErrors('Gagal menyimpan data admin: Kesalahan database')
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withErrors('Terjadi kesalahan sistem: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function editAdmin($id)
    {
        return redirect()->route('admin')->with('editAdmin', $id);
    }

    public function updateAdmin() {}

    public function deleteAdmin(Request $request, $id)
    {
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

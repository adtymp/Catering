<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index(){
        return view('address');
    }
    public function addAddress(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string',
            'no_hp'   => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'kecamatan'   => 'required|string',
            'address'   => 'required|string',
            'label'     => 'required|string',
            'note'      => 'nullable|string',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
    
        $user = Auth::user();
    
        // Jika alamat ini akan jadi default, set yang lain jadi false
        if ($request->is_default) {
            $user->addresses()->update(['is_default' => false]);
        }
    
        $user->addresses()->create([
            'nama_penerima'      => $request->nama_penerima,
            'no_hp'      => $request->no_hp,
            'kecamatan'      => $request->kecamatan,
            'label'      => $request->label,
            'address'    => $request->address,
            'latitude'   => $request->latitude,
            'longitude'  => $request->longitude,
            'note'       => $request->note,
            'is_default' => $request->has('is_default'),
        ]);
    
        return redirect()->route('profile')->with('success', 'Alamat berhasil ditambahkan');
    }
    public function deleteAddress($id)
    {
        $address = Address::find($id);
        if ($address) {
            $address->delete();
        }
    
        return redirect()->route('profile')->with('success', 'Alamat berhasil dihapus.');
    }
}

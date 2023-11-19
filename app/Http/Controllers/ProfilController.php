<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view('profil.index', [
            'user' => $user,
            'title' => 'Apakah anda yakin ?',
            'text' => "User yang terhapus tidak dapat dikembalikan !!",
            "active" => "",
            confirmDelete('title', 'text')
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = User::find(auth()->user()->id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'image' => 'image|mimes:jpeg,png,jpg|max:1000',
            'nik' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'roles' => 'required',
        ]);

        if ($request->file('image')) {
            if ($user->image) {
                Storage::delete($user->image);
            }
            $user->image = $request->file('image')->store('post-images');
        }


        if (!empty($request->input('password'))) {
            // Hanya validasi password jika ada perubahan atau password tidak kosong
            $request->validate([
                'password' => 'required|string|min:5',
            ]);

            $user->password = Hash::make($request->input('password'));
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'nik' => $request->input('nik'),
            'company_name' => $request->input('company_name'),
            'npwp' => $request->input('npwp'),
            'phone' => $request->input('phone'),
            'alamat' => $request->input('alamat'),
        ]);

        $user->roles()->sync($request->input('roles'));

        return redirect()->route('reservasi.index')->with('success', 'User Berhasil Di Update');
    }
}

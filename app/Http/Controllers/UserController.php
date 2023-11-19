<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(15)->withQueryString();
        return view('users.index', [
            'users' => $users,
            'title' => 'Apakah anda yakin ?',
            'text' => "User yang terhapus tidak dapat dikembalikan !!",
            "active" => "",
            confirmDelete('title', 'text')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'), [
            'title' => 'Apakah anda yakin ?',
            'text' => "Metode yang terhapus tidak dapat dikembalikan !!",
            "active" => "",
            confirmDelete('title', 'text')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:5|confirmed',
    //         'roles' => 'required|exists:roles,id',
    //     ]);

    //     // Tentukan pesan kustom untuk validasi
    //     $customMessages = [
    //         'required' => 'Kolom :attribute harus diisi.',
    //         'string' => 'Kolom :attribute harus berupa teks.',
    //         'email' => 'Format :attribute tidak valid.',
    //         'unique' => ':attribute sudah terdaftar.',
    //         'exists' => 'Peran role harus di pilih.',
    //         'min' => [
    //             'string' => 'Kolom :attribute harus minimal :min karakter.',
    //         ]
    //     ];

    //     $validator->setCustomMessages($customMessages);

    //     if ($validator->fails()) {
    //         return redirect("/users/create")
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $user = User::create([
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'password' => bcrypt($request->input('password')),
    //     ]);

    //     $user->roles()->attach($request->input('roles'));

    //     return redirect()->route('users.index')->with('success', 'User Telah di Tambahkan');
    // }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5|confirmed',
            'image' => 'image|mimes:jpeg,png,jpg|max:1000',
            'nik' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'roles' => 'required|array',
        ]);

        // Buat pengguna dengan data yang diterima dari input
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Simpan gambar profil jika ada
        if ($request->file('image')) {
            $user->image = $request->file('image')->store('post-images');
        }

        // Tambahkan data profil tambahan jika ada
        $user->nik = $validatedData['nik'];
        $user->company_name = $validatedData['company_name'];
        $user->npwp = $validatedData['npwp'];
        $user->phone = $validatedData['phone'];
        $user->alamat = $validatedData['alamat'];

        $user->save();

        // Synchronize relasi many-to-many dengan tabel roles
        $user->roles()->attach($validatedData['roles']);

        return redirect()->route('users.index')->with('success', 'User Telah di Tambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user], [
            "active" => ""
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles], [
            "active" => ""
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

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

        return redirect()->route('users.index')->with('success', 'User Berhasil Di Update');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->image) {
            Storage::delete($user->image);
        }
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('users.index')->with('toast_success', 'User has been deleted');
    }
}

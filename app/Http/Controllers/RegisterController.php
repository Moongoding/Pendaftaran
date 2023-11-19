<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function index()
    {
        $roles = Role::all();
        return view('auth.register', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:5|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        // Kirim email verifikasi
        $user->sendEmailVerificationNotification();
        // Periksa apakah 'roles' ada dalam permintaan (request)
        if (!$request->filled('roles')) {
            // Jika tidak ada, atur nilai default 'User' (pastikan nama peran sesuai dengan tabel roles)
            $defaultRole = 'User';

            // Cari peran dengan nama 'User' dalam tabel roles
            $role = Role::where('name', $defaultRole)->first();

            if ($role) {
                // Jika peran ditemukan, tambahkan peran ini ke pengguna
                $user->roles()->attach($role);
            }
        } else {
            // Jika ada peran yang disediakan dalam permintaan, tambahkan peran tersebut ke pengguna
            $user->roles()->attach($request->input('roles'));
        }
        return $user;
        //return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silakan cek email Anda untuk verifikasi.');
    }
}

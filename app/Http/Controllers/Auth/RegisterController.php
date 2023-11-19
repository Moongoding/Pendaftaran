<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Role; // Import Role model

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Periksa apakah 'roles' ada dalam permintaan (request)
        if (!request()->filled('roles')) {
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
            $user->roles()->attach(request()->input('roles'));
        }

        return $user;
    }
}
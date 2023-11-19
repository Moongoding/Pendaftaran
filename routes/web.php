<?php

use App\Models\Home;
use App\Models\About;
use App\Models\Analisa;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MetodeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AnalisaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CategoryParameterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// middleware
//'user', 'admin', 'superadmin'

Route::get('/', function () {
    $homes = Home::all();
    $abouts = About::all();
    $analisa = Analisa::all();
    return view('landing-page.index', [
        "title" => "Home",
        "homes" => $homes,
        "abouts" => $abouts,
        "analisa" => $analisa
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Auth::routes(['verify' => true]);


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('parameter', ParameterController::class);
    Route::resource('analisa', AnalisaController::class);
    Route::resource('category', CategoryParameterController::class);
    Route::resource('metode', MetodeController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('home', HomeController::class);
    Route::resource('about', AboutController::class);
});


Route::resource('reservasi', ReservationController::class)->middleware(['auth']);
Route::post('/reservations/get-parameters', [ReservationController::class, 'getParameters'])
    ->name('reservations.getParameters');

Route::get('/riwayat', [RiwayatController::class, 'index'])->middleware('auth');
Route::delete('/riwayat/{id}', [ReservationController::class, 'destroy'])->middleware('auth');

Route::resource('profil', ProfilController::class)->middleware('auth');

Route::get('laravel', function () {
    return view('welcome');
});

<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Controllers\Controller;


class RiwayatController extends Controller
{
    public function index()
    {
        session()->flash('alert.delete', []);

        if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super_Admin')) {
            $reservations = Reservation::where('status', 'Sudah Selesai')
                ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal dibuat (dari yang terbaru)
                ->paginate(15);
        } else {
            $reservations = Reservation::where('user_id', auth()->user()->id)
                ->where('status', 'Sudah Selesai')
                ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal dibuat (dari yang terbaru)
                ->paginate(15);
        }

        return view('riwayat.index', [
            'title' => 'Apakah anda yakin ?',
            'text' => "Data yang Yang terhapus tidak dapat di kembalikan!!",
            'active' => "",
            'reservations' => $reservations,
        ]);
    }
}

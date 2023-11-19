<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Analisa;
use App\Models\Parameter;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'user']);
    }

    public function index()
    {
        // session()->flash('alert.delete', []);

        // if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super_Admin')) {
        //     // Jika user adalah admin atau super admin, ambil semua data reservasi
        //     $reservations = Reservation::latest()->paginate(15)->withQueryString();
        // } else {
        //     // Jika bukan, ambil data sesuai dengan ID user saat ini
        //     $reservations = Reservation::where('user_id', auth()->user()->id)
        //         ->latest()
        //         ->paginate(15)
        //         ->withQueryString();
        // }

        session()->flash('alert.delete', []);

        $query = Reservation::query();

        if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super_Admin')) {
            // Jika user adalah admin atau super admin, ambil semua data reservasi
            $query->latest();
        } else {
            // Jika bukan, ambil data sesuai dengan ID user saat ini
            $query->where('user_id', auth()->user()->id)->latest();
        }

        // Tambahkan kondisi untuk memfilter berdasarkan status
        $query->where('status', '!=', 'Sudah Selesai');

        $reservations = $query->paginate(15)->withQueryString();

        return view('reservations.index', [
            'title' => 'Apakah anda yakin ?',
            'text' => "Data yang Yang terhapus tidak dapat di kembalikan!!",
            'active' => "",
            'reservations' => $reservations,
        ]);
    }


    public function create()
    {
        $analisas = Analisa::all();
        $parameters = Parameter::all();
        return view('reservations.create', compact('analisas', 'parameters'), [
            "active" => ""
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form input
        $validatedData = $request->validate([
            'analisa' => 'required|exists:analisas,id',
            'harga' => 'required|numeric|min:0',
            'parameters' => 'required|array',
            'jumlah' => 'required|array',
            'jumlah.*' => 'numeric|min:0',
            'parameters.*' => 'exists:parameters,id',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $analisaId = $validatedData['analisa'];

        $reservation = new Reservation([
            'user_id' => auth()->user()->id,
            'analisa_id' => $analisaId,
            'harga' => $validatedData['harga'],
        ]);

        $reservation->save();

        // Simpan data ke tabel pivot reservasi_parameter secara manual
        $parameters = $request->input('parameters');
        $jumlahs = $request->input('jumlah');

        foreach ($parameters as $key => $parameterId) {
            $jumlah = isset($jumlahs[$key]) ? $jumlahs[$key] : 0;
            $reservation->parameters()->attach($parameterId, ['jumlah' => $jumlah]);
        }

        return redirect()->route('reservasi.index')->with('success', 'Pendaftaran berhasil di buat');
    }


    public function edit($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return redirect()->route('reservasi.index')->with('error', 'Reservasi tidak ditemukan.');
        }

        $parameters = Parameter::all();

        // Ambil jumlah dari pivot tabel dan simpan dalam array $jumlahParameter
        $jumlahParameter = [];
        foreach ($reservation->parameters as $parameter) {
            $jumlahParameter[$parameter->id] = $parameter->pivot->jumlah;
        }

        return view('reservations.edit', compact('reservation', 'parameters', 'jumlahParameter'), [
            "active" => ""
        ]);
    }



    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return abort(404);
        }

        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            $request->validate([
                'status' => 'required|in:Dalam Antrian,Sedang Diproses,Sudah Selesai',
            ]);

            $reservation->status = $request->status;
            $reservation->save();
        } elseif ($user->hasRole('Super_Admin')) {
            $request->validate([
                'status' => 'required|in:Dalam Antrian,Sedang Diproses,Sudah Selesai',
            ]);

            $reservation->status = $request->status;
            $reservation->save();

            $parameters = $request->input('parameters', []);

            // Mengatasi jumlah parameter
            $jumlahParameter = $request->input('jumlah', []);
            $pivotData = [];
            $totalHarga = 0; // Inisialisasi totalHarga

            foreach ($parameters as $parameterId) {
                $pivotData[$parameterId] = ['jumlah' => $jumlahParameter[$parameterId] ?? 0];
                $parameter = Parameter::find($parameterId);
                $totalHarga += $parameter->harga * $jumlahParameter[$parameterId];
            }

            // Memperbarui atribut totalHarga
            $reservation->harga = $totalHarga;

            $reservation->parameters()->sync($pivotData);
            $reservation->save(); // Menyimpan perubahan
        } else {
            $request->validate([
                'analisa' => 'required|exists:analisas,id',
                'harga' => 'required|numeric|min:0',
                'parameters' => 'array',
                'parameters.*' => 'exists:parameters,id',
            ]);

            $analisaId = $request->input('analisa');
            $analisa = Analisa::find($analisaId);

            if (!$analisa) {
                return redirect()->route('reservasi.index')->with('error', 'Analisa yang dipilih tidak valid.');
            }

            $reservation->user_id = $user->id;
            $reservation->analisa_id = $analisaId;
            $reservation->harga = $request->input('harga');
            $reservation->save();

            $parameters = $request->input('parameters', []);

            // Mengatasi jumlah parameter
            $jumlahParameter = $request->input('jumlah', []);
            $pivotData = [];
            $totalHarga = 0; // Inisialisasi totalHarga

            foreach ($parameters as $parameterId) {
                $pivotData[$parameterId] = ['jumlah' => $jumlahParameter[$parameterId] ?? 0];
                $parameter = Parameter::find($parameterId);
                $totalHarga += $parameter->harga * $jumlahParameter[$parameterId];
            }

            // Memperbarui atribut totalHarga
            $reservation->harga = $totalHarga;

            $reservation->parameters()->sync($pivotData);
            $reservation->save(); // Menyimpan perubahan
        }

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diperbarui');
    }



    public function show($id)
    {
        $reservation = Reservation::with('analisa.parameters', 'user')->find($id);

        if (!$reservation) {
            return redirect()->route('reservasi.index')->with('error', 'Reservasi tidak ditemukan.');
        }

        return view('reservations.show', compact('reservation'), [
            "active" => ""
        ]);
    }



    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }
}

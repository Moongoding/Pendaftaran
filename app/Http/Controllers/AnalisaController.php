<?php

namespace App\Http\Controllers;

use App\Models\Analisa;
use App\Models\Parameter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AnalisaController extends Controller
{
    // Menampilkan daftar analisa beserta parameter-parameter yang terkait
    public function index()
    {
        $analisas = Analisa::with('parameters')->get(); // Mengambil semua Analisa dengan parameter-parameter terkait
        return view('dashboard.analisa.index', compact('analisas',), [
            'title' => 'Apakah anda yakin ?',
            'text' => "Data yang Yang terhapus tidak dapat di kembalikan!!",
            "active" => "",
            confirmDelete('title', 'text')
        ]);
    }


    // Menampilkan halaman untuk menambah analisa
    public function create()
    {
        $parameters = Parameter::all();
        return view('dashboard.analisa.create', compact('parameters', 'user'), [
            "active" => ""
        ]);
    }

    // Menyimpan analisa baru beserta parameter-parameter yang terkait

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'parameters' => 'required|array',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1000', // Perbaiki validasi file
            'parameters.*' => 'exists:parameters,id',
            'harga' => 'required'
        ]);


        if ($request->file('image')) {
            $validatedData = $request->file('image')->store('post-images');
        }

        $analisa = Analisa::create($validatedData);
        $analisa->parameters()->sync($request->input('parameters'));

        return redirect()->route('analisa.index')->with('success', 'Analisa berhasil ditambahkan');
    }

    public function show($id)
    {
        // Ambil data analisa berdasarkan ID
        $analisa = Analisa::find($id);
        // Jika analisa tidak ditemukan, tampilkan pesan atau redirect ke halaman lain
        if (!$analisa) {
            return redirect()->route('analisa.index')->with('error', 'Analisa tidak ditemukan.');
        }
        return view('dashboard.analisa.show', compact('analisa'), [
            "active" => ""
        ]);
    }


    public function edit($id)
    {
        $analisa = Analisa::find($id);

        if (!$analisa) {
            return redirect()->route('analisa.index')->with('error', 'Analisa tidak ditemukan.');
        }

        $parameters = Parameter::all();
        $selectedParameters = $analisa->parameters->pluck('id')->toArray();

        return view('dashboard.analisa.edit', compact('analisa', 'parameters', 'selectedParameters'), [
            "active" => ""
        ]);
    }

    // Mengupdate analisa beserta parameter-parameter yang terkait
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'parameters' => 'required|array',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1000',
            'parameters.*' => 'exists:parameters,id',
            'harga' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('analisa.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        // Temukan analisa yang akan diperbarui
        $analisa = Analisa::findOrFail($id);

        // Update analisa dengan data yang diterima
        $analisa->name = $request->input('name');
        $analisa->harga = $request->input('harga');

        if ($request->file('image')) {
            // Hapus gambar lama jika ada
            if ($analisa->image) {
                Storage::delete($analisa->image);
            }
            // Simpan gambar baru
            $analisa->image = $request->file('image')->store('post-images');
        }

        $analisa->save();

        // Melampirkan parameter-parameter yang dipilih ke analisa
        $analisa->parameters()->sync($request->input('parameters'));

        return redirect()->route('analisa.index')->with('success', 'Analisa berhasil diperbarui');
    }


    // Menghapus analisa beserta parameter-parameter yang terkait
    public function destroy(Analisa $analisa)
    {
        if ($analisa->image) {
            Storage::delete($analisa->image);
        }
        Analisa::destroy($analisa->id); // Menghapus analisa
        return redirect()->route('analisa.index')->with('success', 'Analisa berhasil dihapus');
    }
}

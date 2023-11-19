<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.home.index', [
            "homes" => Home::all(),
            "abouts" => About::all(),
            "active" => "active",
            'title' => 'Apakah anda yakin ?',
            'text' => "Data yang Yang terhapus tidak dapat di kembalikan!!",
            confirmDelete('title', 'text')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.home.create', [
            "homes" => Home::all(),
            "active" => "active",
            'title' => 'Apakah anda yakin ?',
            'text' => "Data yang Yang terhapus tidak dapat di kembalikan!!",
            confirmDelete('title', 'text')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $ValidatedData = $request->validate([
            'title' => 'required|max:255',
            'title2' => 'required|max:255',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
            'body' => 'required',
        ]);

        // // Handle gambar yang diunggah
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('uploads', 'public');
        // } else {
        //     $imagePath = null;
        // }
        $ValidatedData['user_id'] = auth()->user()->id;

        // Simpan data ke database
        Home::create($ValidatedData);

        // Redirect ke halaman yang sesuai (misalnya halaman home)
        return redirect('/home')->with('success', 'Post berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        return view('dashboard.home.edit', [
            'title' => 'Edit Home',
            "active" => "active",
            'home' => $home,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        $ValidatedData = $request->validate([
            'title' => 'required|max:255',
            'title2' => 'required|max:255',
            'body' => 'required',
        ]);
        $ValidatedData['user_id'] = auth()->user()->id;

        $home->update($ValidatedData);
        return redirect('/home')->with('success', 'Data Home berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        // Lakukan validasi atau periksa izin di sini jika diperlukan
        // Contoh: $this->authorize('delete', $home);

        // Hapus data
        $home->delete();

        // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        return redirect()->route('dashboard.home.index')->with('success', 'Data berhasil dihapus.');
    }
}

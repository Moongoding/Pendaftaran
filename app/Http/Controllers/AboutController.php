<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function create()
    {
        return view('dashboard.about.create', [
            "abouts" => About::all(),
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
            'body2' => 'required',
        ]);

        $ValidatedData['user_id'] = auth()->user()->id;

        // Simpan data ke database
        About::create($ValidatedData);

        // Redirect ke halaman yang sesuai (misalnya halaman home)
        return redirect('/home')->with('success', 'Post berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        return view('dashboard.about.edit', [
            'title' => 'Edit About',
            "active" => "active",
            'about' => $about,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        $ValidatedData = $request->validate([
            'title' => 'required|max:255',
            'title2' => 'required|max:255',
            'body' => 'required',
            'body2' => 'required',
        ]);
        $ValidatedData['user_id'] = auth()->user()->id;

        $about->update($ValidatedData);
        return redirect('/home')->with('success', 'Data About berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $about->delete();

        // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        return redirect()->route('dashboard.home.index')->with('success', 'Data berhasil dihapus.');
    }
}

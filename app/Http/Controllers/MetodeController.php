<?php

namespace App\Http\Controllers;

use App\Models\Metode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class MetodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodes = Metode::all();
        return view('dashboard.metode.index', compact('metodes'), [
            'title' => 'Apakah anda yakin ?',
            'text' => "Metode yang terhapus tidak dapat dikembalikan !!",
            "active" => "",
            confirmDelete('title', 'text')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.metode.create', [
            "active" => ""
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:metodes',
            ]);

            // Tentukan pesan kustom untuk validasi 'unique'
            $validator->setCustomMessages([
                'unique' => 'Nama sudah ada dalam database.',
                'required' => 'Nama Metode Harus Di isi'
            ]);

            if ($validator->fails()) {
                return redirect("/metode/create")
                    ->withErrors($validator)
                    ->withInput();
            }

            $validator = Metode::create([
                'name' => $request->input('name'),
            ]);

            return redirect("/metode")->with('success', 'Metode berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Metode $metode)
    {
        return view('dashboard.metode.show', compact('metode'), [
            "active" => ""
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Metode $metode)
    {
        return view('dashboard.metode.edit', compact('metode'), [
            "active" => ""
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Metode $metode)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('category_parameters', 'name'),
            ],
        ], [
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'name.unique' => 'Nama metode sudah ada dalam database.',
            'name.required' => 'Nama metode harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('metode.edit', $metode->id)
                ->withErrors($validator)
                ->withInput();
        }

        // Perbarui kategori parameter
        $metode->update([
            'name' => $request->input('name'),
        ]);

        return redirect("/metode")->with('success', 'Metode berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Metode $metode)
    {

        $metode->delete();
        return redirect("/metode")->with('success', 'Metode has been deleted.');
    }
}

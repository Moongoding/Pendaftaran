<?php

namespace App\Http\Controllers;

use App\Models\Metode;
use App\Models\Parameter;
use App\Models\CategoryParameter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;




class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parameters = Parameter::with(['categoryParameter', 'metode'])->get();
        return view('dashboard.parameter.index', compact('parameters'), [
            'title' => 'Apakah anda yakin ?',
            "active" => "",
            'text' => "Parameter yang terhapus tidak dapat dikembalikan !!",
            confirmDelete('title', 'text')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryParameter::all();
        $metodes = Metode::all();
        return view('dashboard.parameter.create', compact('categories', 'metodes'), [
            "active" => ""
        ]);
    }

    // ...

    public function store(Request $request)
    {
        // Buat pesan kustom
        $customMessages = [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'category_id.required' => 'Kategori harus dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'metode_id.required' => 'Metode harus dipilih.',
            'metode_id.exists' => 'Metode yang dipilih tidak valid.',
            'harga.required' => 'Harga harus diisi.',
            'harga.integer' => 'Harga harus berupa angka.',
        ];

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:parameters|string|max:255',
            'category_id' => 'required|exists:category_parameters,id',
            'metode_id' => 'required|exists:metodes,id',
            'harga' => 'required|integer', // Tambah validasi untuk harga
        ], $customMessages);

        // Set nama atribut pada pesan error
        $validator->setAttributeNames([
            'name' => 'Nama',
            'category_id' => 'Kategori',
            'metode_id' => 'Metode',
            'harga' => 'Harga',
        ]);

        if ($validator->fails()) {
            return redirect("/parameter/create")
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan parameter ke database
        Parameter::create([
            'name' => $request->input('name'),
            'category_parameter_id' => $request->input('category_id'),
            'metode_id' => $request->input('metode_id'),
            'harga' => $request->input('harga'), // Simpan harga
        ]);

        // Redirect dengan pesan sukses
        return redirect("/parameter")->with('success', 'Parameter berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    // public function show(Parameter $parameter)
    // {
    //     // Tampilkan detail parameter jika diperlukan
    //     return view('dashboard.parameter.show', compact('parameter'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parameter $parameter)
    {
        // Tampilkan form untuk mengedit parameter
        $categories = CategoryParameter::all();
        $metodes = Metode::all();
        return view('dashboard.parameter.edit', compact('parameter', 'categories', 'metodes'), [
            "active" => ""
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Parameter $parameter)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category_parameters,id',
            'metode_id' => 'required|exists:metodes,id',
            'harga' => 'required|integer', // Tambah validasi untuk harga
        ]);

        if ($validator->fails()) {
            return redirect()->route('parameter.edit', $parameter->id)
                ->withErrors($validator)
                ->withInput();
        }

        // Perbarui data parameter
        $parameter->update([
            'name' => $request->input('name'),
            'category_parameter_id' => $request->input('category_id'),
            'metode_id' => $request->input('metode_id'),
            'harga' => $request->input('harga'), // Simpan harga
        ]);

        return redirect()->route('parameter.index')->with('success', 'Parameter berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parameter $parameter)
    {
        // Hapus parameter jika diperlukan
        $parameter->delete();

        return back()->with('success', 'Parameter berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CategoryParameter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryParameter::all();
        return view('dashboard.category.index', compact('categories'), [
            'title' => 'Apakah anda yakin ?',
            'text' => "Semua data yang terikat pada categori ini akan terhapus!!!",
            "active" => "",
            confirmDelete('title', 'text')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryParameter::all();
        return view('dashboard.category.create', compact('categories'), [
            "active" => "",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'name.unique' => 'Nama sudah ada dalam database.',
        ]);

        if ($validator->fails()) {
            return redirect("/category/create")
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan kategori parameter
        CategoryParameter::create([
            'name' => $request->input('name'),
        ]);

        return redirect("/category")->with('success', 'Kategori berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(CategoryParameter $category)
    {
        $parameters = $category->parameters()->with('metode')->get();
        return view('dashboard.category.show', compact('category', 'parameters'), [
            "active" => "",
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryParameter $category)
    {
        return view('dashboard.category.edit', compact('category'), [
            "active" => "",
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryParameter $category)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('category.edit', $category->id)
                ->withErrors($validator)
                ->withInput();
        }

        // Perbarui kategori parameter
        $category->update([
            'name' => $request->input('name'),
        ]);

        return redirect("/category")->with('success', 'Kategori berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $category = CategoryParameter::findOrFail($id);
        $category->delete();
        return redirect("/category")->with('success', 'Category Terhapus.');
    }
}

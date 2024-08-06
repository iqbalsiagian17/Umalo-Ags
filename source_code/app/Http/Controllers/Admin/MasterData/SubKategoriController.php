<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubKategori; // Make sure to import your model
use App\Models\Kategori;

class SubKategoriController extends Controller
{
    public function index()
    {
        $subkategoris = SubKategori::with('kategori')->get();
        return view('admin.masterdata.subkategori.index', compact('subkategoris'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.masterdata.subkategori.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        SubKategori::create($request->all());

        return redirect()->route('admin.masterdata.subkategori.index')->with('success', 'Sub Kategori berhasil ditambahkan.');
    }

    public function edit(SubKategori $subkategori)
    {
        $kategori = Kategori::all();
        return view('admin.masterdata.subkategori.edit', compact('subkategori', 'kategori'));
    }

    public function update(Request $request, SubKategori $subkategori)
    {
        $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        $subkategori->update($request->all());

        return redirect()->route('admin.masterdata.subkategori.index')->with('success', 'Sub Kategori berhasil diperbarui.');
    }

    public function destroy(SubKategori $subkategori)
    {
        $subkategori->delete();

        return redirect()->route('admin.masterdata.subkategori.index')->with('success', 'Sub Kategori berhasil dihapus.');
    }
}

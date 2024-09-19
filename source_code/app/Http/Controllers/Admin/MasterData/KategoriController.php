<?php

namespace App\Http\Controllers\Admin\MasterData;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::where('flag', 'yes')->get();
        return view('admin.masterdata.Kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.masterdata.Kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Kategori::create($request->all());

        return redirect()->route('admin.masterdata.Kategori.index')->with('success', 'Kategori berhasil dibuat.');
    }

    public function show(Kategori $kategori)
    {
        return view('admin.masterdata.Kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.masterdata.Kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori->update($request->all());

        return redirect()->route('admin.masterdata.Kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->update(['flag' => 'no']);

        return redirect()->route('admin.masterdata.Kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

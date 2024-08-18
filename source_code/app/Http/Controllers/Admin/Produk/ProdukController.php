<?php

namespace App\Http\Controllers\Admin\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Komoditas;
use App\Models\SubKategori;
use App\Models\Kategori;
use App\Models\ProdukImage;
use App\Models\ProdukList;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        $images = ProdukImage::all(); 
        return view('admin.produk.index', compact('produks','images'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $komoditas = Komoditas::all();
        $subKategoris = SubKategori::all();
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('komoditas', 'subKategoris', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nama' => 'required',
            'tipe_barang' => 'required',
            'stok' => 'required|integer',
            'masa_berlaku_produk' => 'required|date',
            'merk' => 'required',
            'no_produk_penyedia' => 'required',
            'unit_pengukuran' => 'required',
            'jenis_produk' => 'required',
            'kode_kbli' => 'required|integer',
            'asal_negara' => 'required',
            'nilai_tkdn' => 'nullable|numeric',
            'no_sni' => 'nullable',
            'garansi_produk' => 'required',
            'uji_fungsi' => 'nullable',
            'sni' => 'required',
            'memiliki_svlk' => 'required',
            'jenis_alat' => 'required',
            'fungsi' => 'required',
            'spesifikasi_produk' => 'required',
            'harga_ditampilkan' => 'required',
            'harga_tayang' => 'required|numeric',
            'komoditas_id' => 'required|exists:komoditas,id',
            'kategori_id' => 'required|exists:kategori,id',
            'sub_kategori_id' => 'required|exists:sub_kategori,id',
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:15000',
        ]);

        $produk = new Produk;
        $produk->fill($request->all());
        $produk->save();
    
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $imgProduk) {
                $slug = Str::slug(pathinfo($imgProduk->getClientOriginalName(), PATHINFO_FILENAME));
                $newImageName = time() . '_' . $slug . '.' . $imgProduk->getClientOriginalExtension();
                $imgProduk->move('uploads/produk/', $newImageName);
    
                $produkImage = new ProdukImage;
                $produkImage->produk_id = $produk->id;
                $produkImage->gambar = 'uploads/produk/' . $newImageName;
                $produkImage->save();
            }
        }
    
        $details = $request->input('detail');
        foreach($details['nama'] as $key => $value){
            $data2 = [
                'produk_id' => $produk->id,
                'nama' => $details['nama'][$key],
                'spesifikasi' => $details['spesifikasi'][$key],
                'merk' => $details['merk'][$key],
                'tipe' => $details['tipe'][$key],
                'jumlah' => $details['jumlah'][$key],
                'satuan' => $details['satuan'][$key],  
                'harga_satuan' => $details['harga_satuan'][$key],  
            ];
            ProdukList::create($data2);
        }
    
        return redirect()->route('produk.index')->with('success', 'Produk created successfully.');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::with('produkList', 'komoditas', 'kategori', 'subkategori', 'images')->findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $produk = Produk::find($id);
        $komoditas = Komoditas::all();
        $subKategoris = SubKategori::all();
        $kategoris = Kategori::all();
        $images = ProdukImage::where('produk_id', $id)->get(); 
        return view('admin.produk.edit', compact('produk', 'komoditas', 'subKategoris', 'kategoris','images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'nama' => 'required',
        'tipe_barang' => 'required',
        'stok' => 'required|integer',
        'masa_berlaku_produk' => 'required|date',
        'merk' => 'required',
        'no_produk_penyedia' => 'required',
        'unit_pengukuran' => 'required',
        'jenis_produk' => 'required',
        'kode_kbli' => 'required|integer',
        'asal_negara' => 'required',
        'nilai_tkdn' => 'required|numeric',
        'no_sni' => 'required',
        'garansi_produk' => 'required',
        'uji_fungsi' => 'required',
        'sni' => 'required',
        'memiliki_svlk' => 'required',
        'jenis_alat' => 'required',
        'fungsi' => 'required',
        'spesifikasi_produk' => 'required',
        'harga_tayang' => 'required|numeric',
        'komoditas_id' => 'required|exists:komoditas,id',
        'kategori_id' => 'required|exists:kategori,id',
        'sub_kategori_id' => 'required|exists:sub_kategori,id',
        'gambar.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:15000',
    ]);

    // Find the product by ID
    $produk = Produk::findOrFail($id);
    $produk->fill($request->all());
    $produk->save();

    // Handle image uploads
    if ($request->hasFile('gambar')) {
        // Remove old images
        foreach ($produk->images as $image) {
            if (file_exists(public_path($image->gambar))) {
                unlink(public_path($image->gambar));
            }
            $image->delete();
        }

        // Upload new images
        foreach ($request->file('gambar') as $imgProduk) {
            $slug = Str::slug(pathinfo($imgProduk->getClientOriginalName(), PATHINFO_FILENAME));
            $newImageName = time() . '_' . $slug . '.' . $imgProduk->getClientOriginalExtension();
            $imgProduk->move('uploads/produk/', $newImageName);

            $produkImage = new ProdukImage;
            $produkImage->produk_id = $produk->id;
            $produkImage->gambar = 'uploads/produk/' . $newImageName;
            $produkImage->save();
        }
    }

    // Handle detail updates
    $details = $request->input('detail');
    if ($details) {
        ProdukList::where('produk_id', $produk->id)->delete();
        foreach ($details['nama'] as $key => $value) {
            $data2 = [
                'produk_id' => $produk->id,
                'nama' => $details['nama'][$key],
                'spesifikasi' => $details['spesifikasi'][$key],
                'merk' => $details['merk'][$key],
                'tipe' => $details['tipe'][$key],
                'jumlah' => $details['jumlah'][$key],
                'satuan' => $details['satuan'][$key],  
                'harga_satuan' => $details['harga_satuan'][$key],  
            ];
            ProdukList::create($data2);
        }
    }

    return redirect()->route('produk.index')->with('success', 'Produk updated successfully.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the product by its ID
        $produk = Produk::findOrFail($id);
    
        // Delete associated images
        $images = ProdukImage::where('produk_id', $produk->id)->get();
        foreach ($images as $image) {
            if (file_exists(public_path($image->gambar))) {
                unlink(public_path($image->gambar));
            }
            $image->delete();
        }
    
        // Delete associated details
        ProdukList::where('produk_id', $produk->id)->delete();
    
        // Delete the product
        $produk->delete();
    
        // Redirect back with a success message
        return redirect()->route('produk.index')->with('success', 'Produk deleted successfully.');
    }
    

    public function getSubKategori($kategoriId)
    {
        $subKategoris = SubKategori::where('kategori_id', $kategoriId)->get();
        return response()->json($subKategoris);
    }

    public function updateStatus(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->status = $request->status;
        $produk->save();

        return response()->json(['success' => true]);
    }

}

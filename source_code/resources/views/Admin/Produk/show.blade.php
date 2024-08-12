@extends('layouts.admin.master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Detail Produk</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>Nama:</strong> {{ $produk->nama }}</p>
            <p class="card-text"><strong>Tipe Barang:</strong> {{ $produk->tipe_barang }}</p>
            <p class="card-text"><strong>Stok:</strong> {{ $produk->stok }}</p>
            <p class="card-text"><strong>Masa Berlaku Produk:</strong> {{ $produk->masa_berlaku_produk }}</p>
            <p class="card-text"><strong>Merk:</strong> {{ $produk->merk }}</p>
            <p class="card-text"><strong>No Produk Penyedia:</strong> {{ $produk->no_produk_penyedia }}</p>
            <p class="card-text"><strong>Unit Pengukuran:</strong> {{ $produk->unit_pengukuran }}</p>
            <p class="card-text"><strong>Jenis Produk:</strong> {{ $produk->jenis_produk }}</p>
            <p class="card-text"><strong>Kode KBLI:</strong> {{ $produk->kode_kbli }}</p>
            <p class="card-text"><strong>Asal Negara:</strong> {{ $produk->asal_negara }}</p>
            <p class="card-text"><strong>Nilai TKDN:</strong> {{ $produk->nilai_tkdn }}</p>
            <p class="card-text"><strong>No SNI:</strong> {{ $produk->no_sni }}</p>
            <p class="card-text"><strong>Garansi Produk:</strong> {{ $produk->garansi_produk }}</p>
            <p class="card-text"><strong>Uji Fungsi:</strong> {{ $produk->uji_fungsi }}</p>
            <p class="card-text"><strong>SNI:</strong> {{ $produk->sni }}</p>
            <p class="card-text"><strong>Memiliki SVLK:</strong> {{ $produk->memiliki_svlk }}</p>
            <p class="card-text"><strong>Jenis Alat:</strong> {{ $produk->jenis_alat }}</p>
            <p class="card-text"><strong>Fungsi:</strong> {{ $produk->fungsi }}</p>
            <p class="card-text"><strong>Spesifikasi Produk:</strong> {{ $produk->spesifikasi_produk }}</p>
            <p class="card-text"><strong>Harga Tayang:</strong> {{ $produk->harga_tayang }}</p>
            <p class="card-text"><strong>Komoditas:</strong> {{ $produk->komoditas->nama }}</p>
            <p class="card-text"><strong>Kategori:</strong> {{ $produk->kategori->nama }}</p>
            <p class="card-text"><strong>Sub Kategori:</strong> {{ $produk->subkategori->nama }}</p>

            <h5 class="mt-4">Gambar Produk:</h5>
            @if($produk->images && $produk->images->isNotEmpty())
                @foreach ($produk->images as $image)
                    <img src="{{ asset($image->gambar) }}" alt="Gambar Produk" class="img-fluid mb-2" style="max-width: 500px; height: auto;">
                @endforeach
            @else
                <p>No Image</p>
            @endif

            <h5 class="mt-4">Detail Produk List:</h5>
            @if($produk->produkList && $produk->produkList->isNotEmpty())
                @foreach ($produk->produkList as $detail)
                    <div class="border p-3 mb-3">
                        <p class="card-text"><strong>Nama:</strong> {{ $detail->nama }}</p>
                        <p class="card-text"><strong>Spesifikasi:</strong> {{ $detail->spesifikasi }}</p>
                        <p class="card-text"><strong>Merk:</strong> {{ $detail->merk }}</p>
                        <p class="card-text"><strong>Tipe:</strong> {{ $detail->tipe }}</p>
                        <p class="card-text"><strong>Jumlah:</strong> {{ $detail->jumlah }}</p>
                        <p class="card-text"><strong>Satuan:</strong> {{ $detail->satuan }}</p>
                        <p class="card-text"><strong>Harga Satuan:</strong> {{ $detail->harga_satuan }}</p>
                    </div>
                @endforeach
            @else
                <p>No Detail Produk List</p>
            @endif

            <a href="{{ route('produk.index') }}" class="btn btn-primary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection

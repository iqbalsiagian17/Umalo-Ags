@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">{{ $produk->nama }}</h1>
        <div class="row">
            <div class="col-md-6">
                @if($images->isNotEmpty())
                    @foreach ($images as $image)
                        <img src="{{ asset($image->gambar) }}" alt="Gambar Produk" class="img-fluid mb-2" style="max-width: 500px; height: auto;">
                    @endforeach
                @else
                    <img src="https://via.placeholder.com/150" class="img-fluid mb-2" alt="{{ $produk->nama }}">
                @endif
            </div>
            <div class="col-md-6">
                <p><strong>Tipe Barang:</strong> {{ $produk->tipe_barang }}</p>
                <p><strong>Stok:</strong> {{ $produk->stok }}</p>
                <p><strong>Masa Berlaku Produk:</strong> {{ $produk->masa_berlaku_produk }}</p>
                <p><strong>Merk:</strong> {{ $produk->merk }}</p>
                <p><strong>No Produk Penyedia:</strong> {{ $produk->no_produk_penyedia }}</p>
                <p><strong>Unit Pengukuran:</strong> {{ $produk->unit_pengukuran }}</p>
                <p><strong>Jenis Produk:</strong> {{ $produk->jenis_produk }}</p>
                <p><strong>Kode KBLI:</strong> {{ $produk->kode_kbli }}</p>
                <p><strong>Nilai TKDN:</strong> {{ $produk->nilai_tkdn }}</p>
                <p><strong>No SNI:</strong> {{ $produk->no_sni }}</p>
                <p><strong>Asal Negara:</strong> {{ $produk->asal_negara }}</p>
                <p><strong>Garansi Produk:</strong> {{ $produk->garansi_produk }}</p>
                <p><strong>SNI:</strong> {{ $produk->sni }}</p>
                <p><strong>Uji Fungsi:</strong> {{ $produk->uji_fungsi }}</p>
                <p><strong>Memiliki SVLK:</strong> {{ $produk->memiliki_svlk }}</p>
                <p><strong>Jenis Alat:</strong> {{ $produk->jenis_alat }}</p>
                <p><strong>Fungsi:</strong> {{ $produk->fungsi }}</p>
                <p><strong>Spesifikasi Produk:</strong> {{ $produk->spesifikasi_produk }}</p>
                <p><strong>Ramah Lingkungan:</strong> {{ $produk->ramah_lingkungan ? 'Ya' : 'Tidak' }}</p>
                <p><strong>Harga Diskon:</strong> {{ $produk->harga_diskon }}</p>
                <p><strong>Harga Tayang:</strong> {{ $produk->harga_tayang }}</p>
                <p><strong>Kategori:</strong> {{ $produk->kategori->nama }}</p>
                <p><strong>Sub Kategori:</strong> {{ $produk->subKategori->nama }}</p>
                <p><strong>Komoditas:</strong> {{ $produk->komoditas->nama }}</p>
                <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali</a> <!-- Menggunakan nama route baru -->
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Daftar Produk</h1>
    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Nama</th>
                <th>Tipe Barang</th>
                <th>Stok</th>
                <th>Masa Berlaku Produk</th>
                <th>Merk</th>
                <th>No Produk Penyedia</th>
                <th>Unit Pengukuran</th>
                <th>Jenis Produk</th>
                <th>Kode KBLI</th>
                <th>Asal Negara</th>
                <th>Nilai TKDN</th>
                <th>No SNI</th>
                <th>Garansi Produk</th>
                <th>Uji Fungsi</th>
                <th>SNI</th>
                <th>Memiliki SVLK</th>
                <th>Jenis Alat</th>
                <th>Fungsi</th>
                <th>Spesifikasi Produk</th>
                <th>Harga Tayang</th>
                <th style="width: 200px">Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $produk)
            <tr>
                <td>{{ $produk->nama }}</td>
                <td>{{ $produk->tipe_barang }}</td>
                <td>{{ $produk->stok }}</td>
                <td>{{ $produk->masa_berlaku_produk }}</td>
                <td>{{ $produk->merk }}</td>
                <td>{{ $produk->no_produk_penyedia }}</td>
                <td>{{ $produk->unit_pengukuran }}</td>
                <td>{{ $produk->jenis_produk }}</td>
                <td>{{ $produk->kode_kbli }}</td>
                <td>{{ $produk->asal_negara }}</td>
                <td>{{ $produk->nilai_tkdn }}</td>
                <td>{{ $produk->no_sni }}</td>
                <td>{{ $produk->garansi_produk }}</td>
                <td>{{ $produk->uji_fungsi }}</td>
                <td>{{ $produk->sni }}</td>
                <td>{{ $produk->memiliki_svlk }}</td>
                <td>{{ $produk->jenis_alat }}</td>
                <td>{{ $produk->fungsi }}</td>
                <td>{{ $produk->spesifikasi_produk }}</td>
                <td>{{ $produk->harga_tayang }}</td>
                <td style="max-width: 200px;">
                    @if ($produk->images->isNotEmpty())
                        @foreach($produk->images as $image)
                            <img src="{{ asset($image->gambar) }}" alt="Gambar Produk" class="img-fluid" style="border-radius: initial; width: 100%; height: auto; max-width: 100%; margin-bottom: 10px;">
                        @endforeach
                    @else
                        <p>No Image</p>
                    @endif
                </td>
                <td>
                    <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
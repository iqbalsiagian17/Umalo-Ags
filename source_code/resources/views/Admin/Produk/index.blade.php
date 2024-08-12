@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1 class="mt-4">Daftar Produk</h1>
    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tipe Barang</th>
                <th>Stok</th>
                <th>Harga Tayang</th>
                <th style="width: 200px">Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $index => $produk)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $produk->nama }}</td>
                <td>{{ $produk->tipe_barang }}</td>
                <td>{{ $produk->stok }}</td>
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
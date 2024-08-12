@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <h1>Sub Kategori</h1>
        <a href="{{ route('admin.masterdata.subkategori.create') }}" class="btn btn-primary">Buat Sub Kategori</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subkategoris as $index => $subkategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $subkategori->nama }}</td>
                    <td>{{ $subkategori->kategori->nama }}</td>
                    <td>
                        <a href="{{ route('admin.masterdata.subkategori.edit', $subkategori->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.masterdata.subkategori.destroy', $subkategori->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

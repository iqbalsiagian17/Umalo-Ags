@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <h1>Kategori</h1>
        <a href="{{ route('admin.masterdata.kategori.create') }}" class="btn btn-primary">Buat Kategori</a>

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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoris as $index => $kategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                        <td>{{ $kategori->nama }}</td>
                        <td>
                            <a href="{{ route('admin.masterdata.kategori.edit', $kategori->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.masterdata.kategori.destroy', $kategori->id) }}" method="POST" style="display:inline-block;">
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

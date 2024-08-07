@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Komoditas</h1>
        <a href="{{ route('admin.masterdata.komoditas.create') }}" class="btn btn-primary">Buat Komoditas</a>

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
                @foreach ($komoditas as $index => $komoditas)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $komoditas->nama }}</td>
                    <td>
                        <a href="{{ route('admin.masterdata.komoditas.edit', $komoditas->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.masterdata.komoditas.destroy', $komoditas->id) }}" method="POST" style="display:inline-block;">
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

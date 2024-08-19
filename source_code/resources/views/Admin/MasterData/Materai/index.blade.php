@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Daftar Materai</h1>
    <a href="{{ route('admin.masterdata.materai.create') }}" class="btn btn-primary">Tambah Materai</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <th>Gambar Materai</th>
            <th width="280px">Aksi</th>
        </tr>
        @foreach ($materai as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td><img src="{{ asset($item->image) }}" width="100" class="img-fluid img-thumbnail"></td>
            <td>
                <a href="{{ route('admin.masterdata.materai.show', $item->id) }}" class="btn btn-info">Lihat</a>
                <a href="{{ route('admin.masterdata.materai.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.masterdata.materai.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection

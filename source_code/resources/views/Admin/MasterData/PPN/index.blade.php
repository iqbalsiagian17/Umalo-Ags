@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Daftar PPN</h1>
    <a href="{{ route('admin.masterdata.ppn.create') }}" class="btn btn-primary">Tambah PPN</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <th>PPN (%)</th>
            <th width="280px">Aksi</th>
        </tr>
        @foreach ($ppns as $ppn)
        <tr>
            <td>{{ $ppn->id }}</td>
            <td>{{ $ppn->ppn }}</td>
            <td>
                <a href="{{ route('admin.masterdata.ppn.show', $ppn->id) }}" class="btn btn-info">Lihat</a>
                <a href="{{ route('admin.masterdata.ppn.edit', $ppn->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.masterdata.ppn.destroy', $ppn->id) }}" method="POST" style="display:inline;">
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

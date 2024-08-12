@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <h1>Edit Sub Kategori</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.masterdata.subkategori.update', $subkategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" class="form-control" id="kategori_id">
                    @foreach ($kategori as $kategori)
                        <option value="{{ $kategori->id }}" {{ $subkategori->kategori_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nama">Nama Sub Kategori</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ $subkategori->nama }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

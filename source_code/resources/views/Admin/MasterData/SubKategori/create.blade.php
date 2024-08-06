@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buat Sub Kategori</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.masterdata.subkategori.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" class="form-control" id="kategori_id">
                    @foreach ($kategori as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nama">Nama Sub Kategori</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

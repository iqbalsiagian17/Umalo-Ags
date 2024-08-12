@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <h1>Edit Komoditas</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.masterdata.komoditas.update', $komoditas->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ $komoditas->nama }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        

    </div>
@endsection

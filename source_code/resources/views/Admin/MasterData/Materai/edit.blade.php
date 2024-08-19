@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Edit Materai</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.masterdata.materai.update', $materai->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <img src="{{ asset($materai->image) }}" width="100" class="img-fluid img-thumbnail">
            <br>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('admin.masterdata.materai.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection

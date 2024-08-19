@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Edit PPN</h1>

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

    <form action="{{ route('admin.masterdata.ppn.update', $ppn->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="ppn">PPN (%)</label>
            <input type="number" name="ppn" class="form-control" value="{{ $ppn->ppn }}" step="0.01" min="0" max="100">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('admin.masterdata.ppn.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection

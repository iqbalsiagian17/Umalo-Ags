@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Detail Materai</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $materai->id }}</h5>
            <p class="card-text">
                <img src="{{ asset($materai->image) }}" width="100" class="img-fluid img-thumbnail">
            </p>
            <a href="{{ route('admin.masterdata.materai.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

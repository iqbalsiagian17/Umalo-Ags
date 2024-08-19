@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Detail PPN</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $ppn->id }}</h5>
            <p class="card-text">PPN: {{ $ppn->ppn }}%</p>
            <a href="{{ route('admin.masterdata.ppn.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

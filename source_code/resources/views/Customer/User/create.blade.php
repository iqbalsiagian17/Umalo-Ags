@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create User Details</h1>

    <form method="POST" action="{{ route('user.store') }}">
        @csrf
        <div class="mb-3">
            <label for="no_telepone" class="form-label">No Telepone</label>
            <input type="text" class="form-control" id="no_telepone" name="no_telepone" value="{{ old('no_telepone') }}">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="kota" class="form-label">Kota</label>
            <input type="text" class="form-control" id="kota" name="kota" value="{{ old('kota') }}">
        </div>
        <div class="mb-3">
            <label for="provinsi" class="form-label">Provinsi</label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ old('provinsi') }}">
        </div>
        <div class="mb-3">
            <label for="kode_pos" class="form-label">Kode Pos</label>
            <input type="numberic" class="form-control" id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" maxlength="5">
        </div>
        <div class="mb-3">
            <label for="lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="lahir" name="lahir" value="{{ old('lahir') }}">
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection

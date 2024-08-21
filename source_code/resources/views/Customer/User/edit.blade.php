@extends('layouts.customer.master')

@section('content')
<div class="container">
    <h1>Edit User Details</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="no_telepone" class="form-label">No Telepone</label>
            <input type="text" class="form-control" id="no_telepone" name="no_telepone" value="{{ old('no_telepone', $userDetail->no_telepone) }}">
            @if ($errors->has('no_telepone'))
                <small class="text-danger">{{ $errors->first('no_telepone') }}</small>
            @endif
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat', $userDetail->alamat) }}</textarea>
            @if ($errors->has('alamat'))
                <small class="text-danger">{{ $errors->first('alamat') }}</small>
            @endif
        </div>
        <div class="mb-3">
            <label for="kota" class="form-label">Kota</label>
            <input type="text" class="form-control" id="kota" name="kota" value="{{ old('kota', $userDetail->kota) }}">
            @if ($errors->has('kota'))
                <small class="text-danger">{{ $errors->first('kota') }}</small>
            @endif
        </div>
        <div class="mb-3">
            <label for="provinsi" class="form-label">Provinsi</label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ old('provinsi', $userDetail->provinsi) }}">
            @if ($errors->has('provinsi'))
                <small class="text-danger">{{ $errors->first('provinsi') }}</small>
            @endif
        </div>
        <div class="mb-3">
            <label for="perusahaan" class="form-label">perusahaan</label>
            <input type="text" class="form-control" id="perusahaan" name="perusahaan" value="{{ old('perusahaan', $userDetail->perusahaan) }}">
            @if ($errors->has('perusahaan'))
                <small class="text-danger">{{ $errors->first('perusahaan') }}</small>
            @endif
        </div>
        <div class="mb-3">
            <label for="kode_pos" class="form-label">Kode Pos</label>
            <input type="text" class="form-control" id="kode_pos" name="kode_pos" maxlength="5" value="{{ old('kode_pos', $userDetail->kode_pos) }}">
            @if ($errors->has('kode_pos'))
                <small class="text-danger">{{ $errors->first('kode_pos') }}</small>
            @endif
        </div>
        <div class="mb-3">
            <label for="lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="lahir" name="lahir" value="{{ old('lahir', $userDetail->lahir) }}">
            @if ($errors->has('lahir'))
                <small class="text-danger">{{ $errors->first('lahir') }}</small>
            @endif
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="jenis_kelamin_laki" name="jenis_kelamin" value="laki-laki" {{ old('jenis_kelamin', $userDetail->jenis_kelamin) == 'laki-laki' ? 'checked' : '' }}>
                    <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan" name="jenis_kelamin" value="perempuan" {{ old('jenis_kelamin', $userDetail->jenis_kelamin) == 'perempuan' ? 'checked' : '' }}>
                    <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                </div>
            </div>
            @if ($errors->has('jenis_kelamin'))
                <small class="text-danger">{{ $errors->first('jenis_kelamin') }}</small>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

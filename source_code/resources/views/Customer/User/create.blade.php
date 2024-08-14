@extends('layouts.customer.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Create User Details</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="no_telepone" class="form-label">No Telepone</label>
                        <input type="text" class="form-control" id="no_telepone" name="no_telepone" value="{{ old('no_telepone') }}">
                        @if ($errors->has('no_telepone'))
                            <small class="text-danger">{{ $errors->first('no_telepone') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat') }}</textarea>
                        @if ($errors->has('alamat'))
                            <small class="text-danger">{{ $errors->first('alamat') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="kota" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" value="{{ old('kota') }}">
                        @if ($errors->has('kota'))
                            <small class="text-danger">{{ $errors->first('kota') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ old('provinsi') }}">
                        @if ($errors->has('provinsi'))
                            <small class="text-danger">{{ $errors->first('provinsi') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="kode_pos" class="form-label">Kode Pos</label>
                        <input type="number" class="form-control" id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" maxlength="5">
                        @if ($errors->has('kode_pos'))
                            <small class="text-danger">{{ $errors->first('kode_pos') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="lahir" name="lahir" value="{{ old('lahir') }}">
                        @if ($errors->has('lahir'))
                            <small class="text-danger">{{ $errors->first('lahir') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="jenis_kelamin_laki" name="jenis_kelamin" value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan" name="jenis_kelamin" value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                            </div>
                        </div>
                        @if ($errors->has('jenis_kelamin'))
                            <small class="text-danger">{{ $errors->first('jenis_kelamin') }}</small>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

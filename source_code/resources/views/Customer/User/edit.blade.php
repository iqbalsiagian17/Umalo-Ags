@extends('layouts.customer.master')

@section('content')
<div class="container mt-5">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-5 mt-5 shadow rounded border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('user.update') }}">
                @csrf
                @method('PUT')

                <!-- User Information Section -->
                <h4 class="mb-3">{{ __('messages.additional_information') }}</h4>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="perusahaan" class="form-label">{{ __('messages.company') }}</label>
                            <input type="text" class="form-control" id="perusahaan" name="perusahaan" value="{{ old('perusahaan', $userDetail->perusahaan) }}">
                            @if ($errors->has('perusahaan'))
                                <small class="text-danger">{{ $errors->first('perusahaan') }}</small>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="no_telepone" class="form-label">{{ __('messages.phone_number') }}</label>
                            <input type="text" class="form-control" id="no_telepone" name="no_telepone" value="{{ old('no_telepone', $userDetail->no_telepone) }}">
                            @if ($errors->has('no_telepone'))
                                <small class="text-danger">{{ $errors->first('no_telepone') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lahir" class="form-label">{{ __('messages.birth_date') }}</label>
                            <input type="date" class="form-control" id="lahir" name="lahir" value="{{ old('lahir', $userDetail->lahir) }}">
                            @if ($errors->has('lahir'))
                                <small class="text-danger">{{ $errors->first('lahir') }}</small>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">{{ __('messages.gender') }}</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="jenis_kelamin_laki" name="jenis_kelamin" value="laki-laki" {{ old('jenis_kelamin', $userDetail->jenis_kelamin) == 'laki-laki' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jenis_kelamin_laki">{{ __('messages.male') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan" name="jenis_kelamin" value="perempuan" {{ old('jenis_kelamin', $userDetail->jenis_kelamin) == 'perempuan' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jenis_kelamin_perempuan">{{ __('messages.female') }}</label>
                                </div>
                            </div>
                            @if ($errors->has('jenis_kelamin'))
                                <small class="text-danger">{{ $errors->first('jenis_kelamin') }}</small>
                            @endif
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn text-white" style="background: #42378C;">{{ __('messages.update') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

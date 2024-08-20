@extends('layouts.admin.master')

@section('content')
<div class="row">
        <div class="card">
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><strong>Name:</strong></label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $user->name }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><strong>Email:</strong></label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><strong>Role:</strong></label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ ucfirst($user->role) }}</p>
                    </div>
                </div>

                <hr>

                <h5 class="mb-4">Contact Information</h5>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><strong>Phone Number:</strong></label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $user->userDetail->no_telepone }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><strong>Address:</strong></label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $user->userDetail->alamat }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><strong>City:</strong></label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $user->userDetail->kota }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><strong>Province:</strong></label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $user->userDetail->provinsi }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><strong>Postal Code:</strong></label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $user->userDetail->kode_pos }}</p>
                    </div>
                </div>

                <hr>

                <h5 class="mb-4">Personal Information</h5>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><strong>Date of Birth:</strong></label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($user->userDetail->lahir)->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><strong>Gender:</strong></label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $user->userDetail->jenis_kelamin }}</p>
                    </div>
                </div>

                <a href="{{ route('users.index') }}" class="btn btn-secondary mt-4">Back to List</a>
            </div>
        </div>
    </div>
@endsection


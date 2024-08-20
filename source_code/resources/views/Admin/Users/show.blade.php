@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <h1>User Details</h1>

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <p>{{ $user->name }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <p>{{ $user->email }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Role:</label>
            <p>{{ $user->role }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone Number:</label>
            <p>{{ $user->userDetail->no_telepone }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Address:</label>
            <p>{{ $user->userDetail->alamat }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">City:</label>
            <p>{{ $user->userDetail->kota }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Province:</label>
            <p>{{ $user->userDetail->provinsi }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Postal Code:</label>
            <p>{{ $user->userDetail->kode_pos }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Date of Birth:</label>
            <p>{{ $user->userDetail->lahir }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender:</label>
            <p>{{ $user->userDetail->jenis_kelamin }}</p>
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection

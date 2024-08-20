@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <h1>Create New User</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="0">Customer</option>
                    <option value="1">Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="no_telepone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="no_telepone" name="no_telepone" value="{{ old('no_telepone') }}" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Address</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}" required>
            </div>
            <div class="mb-3">
                <label for="kota" class="form-label">City</label>
                <input type="text" class="form-control" id="kota" name="kota" value="{{ old('kota') }}" required>
            </div>
            <div class="mb-3">
                <label for="provinsi" class="form-label">Province</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ old('provinsi') }}" required>
            </div>
            <div class="mb-3">
                <label for="kode_pos" class="form-label">Postal Code</label>
                <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" required>
            </div>
            <div class="mb-3">
                <label for="lahir" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="lahir" name="lahir" value="{{ old('lahir') }}" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Gender</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-Laki">Male</option>
                    <option value="Perempuan">Female</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
@endsection

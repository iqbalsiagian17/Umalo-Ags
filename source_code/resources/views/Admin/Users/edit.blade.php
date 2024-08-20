@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <h1>Edit User</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="0" {{ $user->role === "costumer" ? 'selected' : '' }}>Customer</option>
                    <option value="1" {{ $user->role === "admin" ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="no_telepone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="no_telepone" name="no_telepone" value="{{ $user->userDetail->no_telepone }}" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Address</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $user->userDetail->alamat }}" required>
            </div>
            <div class="mb-3">
                <label for="kota" class="form-label">City</label>
                <input type="text" class="form-control" id="kota" name="kota" value="{{ $user->userDetail->kota }}" required>
            </div>
            <div class="mb-3">
                <label for="provinsi" class="form-label">Province</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ $user->userDetail->provinsi }}" required>
            </div>
            <div class="mb-3">
                <label for="kode_pos" class="form-label">Postal Code</label>
                <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ $user->userDetail->kode_pos }}" required>
            </div>
            <div class="mb-3">
                <label for="lahir" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="lahir" name="lahir" value="{{ $user->userDetail->lahir }}" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Gender</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-Laki" {{ $user->userDetail->jenis_kelamin === 'Laki-Laki' ? 'selected' : '' }}>Male</option>
                    <option value="Perempuan" {{ $user->userDetail->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
@endsection

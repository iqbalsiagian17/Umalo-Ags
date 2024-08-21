@extends('layouts.customer.master')

@section('content')
<div class="container">
    <h1>User Details</h1>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card mb-3">
        <div class="card-header">
            <h4>Account Information</h4>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Registered At:</strong> {{ $user->created_at}}</p>

            @if (is_null($user->password) || $user->password === '')
                <p><strong>Password:</strong> Not Set</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPasswordModal">
                    Create Password
                </button>
            @else
                <p><strong>Password:</strong> **************</p>
                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                    Change Password
                </button>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Personal Details</h4>
        </div>
        <div class="card-body">
            <p><strong>No Telepone:</strong> {{ $userDetail->no_telepone }}</p>
            <p><strong>Alamat:</strong> {{ $userDetail->alamat }}</p>
            <p><strong>Kota:</strong> {{ $userDetail->kota }}</p>
            <p><strong>Provinsi:</strong> {{ $userDetail->provinsi }}</p>
            <p><strong>Kode Pos:</strong> {{ $userDetail->kode_pos }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ $userDetail->lahir}}</p>
            <p><strong>Jenis Kelamin:</strong> {{ $userDetail->jenis_kelamin }}</p>
            <p><strong>Perusahaan:</strong> {{ $userDetail->perusahaan }}</p>
        </div>
    </div>

    <a href="{{ route('user.edit') }}" class="btn btn-primary mt-3">Edit Details</a>
</div>

<!-- Modal for Creating Password -->
<div class="modal fade" id="createPasswordModal" tabindex="-1" aria-labelledby="createPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createPasswordModalLabel">Create Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Changing Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="changePasswordForm" method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                    <div id="passwordMismatchAlert" class="alert alert-danger d-none">
                        New Password and Confirm New Password do not match.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('new_password_confirmation').value;
        var alertBox = document.getElementById('passwordMismatchAlert');

        if (newPassword !== confirmPassword) {
            event.preventDefault(); // Prevent form submission
            alertBox.classList.remove('d-none'); // Show the alert
        } else {
            alertBox.classList.add('d-none'); // Hide the alert if passwords match
        }
    });
</script>
@endsection

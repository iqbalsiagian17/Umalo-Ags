@extends('layouts.customer.master')

@section('content')
<div class="container">

    <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="personal-profile-tab" data-bs-toggle="tab" data-bs-target="#personal-profile" type="button" role="tab" aria-controls="personal-profile" aria-selected="true">Personal Profile</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="address-list-tab" data-bs-toggle="tab" data-bs-target="#address-list" type="button" role="tab" aria-controls="address-list" aria-selected="false">Address List</button>
        </li>
    </ul>

    <div class="tab-content" id="profileTabsContent">
        <!-- Personal Profile Tab -->
        <div class="tab-pane fade show active" id="personal-profile" role="tabpanel" aria-labelledby="personal-profile-tab">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="card text-center">
                                <div class="card-body">
                                    <img src="{{ $user->foto_profile ? asset('storage/' . $user->foto_profile) : asset('assets/images/logo.png') }}"  
                                         class="rounded-circle mb-3" alt="User Photo" style="width: 250px;">
                                         <br>
                                    <button class="btn btn-primary btn-sm">Choose Photo</button>
                                    <p class="text-muted mt-3">File size max 10MB. JPG, JPEG, PNG allowed.</p>
                                </div>
                            </div>
                            <div class="d-flex flex-column mt-4">
                                @if (is_null($user->password) || $user->password === '')
                                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createPasswordModal">Create Password</button>
                                @else
                                    <button type="button" class="btn btn-link mb-2" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                                @endif
                                <a href="{{ route('user.edit') }}" class="btn btn-primary">Edit Data Anda</a>
                            </div>
                            
                            
                        </div>
                        

                        <!-- Account Information Section -->
                        <div class="col-md-6">
                            <h4>Account Information</h4>
                            <p><strong>Name:</strong> {{ $user->name }} </p>
                            <p><strong>Email:</strong> {{ $user->email }} <span class="badge bg-success">Verified</span> </p>
                            <p><strong>Phone Number:</strong> {{ $userDetail->no_telepone }}</p>
                            <p><strong>Date of Birth:</strong> {{ $userDetail->lahir }}</p>
                            <p><strong>Gender:</strong> {{ $userDetail->jenis_kelamin }} </p>
                            <p><strong>Perusahaan:</strong> {{ $userDetail->perusahaan }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Address List Tab -->
        <div class="tab-pane fade" id="address-list" role="tabpanel" aria-labelledby="address-list-tab">
            <div class="card-body">
                    <div class="row">
                        <!-- Profile Photo Section -->
                        <div class="col-md-12 ">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="card p-3 mb-3" style="border: 1px solid #28a745; background-color: #f0fff4;">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title"><strong>Rumah</strong> <span class="badge bg-light text-dark">Default</span></h5>
                                                <p class="mb-0">{{ $user->name }}, {{ $userDetail->perusahaan }}</p>
                                                <p class="mb-0">{{ $userDetail->no_telepone }}</p>
                                                <p class="mb-0">{{ $userDetail->alamat }} {{ $userDetail->kota }}, {{ $userDetail->provinsi }} {{ $userDetail->kode_pos }}</p>
                                            </div>
                                            <div>
                                                <i class="bi bi-check-circle" style="color: #28a745; font-size: 1.5rem;"></i>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('user.edit') }}" class="text-primary">Edit Address</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
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

@extends('layouts.admin.master')

@section('content')
<div class="col-md-12">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title"><h1>Produk</h1></div>
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
            </div>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-body">
            <div class="row">
                <table class="table table-striped table-responsive table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Perusahaan</th>
                            <th>Role</th>
                            <th>Dibuat</th>
                            <th>Terakhir Online</th>
                            <th>Actions</th>
                        </tr>
                </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->perusahaan }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            @if(auth()->check() && auth()->user()->id === $user->id)
                                <span class="badge badge-primary">Online</span>
                            @elseif($user->last_login_at && $user->last_login_at->gt(now()->subSeconds(5)))  <!-- Changed to 5 seconds -->
                                <span class="badge badge-primary">Online</span>
                            @elseif($user->last_login_at)
                                <span class="badge badge-success">{{ $user->last_login_at->diffForHumans() }}</span>
                            @else
                                <span class="badge badge-danger">Belum Pernah Login</span>
                            @endif
                        </td>
                                                
                                               
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        </div>
        </div>
    </div>
</div>
@endsection

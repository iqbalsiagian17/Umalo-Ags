@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Edit Transaksi</h1>

    <div class="card">
        <div class="card-header">
            Edit Transaksi ID: {{ $order->id }}
        </div>
        <div class="card-body">
            <form action="{{ route('transaksi.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="user_id">User ID</label>
                    <input type="text" name="user_id" id="user_id" class="form-control" value="{{ $order->user->id }}" readonly>
                </div>

                <div class="form-group">
                    <label for="harga_total">Harga Total</label>
                    <input type="number" name="harga_total" id="harga_total" class="form-control" value="{{ $order->harga_total }}">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update Transaksi</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

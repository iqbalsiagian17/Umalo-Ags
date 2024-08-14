@extends('layouts.admin.master')

@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- First Card: Transaction Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Edit Transaksi ID: {{ $order->id }}</h2>
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
                        <input type="number" name="harga_total" id="harga_total" class="form-control" value="{{ $order->harga_total }}" step="0.01">
                        @if ($errors->has('harga_total'))
                            <small class="text-danger">{{ $errors->first('harga_total') }}</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @if ($errors->has('status'))
                            <small class="text-danger">{{ $errors->first('status') }}</small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">Update Transaksi</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <!-- Second Card: Transaction Items -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Item Transaksi</h2>
            </div>
            <div class="card-body">
                @if($order->orderItems && $order->orderItems->isNotEmpty())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produk ID</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->produk_id }}</td>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ 'Rp ' . number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ 'Rp ' . number_format($item->jumlah * $item->harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No Transaction Items Available</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

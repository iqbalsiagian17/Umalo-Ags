@extends('layouts.admin.master')

@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- First Card: Transaction Information -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title"><h2>Detail Transaksi</h2></div>
                <div class="form-group">
                    <label class="form-label">Status:</label>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="status" value="pending" class="selectgroup-input" {{ $order->status == 'pending' ? 'checked' : '' }} />
                            <span class="selectgroup-button">Pending</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="status" value="completed" class="selectgroup-input" {{ $order->status == 'completed' ? 'checked' : '' }} />
                            <span class="selectgroup-button">Completed</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="status" value="cancelled" class="selectgroup-input" {{ $order->status == 'cancelled' ? 'checked' : '' }} />
                            <span class="selectgroup-button">Cancelled</span>
                        </label>
                    </div>
                    @if ($errors->has('status'))
                        <small class="text-danger">{{ $errors->first('status') }}</small>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Bagian</th>
                            <th scope="col">Informasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Transaksi ID</td>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td>User ID</td>
                            <td>{{ $order->user_id }}</td>
                        </tr>
                        <tr>
                            <td>Harga Total</td>
                            <td>{{ 'Rp ' . number_format($order->harga_total, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <!-- Second Card: Transaction Items -->
        <div class="card mb-4">
            <div class="card-header">
                <div class="card-title"><h2>Item Transaksi</h2></div>
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

<a href="{{ route('transaksi.index') }}" class="btn btn-primary">Kembali</a>
<a href="{{ route('transaksi.edit', $order->id) }}" class="btn btn-warning">Edit</a>

@endsection

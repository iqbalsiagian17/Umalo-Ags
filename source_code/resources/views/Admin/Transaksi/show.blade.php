@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Detail Transaksi</h1>

    <div class="card">
        <div class="card-header">
            Transaksi ID: {{ $order->id }}
        </div>
        <div class="card-body">
            <p><strong>User ID:</strong> {{ $order->user_id }}</p>
            <p><strong>Harga Total:</strong> {{ $order->harga_total }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
            <p><strong>Item Transaksi:</strong></p>
            <ul>
                @foreach($order->orderItems as $item)
                <li>
                    Produk ID: {{ $item->produk_id }} | Jumlah: {{ $item->jumlah }} | Harga: {{ $item->harga }}
                </li>
                @endforeach
            </ul>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('transaksi.edit', $order->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection

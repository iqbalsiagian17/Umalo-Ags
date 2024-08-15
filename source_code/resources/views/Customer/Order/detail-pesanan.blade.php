@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pesanan</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h3>Pesanan ID: {{ $order->id }}</h3>
    <p>Status: {{ $order->status }}</p>
    <p>Total Harga: {{ $order->harga_total }}</p>

    <h4>Item Pesanan:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->produk->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->harga }}</td>
                    <td>{{ $item->harga * $item->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        @if($order->orderItems->contains(function($item) { return $item->produk->nego == 'yes'; }))
            @if($order->status == 'Negosiasi' && $order->whatsapp_number)
                <p><strong>Nomor WhatsApp untuk negosiasi:</strong> {{ $order->whatsapp_number }}</p>
            @endif
        @endif
        
        @if(in_array($order->status, ['Menunggu ACC Admin', 'Menunggu ACC Admin untuk Negosiasi', 'Negosiasi', 'Diterima']))
            <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
            </form>
        @endif

        @if($order->status == 'Pengiriman')
            <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary">Terima Barang</button>
            </form>
        @endif

        @if($order->status == 'Selesai')
            <p><strong>Pesanan ini telah selesai. Terima kasih telah berbelanja!</strong></p>
        @endif

        <a href="{{ route('order.history') }}" class="btn btn-secondary">Back to History</a>
    </div>
</div>
@endsection

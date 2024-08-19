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
    <p>Total Harga: {{ 'Rp ' . number_format($order->harga_total, 0, ',', '.') }}</p>

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
                    <td>{{ 'Rp ' . number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ 'Rp ' . number_format($item->harga * $item->jumlah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <!-- Display WhatsApp number for negotiation if applicable -->
        @if($order->orderItems->contains(function($item) { return $item->produk->nego == 'ya'; }))
            @if($order->status == 'Negosiasi' && $order->whatsapp_number)
                <p><strong>Nomor WhatsApp untuk negosiasi:</strong> {{ $order->whatsapp_number }}</p>
            @endif
        @endif

        <!-- Show "Cancel Order" button if the order is in a cancellable state -->
        @if(in_array($order->status, ['Menunggu ACC Admin', 'Menunggu ACC Admin untuk Negosiasi', 'Negosiasi', 'Diterima']))
            <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
            </form>
        @endif

        <!-- Show "Terima Barang" button if the order is in the delivery state -->
        @if($order->status == 'Pengiriman')
            <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary">Terima Barang</button>
            </form>
            @if($order->nomor_resi)
                <p><strong>Nomor Resi:</strong> {{ $order->nomor_resi }}</p>
            @endif
        @endif

        <!-- Show "Download PDF" button if the order has been shipped or completed -->
        @if(in_array($order->status, ['Pengiriman', 'Selesai']))
            <a href="{{ route('order.generate_pdf', $order->id) }}" class="btn btn-success mt-3">Download PDF</a>
        @endif

        <a href="{{ route('order.history') }}" class="btn btn-secondary mt-3">Kembali ke Riwayat Pesanan</a>
    </div>
</div>
@endsection

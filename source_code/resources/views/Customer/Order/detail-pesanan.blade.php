@extends('layouts.customer.master')

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
        @if(in_array($order->status, ['Menunggu Konfirmasi Admin', 'Menunggu Konfirmasi Admin untuk Negosiasi', 'Negosiasi', 'Diterima']))
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
        @if(in_array($order->status, ['Diterima', 'Selesai']))
            <a href="{{ route('order.generate_pdf', $order->id) }}" class="btn btn-success mt-3">Download Invoice</a>
        @endif

        <!-- Upload proof of payment if order status is "Diterima" -->
        @if($order->status == 'Diterima')
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Unggah Bukti Pembayaran</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('order.upload_bukti_pembayaran', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="bukti_pembayaran">Pilih File Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" required>
                            @if ($errors->has('bukti_pembayaran'))
                                <small class="text-danger">{{ $errors->first('bukti_pembayaran') }}</small>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Unggah</button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Display proof of payment if uploaded -->
        @if($order->bukti_pembayaran)
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Bukti Pembayaran</h5>
                </div>
                <div class="card-body">
                    <p><strong>File Bukti Pembayaran:</strong></p>
                    <a href="{{ asset('uploads/bukti_pembayaran/' . $order->bukti_pembayaran) }}" target="_blank" class="btn btn-info">Lihat Bukti Pembayaran</a>
                </div>
            </div>
        @endif

        <a href="{{ route('order.history') }}" class="btn btn-secondary mt-3">Kembali ke Riwayat Pesanan</a>
    </div>
</div>
@endsection

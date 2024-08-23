@extends('layouts.customer.master')

@section('content')
<div class="container mt-5 mb-3">
    <div class="card shadow rounded border-0">
        <div class="card-header rounded border-0">
            <h2 class="mb-0">Detail Pesanan</h2>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>

<div class="container mb-5">
    <div class="card rounded border-0">
        <div class="card-body shadow">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mb-3">No Pesanan: <strong>{{ $order->id }}</strong></h4>
                    <p><strong>Status:</strong> <span class="badge bg-info text-dark">{{ $order->status }}</span></p>
                    <p><strong>Total Harga:</strong> <span class="text-success">{{ 'Rp ' . number_format($order->harga_total, 0, ',', '.') }}</span></p>
                </div>
                <div class="col-md-6 text-md-right">
                    <a href="{{ route('order.history') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali ke Riwayat Pesanan
                    </a>
                    @if(in_array($order->status, ['Diterima', 'Selesai']))
                        <a href="{{ route('order.generate_pdf', $order->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-file-download"></i> Download Invoice
                        </a>
                    @endif
                </div>
            </div>

            <h4 class="mt-4">Item Pesanan:</h4>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-right">Harga</th>
                            <th class="text-right">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->produk->nama }}</td>
                                <td class="text-center">{{ $item->jumlah }}</td>
                                <td class="text-right">{{ 'Rp ' . number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="text-right">{{ 'Rp ' . number_format($item->harga * $item->jumlah, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-light">
                        <tr>
                            <th colspan="3" class="text-right">Total</th>
                            <th class="text-right">{{ 'Rp ' . number_format($order->harga_total, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-4">
                @if($order->orderItems->contains(function($item) { return $item->produk->nego == 'ya'; }))
                    @if($order->status == 'Negosiasi' && $order->whatsapp_number)
                        <div class="alert alert-info">
                            <strong>Nomor WhatsApp untuk negosiasi:</strong> {{ $order->whatsapp_number }}
                        </div>
                    @endif
                @endif

                @if(in_array($order->status, ['Menunggu Konfirmasi Admin', 'Menunggu Konfirmasi Admin untuk Negosiasi', 'Negosiasi', 'Diterima']))
                    <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                    </form>
                @endif

                @if($order->status == 'Pengiriman')
                    <form action="{{ route('order.updateStatus', $order->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary">Terima Barang</button>
                    </form>
                    @if($order->nomor_resi)
                        <div class="mt-3">
                            <strong>Nomor Resi:</strong> {{ $order->nomor_resi }}
                        </div>
                    @endif
                @endif

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
            </div>
            
            <!-- Transaction History -->
            <div class="mt-5">
                <h4>Riwayat Transaksi</h4>
                <ul class="timeline">
                    @foreach($order->statusHistories as $history)
                        <li class="timeline-item {{ $loop->first ?  : '' }}">
                            <span class="timeline-date">{{ $history->created_at->format('d-m-Y H:i') }}</span>
                            <span class="timeline-status">{{ $history->status }}</span>
                            <span class="timeline-desc">{{ $history->description ?? '' }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection


<style>
    .timeline {
    list-style: none;
    padding: 0;
    margin: 0;
}

.timeline-item {
    position: relative;
    padding: 10px 0 10px 30px;
    margin-bottom: 10px;
}

.timeline-item.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 10px;
    width: 15px;
    height: 15px;
    background-color: #00c853;
    border-radius: 50%;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 10px;
    width: 10px;
    height: 10px;
    background-color: #bdbdbd;
    border-radius: 50%;
}

.timeline-date {
    font-size: 14px;
    color: #757575;
    margin-right: 10px;
}

.timeline-status {
    font-size: 14px;
    font-weight: bold;
    color: #616161;
}

.timeline-desc {
    font-size: 14px;
    color: #9e9e9e;
}

</style>
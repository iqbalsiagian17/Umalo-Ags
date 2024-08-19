@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Riwayat Pesanan</h1>

        @if($orders->isEmpty())
            <p>Anda belum memiliki pesanan.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal Pesanan</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->harga_total }}</td>
                            <td>
                                <a href="{{ route('order.detail', $order->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                            </td>
                            <td>
                                <a href="{{ route('order.transaction_history', $order->id) }}" class="btn btn-info btn-sm">Lihat Riwayat Transaksi</a>
                            </td>
                            <td>
                                @if(in_array($order->status, ['Diterima', 'Selesai']))
                                    <a href="{{ route('order.generate_pdf', $order->id) }}" class="btn btn-success btn-sm">Download Invoice</a>
                                    @if($order->status == 'Pengiriman' && $order->nomor_resi)
                                        <p>Nomor Resi: {{ $order->nomor_resi }}</p>
                                    @endif
                                @endif
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

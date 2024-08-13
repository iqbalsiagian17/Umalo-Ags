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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

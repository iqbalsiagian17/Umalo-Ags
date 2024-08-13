@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Pesanan</h1>

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
            <a href="{{ route('order.history') }}" class="btn btn-secondary">Back to History</a>
            @if($order->status != 'cancelled')
                <form action="{{ route('order.cancel', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                </form>
            @endif
        </div>
    </div>
@endsection

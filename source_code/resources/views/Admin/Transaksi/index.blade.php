@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Daftar Transaksi</h1>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>User</th>
                <th>Harga Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td> <!-- Display User Name -->
                <td>{{ $order->harga_total }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <a href="{{ route('transaksi.show', $order->id) }}" class="btn btn-info">Lihat</a>
                    <a href="{{ route('transaksi.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('transaksi.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

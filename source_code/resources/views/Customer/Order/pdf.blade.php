<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <style>
        /* Add your PDF-specific styling here */
    </style>
</head>
<body>
    <h1>Detail Pesanan</h1>
    <p>Pesanan ID: {{ $order->id }}</p>
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
</body>
</html>

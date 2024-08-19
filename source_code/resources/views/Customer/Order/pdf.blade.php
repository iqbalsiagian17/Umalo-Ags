<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #e74c3c;
        }
        .header p {
            margin: 0;
            font-size: 14px;
        }
        .content {
            margin-bottom: 20px;
        }
        .content p {
            margin: 5px 0;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #f2f2f2;
        }
        .invoice-table td {
            vertical-align: top;
        }
        .total {
            text-align: right;
            margin-bottom: 20px;
        }
        .total p {
            font-size: 18px;
            margin: 0;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>ARKAMAYA GUNA SAHARSA</h1>
            <p>Simplifying Industries</p>
        </div>

        <div class="content">
            <p><strong>Billed To:</strong></p>
            <p>PT. Gudang Solusi Acommerce</p>
            <p>Bizpark Jababeka, Jl. Industri Sel. Blok QQ No.6, Pasirsari, Cikarang Sel., Kabupaten Bekasi, Jawa Barat 17530</p>

            <p><strong>Date:</strong> {{ $order->created_at->format('F j, Y') }}</p>
            <p><strong>Invoice Number:</strong> {{ $order->id }}</p>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->produk->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align:right;"><strong>Subtotal</strong></td>
                    <td>Rp {{ number_format($order->harga_total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;"><strong>PPN</strong></td>
                    <td>Rp {{ number_format($order->harga_total * 0.1, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;"><strong>Total Price Include PPN</strong></td>
                    <td>Rp {{ number_format($order->harga_total + ($order->harga_total * 0.1), 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Should you require further information please do not hesitate to contact the undersigned.</p>

            <div style="margin-top: 40px;">
                <p>Kind Regards,</p>
                <p><strong>PT. Arkamaya Guna Saharsa</strong></p>
                <img src="{{ public_path('images/signature_image.png') }}" alt="Signature" style="width: 150px; height: auto;">
                <p>Agustina Panjaitan</p>
                <p>Director</p>

                <div style="margin-top: 30px;">
                    <p><strong>PT. Arkamaya Guna Saharsa</strong></p>
                    <p>Jl. Matraman Raya No.148, Blok A2 No. 3 RT.1/RW.4, Kb. Manggis, Kec. Matraman, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13150</p>
                    <p>📧 info@labtek.id | 📞 (021) 85850913</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

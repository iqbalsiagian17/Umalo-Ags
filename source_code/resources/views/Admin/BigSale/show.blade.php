@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Big Sale Details</h1>
    <p><strong>Judul:</strong> {{ $bigSale->judul }}</p>
    <p><strong>Mulai:</strong> {{ $bigSale->mulai }}</p>
    <p><strong>Berakhir:</strong> {{ $bigSale->berakhir }}</p>
    <p><strong>Status:</strong> {{ $bigSale->status ? 'Aktif' : 'Tidak Aktif' }}</p>
    <h2>Produk</h2>
    <ul>
        @foreach($bigSale->produk as $product)
        <li>{{ $product->nama }} - Harga Diskon: {{ $product->pivot->harga_diskon }}</li>
        @endforeach
    </ul>
    <a href="{{ route('bigsale.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection

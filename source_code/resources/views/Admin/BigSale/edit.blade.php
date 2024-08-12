@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Edit Big Sale</h1>
    <form action="{{ route('bigsale.update', $bigSale->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $bigSale->judul }}" required>
        </div>
        <div class="form-group">
            <label for="mulai">Mulai</label>
            <input type="datetime-local" class="form-control" id="mulai" name="mulai" value="{{ \Carbon\Carbon::parse($bigSale->mulai)->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="form-group">
            <label for="berakhir">Berakhir</label>
            <input type="datetime-local" class="form-control" id="berakhir" name="berakhir" value="{{ \Carbon\Carbon::parse($bigSale->berakhir)->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="1" {{ $bigSale->status ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ !$bigSale->status ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <div class="form-group">
            <label for="products">Produk</label>
            @foreach($products as $product)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="product-{{ $product->id }}" name="products[{{ $product->id }}]" {{ $bigSale->produk->contains($product->id) ? 'checked' : '' }}>
                <label class="form-check-label" for="product-{{ $product->id }}">{{ $product->nama }}</label>
                <input type="text" class="form-control" name="products[{{ $product->id }}_harga_diskon]" placeholder="Harga Diskon" value="{{ $bigSale->produk->contains($product->id) ? $bigSale->produk->find($product->id)->pivot->harga_diskon : '' }}">
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

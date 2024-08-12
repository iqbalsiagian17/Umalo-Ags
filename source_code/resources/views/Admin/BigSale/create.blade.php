@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Create Big Sale</h1>
    <form action="{{ route('bigsale.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>
        <div class="form-group">
            <label for="mulai">Mulai</label>
            <input type="datetime-local" class="form-control" id="mulai" name="mulai" required>
        </div>
        <div class="form-group">
            <label for="berakhir">Berakhir</label>
            <input type="datetime-local" class="form-control" id="berakhir" name="berakhir" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>
        <div class="form-group">
            <label for="products">Produk</label>
            @foreach($products as $product)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="product-{{ $product->id }}" name="products[{{ $product->id }}]" value="{{ $product->id }}">
                <label class="form-check-label" for="product-{{ $product->id }}">{{ $product->nama }}</label>
                <input type="text" class="form-control" name="harga_diskon[{{ $product->id }}]" placeholder="Harga Diskon">
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

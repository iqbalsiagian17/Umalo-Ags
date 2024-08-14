@extends('layouts.admin.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Edit Big Sale</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('bigsale.update', $bigSale->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $bigSale->judul) }}" required>
                        @if ($errors->has('judul'))
                            <small class="text-danger">{{ $errors->first('judul') }}</small>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="mulai">Mulai</label>
                        <input type="datetime-local" class="form-control" id="mulai" name="mulai" value="{{ old('mulai', \Carbon\Carbon::parse($bigSale->mulai)->format('Y-m-d\TH:i')) }}" required>
                        @if ($errors->has('mulai'))
                            <small class="text-danger">{{ $errors->first('mulai') }}</small>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="berakhir">Berakhir</label>
                        <input type="datetime-local" class="form-control" id="berakhir" name="berakhir" value="{{ old('berakhir', \Carbon\Carbon::parse($bigSale->berakhir)->format('Y-m-d\TH:i')) }}" required>
                        @if ($errors->has('berakhir'))
                            <small class="text-danger">{{ $errors->first('berakhir') }}</small>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="aktif" {{ old('status', $bigSale->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ old('status', $bigSale->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @if ($errors->has('status'))
                            <small class="text-danger">{{ $errors->first('status') }}</small>
                        @endif
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="products">Produk</label>
                        @foreach($products as $product)
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" id="product-{{ $product->id }}" name="products[{{ $product->id }}]" {{ $bigSale->produk->contains($product->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="product-{{ $product->id }}">{{ $product->nama }}</label>
                            <input type="text" class="form-control mt-2" name="products[{{ $product->id }}_harga_diskon]" placeholder="Harga Diskon" value="{{ $bigSale->produk->contains($product->id) ? old("products[{$product->id}_harga_diskon]", $bigSale->produk->find($product->id)->pivot->harga_diskon) : '' }}">
                            @if ($errors->has("products[{$product->id}_harga_diskon]"))
                                <small class="text-danger">{{ $errors->first("products[{$product->id}_harga_diskon]") }}</small>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('bigsale.index') }}" class="btn btn-secondary">Back to List</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Create Big Sale</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('bigsale.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                        @if ($errors->has('judul'))
                            <small class="text-danger">{{ $errors->first('judul') }}</small>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="mulai">Mulai</label>
                        <input type="datetime-local" class="form-control" id="mulai" name="mulai" value="{{ old('mulai') }}" required>
                        @if ($errors->has('mulai'))
                            <small class="text-danger">{{ $errors->first('mulai') }}</small>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="berakhir">Berakhir</label>
                        <input type="datetime-local" class="form-control" id="berakhir" name="berakhir" value="{{ old('berakhir') }}" required>
                        @if ($errors->has('berakhir'))
                            <small class="text-danger">{{ $errors->first('berakhir') }}</small>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @if ($errors->has('status'))
                            <small class="text-danger">{{ $errors->first('status') }}</small>
                        @endif
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="products">Produk</label>
                        @foreach($products as $product)
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" id="product-{{ $product->id }}" name="products[{{ $product->id }}]" value="{{ $product->id }}" {{ old('products.'.$product->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="product-{{ $product->id }}">{{ $product->nama }}</label>
                            <input type="text" class="form-control mt-2" name="harga_diskon[{{ $product->id }}]" placeholder="Harga Diskon" value="{{ old('harga_diskon.'.$product->id) }}">
                            @if ($errors->has('harga_diskon.'.$product->id))
                                <small class="text-danger">{{ $errors->first('harga_diskon.'.$product->id) }}</small>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('bigsale.index') }}" class="btn btn-secondary">Back to List</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

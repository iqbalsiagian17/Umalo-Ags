@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Produk</h1>
        <div class="row">
            @foreach ($produks as $item)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama }}</h5>
                            @if($item->images->isNotEmpty())
                                <div class="product-images mb-3">
                                    @foreach($item->images as $image)
                                        <img src="{{ asset($image->gambar) }}" class="img-fluid" alt="{{ $item->nama }}" style="max-width: 100px; height: auto;">
                                    @endforeach
                                </div>
                            @endif
                            <p><strong>Stok:</strong> {{ $item->stok }}</p>
                            <a href="{{ route('produk_customer.user.show', $item->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

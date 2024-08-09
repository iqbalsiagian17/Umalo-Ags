@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (auth()->user()->is_admin == 1)
                            <a href="{{ url('admin/routes') }}">Admin</a>
                        @else
                            <div class=”panel-heading”>Normal User</div>
                        @endif

                        @foreach ($produk as $item)
                            <div class="product-item mb-4">
                                <h2>{{ $item->nama }}</h2>
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
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

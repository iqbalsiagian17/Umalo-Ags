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
                            <div class="panel-heading">Normal User</div>
                        @endif

                        @foreach ($produk as $item)
                            <div class="product-item mb-4">
                                <h2>{{ $item->nama }}</h2>
                                @if ($item->images->isNotEmpty())
                                    <div class="product-images mb-3">
                                        @foreach ($item->images as $image)
                                            <img src="{{ asset($image->gambar) }}" class="img-fluid"
                                                alt="{{ $item->nama }}" style="max-width: 100px; height: auto;">
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Display the Price -->
                                <p><strong>Harga Tayang:</strong> {{ $item->harga_tayang }}</p>

                                <!-- Display the Stock -->
                                <p><strong>Stok:</strong> {{ $item->stok }}</p>

                                <!-- Quantity Input -->
                                <div class="form-group">
                                    <label for="quantity-{{ $item->id }}">Kuantitas</label>
                                    <input type="number" name="quantity" id="quantity-{{ $item->id }}"
                                        class="form-control" value="1" min="1" max="{{ $item->stok }}">
                                </div>

                                <!-- Add to Cart Button -->
                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mt-2">Masukkan Keranjang</button>
                                </form>


                                <!-- View Cart Button -->
                                <a href="{{ route('cart.view') }}" class="btn btn-warning mt-2">View Cart</a>

                                <a href="{{ route('produk_customer.user.show', $item->id) }}"
                                    class="btn btn-secondary mt-2">Lihat Detail</a>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

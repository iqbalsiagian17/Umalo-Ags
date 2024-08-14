@extends('layouts.customer.master')

@section('content')
<div class="container">
    <h1>Big Sale Products</h1>

    @if($products->isEmpty())
        <p>No products are currently on sale.</p>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if ($product->images->isNotEmpty())
                            <div class="product-images mb-3">
                                <img src="{{ asset($product->images->first()->gambar) }}" class="img-fluid"
                                     alt="{{ $product->nama }}" style="max-width: 100px; height: auto;">
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama }}</h5>
                            <p class="card-text">Original Price: Rp{{ number_format($product->harga_tayang, 2) }}</p>
                            <p class="card-text">Discounted Price: Rp{{ number_format($product->pivot->harga_diskon, 2) }}</p>
                            <a href="{{ route('produk_customer.user.show', $product->id) }}" class="btn btn-primary">View Product</a>
                            <button type="button" class="btn btn-primary mt-2 add-to-cart-btn" data-id="{{ $product->id }}">Masukkan Keranjang</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Notification for adding to cart -->
<div id="cart-notification" class="cart-notification" style="display: none;">
    <i class="fa fa-check notification-icon"></i>
    <span class="notification-text">Product added to cart!</span>
</div>

<!-- CSS for Notification -->
<style>
    .cart-notification {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 20px 30px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }
    .notification-icon {
        font-size: 30px;
        margin-right: 15px;
    }
    .notification-text {
        font-size: 18px;
    }
</style>

<!-- AJAX for Add to Cart -->
<script>
    document.querySelectorAll('.add-to-cart-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var productId = this.dataset.id;
            var token = '{{ csrf_token() }}';

            fetch('{{ route('cart.add', '') }}/' + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    quantity: 1 // Default quantity, you can customize this if needed
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display notification
                    var notification = document.getElementById('cart-notification');
                    notification.style.display = 'flex';
                    setTimeout(() => {
                        notification.style.display = 'none';
                    }, 3000);  // Notification disappears after 3 seconds
                } else {
                    alert('Failed to add product to cart: ' + (data.message || 'Unknown error.'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to add product to cart!');
            });
        });
    });
</script>
@endsection

@extends('layouts.customer.master')

@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Kategori</span>
                        </div>
                        <ul>
                            @foreach($kategori as $kategoris)
                                <li><a href="#">{{ $kategoris->nama }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do you need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div id="heroCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            
                            @foreach($slider as $index => $sliders)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="hero__item set-bg" data-setbg="{{ asset($sliders->image) }}">
                                        <div class="hero__text">
                                            <span>FRUIT FRESH</span>
                                            <h2>Vegetable 100% Organic</h2>
                                            <p>Free Pickup and Delivery Available</p>
                                            <a href="#" class="primary-btn">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    

                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body">
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
                        <button type="button" class="btn btn-primary mt-2 add-to-cart-btn" data-id="{{ $item->id }}">Masukkan Keranjang</button>

                        <!-- View Cart Button -->
                        <a href="{{ route('cart.view') }}" class="btn btn-warning mt-2">View Cart</a>

                        <a href="{{ route('produk_customer.user.show', $item->id) }}"
                            class="btn btn-secondary mt-2">Lihat Detail</a>
                    </div>
                @endforeach

                @if($bigSale)
                    <h2>{{ $bigSale->judul }}</h2>
                    <p>Mulai: {{ $bigSale->mulai }}</p>
                    <p>Berakhir: {{ $bigSale->berakhir }}</p>
                    <a href="{{ route('bigsale.now.index') }}" class="btn btn-primary">Shop</a>
                    <h3>Produk Diskon:</h3>
                    <ul>
                        @foreach($bigSale->produk as $product)
                            <li>
                                <div class="product-item mb-4">
                                    <h4>{{ $product->nama }}</h4>
                                    @if ($product->images->isNotEmpty())
                                        <div class="product-images mb-3">
                                            @foreach ($product->images as $image)
                                                <img src="{{ asset($image->gambar) }}" class="img-fluid"
                                                    alt="{{ $product->nama }}" style="max-width: 100px; height: auto;">
                                            @endforeach
                                        </div>
                                    @endif
                                    <p><strong>Diskon:</strong> Rp{{ number_format($product->pivot->harga_diskon, 0, ',', '.') }}</p>
                                     <!-- Add to Cart Button -->
                                     <button type="button" class="btn btn-primary mt-2 add-to-cart-btn" data-id="{{ $product->id }}">Masukkan Keranjang</button>

                                    <!-- View Cart Button -->
                                    <a href="{{ route('cart.view') }}" class="btn btn-warning mt-2">View Cart</a>

                                    <!-- View Detail Button -->
                                    <a href="{{ route('produk_customer.user.show', $product->id) }}"
                                        class="btn btn-secondary mt-2">Lihat Detail</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Tidak ada Big Sale yang sedang berlangsung.</p>
                @endif
                </div>
            </div>
        </div>
    </div>

    
    =======
   <!-- Notifikasi (Hidden by Default) -->
<div id="cart-notification" class="cart-notification" style="display: none;">
    <div class="notification-content">
        <div class="notification-icon">&#10003;</div>
        <div class="notification-text">Produk telah ditambahkan ke keranjang belanja</div>
    </div>
</div>

    <!-- CSS untuk Notifikasi -->
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

   <!-- AJAX untuk Add to Cart -->
<script>
    document.querySelectorAll('.add-to-cart-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var productId = this.dataset.id;
            var quantity = document.getElementById('quantity-' + productId).value;
            var token = '{{ csrf_token() }}';

            fetch('{{ route('cart.add', '') }}/' + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    quantity: quantity
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Tampilkan notifikasi
                    var notification = document.getElementById('cart-notification');
                    notification.style.display = 'flex';
                    setTimeout(() => {
                        notification.style.display = 'none';
                    }, 3000);  // Notifikasi akan hilang setelah 3 detik
                } else {
                    alert('Gagal menambahkan produk ke keranjang: ' + (data.message || 'Kesalahan tidak diketahui.'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Kuantitas total dalam keranjang melebihi stok yang tersedia!');
            });
        });
    });
</script>


    <!--Start of Tawk.to Script-->
    @if(auth()->check())
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/66b98f50146b7af4a4392fd9/1i52dfl1n';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();

    // Custom Tawk.to Configuration
    Tawk_API.onLoad = function() {
        Tawk_API.setAttributes({
            'email': "{{ auth()->user()->email }}",
        }, function(error) {});
    };

    // Function to clear cookies on logout
    function clearTawkCookies() {
        Tawk_API.endChat(); // Ends the active chat session, if any
        document.cookie = 'TawkConnectionTime=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        document.cookie = 'Tawk_66b98f50146b7af4a4392fd9=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    }

    // Attach the clearTawkCookies function to the logout process
    document.getElementById('logout-button').addEventListener('click', function() {
        clearTawkCookies();
    });
</script>
@endif

    <!--End of Tawk.to Script-->
@endsection

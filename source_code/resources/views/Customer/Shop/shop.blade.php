@extends('layouts.customer.master')

@section('content')

<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="/"><img src="{{ asset('assets/images/logo.png') }}" alt=""
                            style="width: 100%; height: 70px;"></a>
                </div>
            </div>
            {{-- <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all" id="toggleCategories">
                        <i class="fa fa-bars"></i>
                        <span>Kategori</span>
                    </div>
                    <ul id="categoriesList">
                        @foreach($kategori as $kategoris)
                        <li><a href="{{ route('shop.category', $kategoris->id) }}">{{ \Illuminate\Support\Str::limit($kategoris->nama, 25, '...') }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div> --}}
            <div class="col-lg-9">
                <div class="hero__search" style="display: flex; align-items: center;">
                    <div class="hero__search__form" style="flex: 1;">
                        <form action="#">
                            <input type="text" placeholder="Apa yang Anda butuhkan?" style="width: 100%;">
                            <button type="submit" class="site-btn rounded">Cari Disini</button>
                        </form>
                    </div>
                    <div class="header__cart" style="margin-left: 20px;">
                        <ul style="display: flex; align-items: center; list-style: none; padding: 0;">
                            {{-- <li>
                            <a href="/cart"><i class="fa fa-shopping-cart"></i> <span>3</span></a>
                        </li> --}}
                        <li>
                            <a href="/sign-in" class="site-btn" style="border-radius: 30px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user" style="margin-right: 8px; color: white;"></i>Masuk
                            </a>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4 style="color: #416bbf;">Komoditas</h4>
                        <ul>
                            @foreach($komoditas as $komoditasi)
                            <li><a href="#">{{ $komoditasi->nama }}</a></li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4 style="color:#416bbf;">Kategori</h4>
                        <ul>
                            @foreach($kategori as $kategoris)
                            <li><a href="{{ route('shop.category', $kategoris->id) }}">{{ $kategoris->nama }}</a></li>
                        @endforeach
                        </ul>
                    </div>
                    {{-- <div class="sidebar__item">
                        <h4 style="color: #416bbf;">Price</h4> <!-- Menambahkan style inline untuk warna merah -->
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content text-primary"
                                data-min="10" data-max="540">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div> --}}


                </div>
            </div>
            <div class="col-lg-9 col-md-7">

                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select id="sort-by" onchange="sortProducts()">
                                    <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                </select>
                            </div>
                        </div>


                        <script>
                            function sortProducts() {
                                var sortBy = document.getElementById('sort-by').value;
                                var url = new URL(window.location.href);
                                url.searchParams.set('sort', sortBy);
                                window.location.href = url.toString();
                            }

                            // Optional: Menyimpan pilihan sebelumnya setelah reload
                            document.addEventListener('DOMContentLoaded', function() {
                                var urlParams = new URLSearchParams(window.location.search);
                                var sortBy = urlParams.get('sort') || 'default';
                                document.getElementById('sort-by').value = sortBy;
                            });
                        </script>

                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>{{ $productCount }}</span> Produk Ditemukan</h6>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($produk as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            @php
                                $imagePath = $product->images->isNotEmpty() ? $product->images->first()->gambar : 'path/to/default/image.jpg';
                            @endphp
                            <div class="product__item__pic" style="background-image: url('{{ asset($imagePath) }}');">
                            @if($product->nego === 'ya')
                                <span class="nego-badge">Bisa Nego</span>
                             @endif
                             <ul class="product__item__pic__hover">
                                <li><a href="{{ route('produk_customer.user.show', $product->id) }}"><i class="fa fa-info-circle"></i></a></li>
                                @auth
                                    <!-- Jika pengguna sudah login -->
                                    <li><a href="#" class="add-to-cart-btn" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i></a></li>
                                @else
                                    <!-- Jika pengguna belum login -->
                                    <li><a href="{{ route('login') }}"><i class="fa fa-shopping-cart"></i></a></li>
                                @endauth
                            </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ route('produk_customer.user.show', $product->id) }}">{{ \Illuminate\Support\Str::limit($product->nama, 20, '...') }}</a></h6>
                                <h5>Rp{{ number_format($product->harga_tayang, 2) }}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="product__pagination">
                    <a href="#"><i class="fa fa-long-arrow-left"></i></a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<style>
    /* Hide the categories list by default */
    #categoriesList {
        display: none;
    }
</style>

<script>
    document.getElementById('toggleCategories').addEventListener('click', function() {
        var categoriesList = document.getElementById('categoriesList');

        if (categoriesList.style.display === 'block' || categoriesList.style.display === 'block') {
            categoriesList.style.display = 'none';
        } else {
            categoriesList.style.display = 'none';
        }
    });
</script>

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
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        var productId = this.dataset.id;
        var token = '{{ csrf_token() }}';

        fetch('{{ route('cart.add', '') }}/' + productId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                quantity: 1 // Always add 1 quantity
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
                // Show the notification
                var notification = document.getElementById('cart-notification');
                notification.style.display = 'flex';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);  // Hide the notification after 3 seconds
            } else {
                alert('Failed to add product to cart: ' + (data.message || 'Unknown error.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error adding the product to the cart.');
        });
    });
});


</script>

@endsection

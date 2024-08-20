@extends('layouts.customer.master')

@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
{{-- test --}}

        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Kategori</span>
                        </div>
                        <ul>
                            @foreach ($kategori as $kategoris)
                                <li><a
                                        href="{{ route('shop.category', $kategoris->id) }}">{{ \Illuminate\Support\Str::limit($kategoris->nama, 25, '...') }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="Search">
                                <button type="submit" class="site-btn rounded">SEARCH</button>
                            </form>
                        </div>
                    </div>
                    <div id="heroCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            @if ($slider->isEmpty())
                                <!-- If no sliders are available, show a default image -->
                                <div class="carousel-item active">
                                    <div class="hero__item set-bg rounded"
                                        data-setbg="{{ asset('assets/images/slider_default.jpg') }}">
                                        <div class="hero__text">
                                            <span></span>
                                            <h2 class="text-white">Welcome</h2>
                                            <p></p>
                                            <a href="/shop" class="primary-btn">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @foreach ($slider as $index => $sliders)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="hero__item set-bg rounded" data-setbg="{{ asset($sliders->image) }}">
                                            <div class="hero__text">
                                                <h2>{{ $sliders->deskripsi }}</h2>
                                                <a href="{{ $sliders->url }}" class="primary-btn">SHOP</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        @if ($slider->count() > 1)
                            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        @endif
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
                    @if ($bigSale)
                        <!-- Exclusive deal start -->
                        <section class="exclusive-deal-area">
                            <div class="container-fluid">
                                <div class="row justify-content-center align-items-center"
                                    style="background: url('{{ asset($bigSale->image) }}') no-repeat center center/cover; position: relative;">
                                    <div
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7);">
                                    </div>
                                    <div class="col-lg-6 no-padding exclusive-left" style="position: relative; z-index: 1;">
                                        <div class="row clock_sec clockdiv" id="clockdiv">
                                            <div class="col-lg-12 text-center"><br><br>
                                                <h2 style="color: white;">{{ $bigSale->judul }}</h2><br>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <div class="row clock-wrap" style="gap: 10px">
                                                    <div class="col clockinner1 clockinner"
                                                        style="border-radius: 20px; background-color: rgb(255, 255, 255);">
                                                        <h1 id="days" class="days" style="color: black;">00</h1>
                                                        <span class="smalltext" style="color: black;">Days</span>
                                                    </div>
                                                    <div class="col clockinner clockinner1"
                                                        style="border-radius: 20px; background-color: rgb(255, 255, 255);">
                                                        <h1 id="hours" class="hours" style="color: black;">00</h1>
                                                        <span class="smalltext" style="color: black;">Hours</span>
                                                    </div>
                                                    <div class="col clockinner clockinner1"
                                                        style="border-radius: 20px; background-color: rgb(255, 255, 255);">
                                                        <h1 id="minutes" class="minutes" style="color: black;">00</h1>
                                                        <span class="smalltext" style="color: black;">Minutes</span>
                                                    </div>
                                                    <div class="col clockinner clockinner1"
                                                        style="border-radius: 20px; background-color: rgb(255, 255, 255);">
                                                        <h1 id="seconds" class="seconds" style="color: black;">00</h1>
                                                        <span class="smalltext" style="color: black;">Seconds</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br><br>
                                        <a href="{{ route('bigsale.now.index') }}" class="primary-btn text-center"
                                            style="color: black; background-color: rgba(255, 255, 255); padding: 10px 20px; border-radius: 5px; display: block; width: fit-content; margin: 0 auto;">Shop
                                            Now</a><br><br>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Exclusive deal end -->

                        <!-- Product list start -->
                        <div class="row featured__filter mt-5" id="MixItUpD27635">
                            @foreach ($bigSale->produk as $product)
                                @php
                                    $imagePath = $product->images->isNotEmpty()
                                        ? $product->images->first()->gambar
                                        : 'path/to/default/image.jpg';
                                @endphp
                                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                                    <div class="featured__item">
                                        <div class="featured__item__pic"
                                            style="position: relative; background-image: url('{{ asset($imagePath) }}'); background-size: cover; background-position: center; border-radius: 10px;">
                                            @if ($product->nego === 'ya')
                                                <span class="nego-badge">Bisa Nego</span>
                                            @endif
                                            <ul class="featured__item__pic__hover">
                                                <li><a href="{{ route('produk_customer.user.show', $product->id) }}"><i
                                                            class="fa fa-info-circle"></i></a></li>

                                                @auth
                                                    <!-- Jika pengguna sudah login -->
                                                    <li><a href="#" class="add-to-cart-btn"
                                                            data-id="{{ $product->id }}"><i
                                                                class="fa fa-shopping-cart"></i></a></li>
                                                @else
                                                    <!-- Jika pengguna belum login -->
                                                    <li><a href="{{ route('login') }}"><i
                                                                class="fa fa-shopping-cart"></i></a></li>
                                                @endauth
                                            </ul>
                                        </div>

                                        <div class="featured__item__text">
                                            <h6><a
                                                    href="{{ route('produk_customer.user.show', $product->id) }}">{{ $product->nama }}</a>
                                            </h6>
                                            <h5>
                                                <span style="text-decoration: line-through; color: #a5a5a5;">
                                                    Rp{{ number_format($product->harga_tayang, 0, ',', '.') }}
                                                </span>
                                                <br>
                                                Rp{{ number_format($product->pivot->harga_diskon, 0, ',', '.') }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <hr>
                        <!-- Product list end -->

                        <script>
                            function startCountdown(endTime) {
                                function updateCountdown() {
                                    const now = new Date().getTime();
                                    const distance = endTime - now;

                                    if (distance < 0) {
                                        clearInterval(countdownInterval);
                                        document.getElementById('days').textContent = '00';
                                        document.getElementById('hours').textContent = '00';
                                        document.getElementById('minutes').textContent = '00';
                                        document.getElementById('seconds').textContent = '00';
                                        updateBigSaleStatus();
                                        return;
                                    }

                                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                    document.getElementById('days').textContent = String(days).padStart(2, '0');
                                    document.getElementById('hours').textContent = String(hours).padStart(2, '0');
                                    document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
                                    document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
                                }

                                const countdownInterval = setInterval(updateCountdown, 1000);
                                updateCountdown();
                            }

                            function updateBigSaleStatus() {
                                fetch('{{ route('bigsale.updateStatus', $bigSale->id) }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                    body: JSON.stringify({
                                        status: 'tidak aktif'
                                    })
                                }).then(response => {
                                    if (response.ok) {
                                        console.log('Big Sale status updated to tidak aktif.');
                                        location.reload();
                                    } else {
                                        console.error('Failed to update Big Sale status.');
                                    }
                                });
                            }

                            const bigSaleEndTime = new Date("{{ date('Y-m-d\TH:i:s', strtotime($bigSale->berakhir)) }}").getTime();
                            startCountdown(bigSaleEndTime);
                        </script>
                    @else
                    @endif
                </div>
            </div>
        </div>

        <section class="featured spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Produk Terlaris !!</h2>
                        </div>
                    </div>
                </div>

                <div class="row featured__filter" id="MixItUpD27635">
                    @foreach ($produk as $item)
                        @php
                            $imagePath = $item->images->isNotEmpty()
                                ? $item->images->first()->gambar
                                : 'path/to/default/image.jpg';
                        @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic"
                                    style="background-image: url('{{ asset($imagePath) }}'); background-size: cover; background-position: center;">
                                    @if ($item->nego === 'ya')
                                        <span class="nego-badge">Bisa Nego</span>
                                    @endif
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="{{ route('produk_customer.user.show', $item->id) }}"><i
                                                    class="fa fa-info-circle"></i></a></li>

                                        @auth
                                            <!-- Jika pengguna sudah login -->
                                            <li><a href="#" class="add-to-cart-btn" data-id="{{ $item->id }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        @else
                                            <!-- Jika pengguna belum login -->
                                            <li><a href="{{ route('login') }}"><i class="fa fa-shopping-cart"></i></a></li>
                                        @endauth
                                    </ul>
                                </div>
                                {{-- <div class="featured__item__text"> --}}

                                <div class="featured__item__text">
                                    <h6><a href="#">{{ $item->nama }}</a></h6>
                                    <h5>
                                        @if ($item->harga_ditampilkan === 'ya')
                                            Rp{{ number_format($item->harga_tayang, 0, ',', '.') }}
                                        @else
                                            Hubungi admin untuk detail harga
                                        @endif
                                        @if ($item->nego === 'ya')
                                            <span class="badge badge-success">Bisa Nego</span>
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>


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

    <!-- AJAX for Add to Cart -->
    <script>
        document.querySelectorAll('.add-to-cart-btn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default action

                var productId = this.dataset.id;
                var token = '{{ csrf_token() }}';

                fetch('{{ route('cart.add', '') }}/' + productId, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({
                            quantity: 1 // Add exactly 1 quantity
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
                            // Display notification or update cart count
                            var notification = document.getElementById('cart-notification');
                            notification.style.display = 'flex';
                            setTimeout(() => {
                                notification.style.display = 'none';
                            }, 3000); // Notification disappears after 3 seconds
                        } else {
                            alert('Failed to add product to cart: ' + (data.message ||
                                'Unknown error.'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while adding the product to the cart.');
                    });
            });
        });
    </script>


    <!--Start of Tawk.to Script-->
    @if (auth()->check())
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

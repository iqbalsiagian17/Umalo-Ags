<body>
    <!-- Page Preloder -->
    {{--   <div id="preloder">
      <div class="loader"></div>
  </div> --}}

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('assets/images/ags.png') }}" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="{{ asset('assets/img/flags/al.png') }}" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Simplifying Industries</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i>info@labtek.id</li>
                                <li>Level-Up Your Output With LABTEK</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__language">
                                <img id="language-flag" 
                                        src="{{ app()->getLocale() == 'en' 
                                                ? asset('kaiadmin-lite-1.2.0/assets/img/flags/england.png') 
                                                : asset('kaiadmin-lite-1.2.0/assets/img/flags/id.png') }}"
                                        alt="{{ app()->getLocale() == 'en' ? 'English' : 'Indonesia' }}" 
                                        data-lang="{{ app()->getLocale() }}">
                                    <div id="language-text">
                                        @if(app()->getLocale() == 'id')
                                            Bahasa
                                        @else
                                            English
                                        @endif
                                    </div>

                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="{{ route('lang.switch', 'id') }}">Indonesia</a></li>
                                    <li><a href="{{ route('lang.switch', 'en') }}">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid shadow">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="header__logo text-center mb-3">
                        <a href="/"><img src="{{ asset('assets/images/logo.png') }}" alt="" style="width: 100%; height: 100px;"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero__search mb-3">
                        <div class="hero__search__form">
                            <form action="{{ route('produk.search') }}" method="GET">
                                <input type="text" name="query" placeholder="{{ __('messages.search_product') }}" value="{{ request('query') }}">
                                <button type="submit" class="site-btn rounded">{{ __('messages.search') }}</button>
                            </form>
                        </div>
                    </div>
                </div>                
                <div class="col-lg-3">
                    <div class="header__cart mb-3">
                        <ul>
                                @if (Auth::check())
                                    <li>
                                        <a href="{{ route('cart.view') }}"><i class="fa fa-shopping-cart"></i></a>
                                    </li>
                                @endif
                                @guest
                                <li>
                                    @if (Route::has('login'))
                                        <a class="site-btn rounded" href="{{ route('login') }}">
                                            {{ __('messages.login') }}
                                        </a>
                                    @endif
                                </li>
                                
                            @else
                            <li>
                                <div class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" style="text-decoration: none; color: inherit;">
                                        <!-- Avatar Gambar -->
                                        @if (Auth::check())
                                        <img src="{{ Auth::user()->foto_profile ? asset(Auth::user()->foto_profile) : asset('assets/images/logo.png') }}" 
                                             alt="Avatar"
                                             style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 8px; border: 2px solid #ccc;">
                                    @else
                                        <!-- Tampilkan alternatif jika pengguna belum login -->
                                    @endif
                                    
                                    {{ Str::limit(explode(' ', Auth::user()->name)[0], 10) }}
                                </a>
                            
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('user.show') }}">
                                            {{ __('messages.settings') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('order.history') }}">
                                            {{ __('messages.purchase') }}                                        
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('messages.logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                            
                            
                            @endguest
                        </ul>
                    </div>
                </div>
                
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </div>
        </div>

    </header>
    <!-- Header Section End -->

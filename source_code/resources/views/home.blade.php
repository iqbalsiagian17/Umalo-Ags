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
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function () {
                var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/66b98f50146b7af4a4392fd9/1i52dfl1n';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        
            // Custom Tawk.to Configuration
            Tawk_API.onLoad = function(){
                Tawk_API.setAttributes({
                    'email' : "{{ auth()->user()->email }}", 
                }, function(error){});
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
        
            
            
    <!--End of Tawk.to Script-->
@endsection

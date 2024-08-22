@extends('layouts.customer.master')

@section('content')
   
<!-- Breadcrumb Section Begin -->
{{-- <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/images/cart.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Breadcrumb Section End -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(isset($cart) && count($cart) > 0)
        <div class="shoping__cart__table">
            <table>
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">Produk</th>
                        <th class="text-center">Gambar</th>
                        <th class="text-center">Harga Tayang</th>
                        <th class="text-center">Kuantitas</th>
                        <th class="text-center">Sub Total</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $details)
                    <tr>
                        <td class="shoping__cart__item align-middle text-center ">
                            {{ $details['name'] ?? 'Nama Produk Tidak Tersedia' }}
                        </td>
                        <td class="shoping__cart__item align-middle text-center">
                            <img src="{{ asset($details['image'] ?? 'default.png') }}" alt="{{ $details['name'] ?? 'Gambar Produk' }}" class="img-thumbnail" style="max-width: 100px;">
                        </td>
                        <td class="shoping__cart__price align-middle text-center">
                            Rp {{ number_format($details['harga_tayang'] ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="shoping__cart__quantity align-middle text-center">
                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control quantity" data-id="{{ $id }}" min="1" style="width: 60px; padding: 5px; text-align: center; margin: 0 auto;">
                        </td>
                        
                        <td class="shoping__cart__total subtotal align-middle text-center" data-id="{{ $id }}">
                            Rp {{ number_format($subtotal = ($details['harga_tayang'] ?? 0) * $details['quantity'], 0, ',', '.') }}
                        </td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    
                        @php $total += $subtotal; @endphp
                    @endforeach
                </tbody>
            </table>

            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span id="total">{{ $total }}</li>
                        </ul>
    
                        @if(auth()->user()->userDetail)
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="primary-btn">PROCEED TO CHECKOUT</button>
                            </form>
                        @else
                            <p class="text-danger">Anda harus melengkapi data pribadi Anda sebelum melanjutkan ke checkout.</p>
                            <a href="{{ route('user.create') }}" class="btn btn-primary">Isi Data Pribadi</a>
                        @endif
                    </div>
                </div>
            </div>

        @else
        <div class="card mb-3 mt-4 shadow rounded border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center" style="min-height: 300px;">
                <h5 class="mb-1">Belum Produk dalam Kerajan anda</h5>
                <a href="/" class="btn btn-primary mt-3">Belanja Sekarang</a>
            </div>
        </div>
                @endif
    </div>
    </div>
        </div>
    </div>
</div>
</section>

<script>
    document.querySelectorAll('.quantity').forEach(function(input) {
        input.addEventListener('input', function() {
            var id = this.dataset.id;
            var quantity = parseInt(this.value);

            fetch('/cart/update-quantity/' + id, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: quantity })
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      var harga = parseFloat(this.closest('tr').querySelector('.shoping__cart__price').innerText.replace(/[^0-9,-]+/g,"").replace(',', '.'));
                      var subtotalElement = this.closest('tr').querySelector('.subtotal');
                      var subtotal = quantity * harga;
                      subtotalElement.innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                      updateTotal();
                  } else {
                      alert('Kuantitas melebihi stok yang tersedia!');
                      this.value = this.getAttribute('max');  // Reset kuantitas ke stok maksimum
                  }
              });
        });
    });

    function updateTotal() {
        var total = 0;
        document.querySelectorAll('.subtotal').forEach(function(subtotalElement) {
            var subtotal = parseFloat(subtotalElement.innerText.replace(/[^0-9,-]+/g,"").replace(',', '.'));
            total += subtotal;
        });
        document.getElementById('total').innerText = 'Rp ' + total.toLocaleString('id-ID');
    }
</script>

@endsection



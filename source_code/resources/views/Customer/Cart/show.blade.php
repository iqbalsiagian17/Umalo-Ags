@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Keranjang Belanja</h1>

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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Gambar</th>
                        <th>Harga Tayang</th>
                        <th>Kuantitas</th>
                        <th>Sub Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $details)
                        <tr>
                            <td>{{ $details['name'] ?? 'Nama Produk Tidak Tersedia' }}</td>
                            <td>
                                <img src="{{ asset($details['image'] ?? 'default.png') }}" alt="{{ $details['name'] ?? 'Gambar Produk' }}" style="max-width: 100px; height: auto;">
                            </td>
                            <td>{{ $details['harga_tayang'] ?? 'Harga Tidak Tersedia' }}</td>
                            <td>
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control quantity" data-id="{{ $id }}" min="1">
                            </td>
                            <td class="subtotal" data-id="{{ $id }}">{{ $subtotal = ($details['harga_tayang'] ?? 0) * $details['quantity'] }}</td>
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

            <div class="text-right">
                @if(auth()->user()->userDetail)
                <h3>Total: <span id="total">{{ $total }}</span></h3>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Checkout</button>
                </form>
                @else
                <p class="text-danger">Anda harus melengkapi data pribadi Anda sebelum melanjutkan ke checkout.</p>
                <a href="{{ route('user.create') }}" class="btn btn-primary">Isi Data Pribadi</a>
            @endif

            </div>
            
        @else
            <div class="alert alert-warning">Keranjang belanja kosong.</div>
        @endif
        <div class="text-right">
            <a href="{{ url('home') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

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
                          var harga = parseFloat(this.closest('tr').querySelector('td:nth-child(3)').innerText);
                          var subtotalElement = this.closest('tr').querySelector('.subtotal');
                          var subtotal = quantity * harga;
                          subtotalElement.innerText = subtotal;
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
                total += parseFloat(subtotalElement.innerText);
            });
            document.getElementById('total').innerText = total;
        }
    </script>
@endsection



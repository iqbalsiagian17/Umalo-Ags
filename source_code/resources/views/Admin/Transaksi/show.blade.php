@extends('layouts.admin.master')

@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- First Card: Transaction Information -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title"><h2>Detail Transaksi</h2></div>
                <div class="form-group">
                    <label class="form-label">Status:</label>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="status" value="pending" class="selectgroup-input" {{ $order->status == 'pending' ? 'checked' : '' }} />
                            <span class="selectgroup-button">Pending</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="status" value="completed" class="selectgroup-input" {{ $order->status == 'completed' ? 'checked' : '' }} />
                            <span class="selectgroup-button">Completed</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="status" value="cancelled" class="selectgroup-input" {{ $order->status == 'cancelled' ? 'checked' : '' }} />
                            <span class="selectgroup-button">Cancelled</span>
                        </label>
                    </div>
                    @if ($errors->has('status'))
                        <small class="text-danger">{{ $errors->first('status') }}</small>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Bagian</th>
                            <th scope="col">Informasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Transaksi ID</td>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td>User ID</td>
                            <td>{{ $order->user_id }}</td>
                        </tr>
                        <tr>
                            <td>Harga Total</td>
                            <td>{{ 'Rp ' . number_format($order->harga_total, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <!-- Second Card: Transaction Items -->
        <div class="card mb-4">
            <div class="card-header">
                <div class="card-title"><h2>Item Transaksi</h2></div>
            </div>
            <div class="card-body">
                @if($order->orderItems && $order->orderItems->isNotEmpty())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produk ID</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->produk_id }}</td>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ 'Rp ' . number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ 'Rp ' . number_format($item->jumlah * $item->harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No Transaction Items Available</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="mt-4">
    @php
        $negotiable = $order->orderItems->contains(function($item) {
            return $item->produk->nego == 'ya';
        });
    @endphp

    <form id="statusForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" id="statusInput" value="{{ $order->status }}">
        <!-- Tracking Number Input -->
        @if($order->status == 'Packing')
            <div class="form-group">
                <label for="nomor_resi">Nomor Resi (Tracking Number)</label>
                <input type="text" name="nomor_resi" id="nomor_resi" class="form-control" placeholder="Enter Tracking Number">
            </div>
        @endif

        <!-- WhatsApp Number Input -->
        <div class="form-group" id="whatsappGroup" style="display: none;">
            <label for="whatsapp_number">Nomor WhatsApp</label>
            <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control">
            @if ($errors->has('whatsapp_number'))
                <small class="text-danger">{{ $errors->first('whatsapp_number') }}</small>
            @endif
        </div>

        <!-- Cancel Button -->
        <button type="button" name="action" value="cancel" class="btn btn-danger" onclick="cancelOrder()">Cancel</button>

        <!-- Dynamic Buttons -->
        @if($negotiable)
            @if($order->status == 'Menunggu ACC Admin untuk Negosiasi')
                <button type="button" id="accButton" class="btn btn-success" onclick="prepareNegosiasi()">ACC</button>
            @elseif($order->status == 'Negosiasi')
                <button type="button" id="nextButton" class="btn btn-primary" onclick="updateStatus('Diterima')">Update</button>
            @elseif($order->status == 'Diterima')
                <button type="button" id="nextButton" class="btn btn-primary" onclick="updateStatus('Packing')">Update</button>
            @elseif($order->status == 'Packing')
                <button type="button" id="nextButton" class="btn btn-primary" onclick="updateStatus('Pengiriman')">Update</button>
            @elseif($order->status == 'Pengiriman')
                <button type="button" id="nextButton" class="btn btn-primary" onclick="updateStatus('Selesai')">Selesai</button>
            @endif
        @else
            @if($order->status == 'Menunggu ACC Admin')
                <button type="button" id="accButton" class="btn btn-success" onclick="updateStatus('Diterima')">ACC</button>
            @elseif($order->status == 'Diterima')
                <button type="button" id="nextButton" class="btn btn-primary" onclick="updateStatus('Packing')">Update</button>
            @elseif($order->status == 'Packing')
                <button type="button" id="nextButton" class="btn btn-primary" onclick="updateStatus('Pengiriman')">Update</button>
            @elseif($order->status == 'Pengiriman')
                <button type="button" id="nextButton" class="btn btn-primary" onclick="updateStatus('Selesai')">Selesai</button>
            @endif
        @endif
    </form>
</div>


<a href="{{ route('transaksi.index') }}" class="btn btn-primary mt-3">Kembali</a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function prepareNegosiasi() {
        $('#statusInput').val('Negosiasi');
        $('#whatsappGroup').show();
        $('#accButton').text('Kirim WA dan ACC');
        $('#accButton').attr('onclick', 'submitForm()');
    }

    function updateStatus(newStatus) {
        $('#statusInput').val(newStatus);

        if (newStatus === 'Pengiriman') {
            // Prompt the user to enter the tracking number (nomor resi) before proceeding
            let nomorResi = prompt("Please enter the tracking number (Nomor Resi):");

            if (nomorResi) {
                $('#nomor_resi').val(nomorResi);  // Set the tracking number in the hidden input field
                submitForm();
            } else {
                alert('Tracking number is required to update status to Pengiriman.');
            }
        } else {
            submitForm();
        }
    }

    function cancelOrder() {
        $('#statusInput').val('Cancelled');
        submitForm();
    }

    function submitForm() {
        $.ajax({
            url: '{{ route("transaksi.update", $order->id) }}',
            method: 'PUT',
            data: $('#statusForm').serialize(),
            success: function(response) {
                if (response.success) {
                    alert(response.message);

                    let currentStatus = $('#statusInput').val();
                    let nextStatusMap = {
                        'Menunggu ACC Admin': 'Diterima',
                        'Menunggu ACC Admin untuk Negosiasi': 'Negosiasi',
                        'Negosiasi': 'Diterima',
                        'Diterima': 'Packing',
                        'Packing': 'Pengiriman',
                        'Pengiriman': 'Selesai'
                    };

                    if (nextStatusMap[currentStatus]) {
                        let nextStatus = nextStatusMap[currentStatus];
                        $('#statusInput').val(nextStatus);
                        $('#nextButton').text(`Update to ${nextStatus}`)
                            .attr('onclick', `updateStatus('${nextStatus}')`);
                        $('#whatsappGroup').hide();

                        if (currentStatus === 'Negosiasi') {
                            $('#accButton').remove();
                            $('#statusForm').append('<button type="button" id="nextButton" class="btn btn-primary" onclick="updateStatus(\'Diterima\')">Update to Diterima</button>');
                        } else if (currentStatus === 'Diterima') {
                            $('#nextButton').text('Update to Packing')
                                .attr('onclick', 'updateStatus("Packing")')
                                .removeClass('btn-primary')
                                .addClass('btn-primary');
                        } else if (currentStatus === 'Packing') {
                            $('#nextButton').text('Update to Pengiriman')
                                .attr('onclick', 'updateStatus("Pengiriman")');
                        } else if (currentStatus === 'Pengiriman') {
                            $('#nextButton').text('Selesai')
                                .attr('onclick', 'updateStatus("Selesai")');
                        } else if (currentStatus === 'Selesai') {
                            $('#nextButton').remove();
                            alert('Order has been completed.');
                        }
                    }
                } else {
                    alert('Failed to update the status. Please try again.');
                }
            },
            error: function(xhr) {
                alert('An error occurred while updating the status. Please try again.');
            }
        });
    }
</script>

@endsection

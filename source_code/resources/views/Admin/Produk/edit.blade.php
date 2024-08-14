@extends('layouts.admin.master')

@section('content')

    <!-- Tampilkan semua pesan error di atas form -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">
                    <h1>Edit Produk</h1>
                </div>
                <div class="form-group">
                    <label class="form-label">Status:</label>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="status" value="arsip" class="selectgroup-input" {{ $produk->status == 'arsip' ? 'checked' : '' }} />
                            <span class="selectgroup-button">Arsip</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="status" value="publish" class="selectgroup-input" {{ $produk->status == 'publish' ? 'checked' : '' }} />
                            <span class="selectgroup-button">Publish</span>
                        </label>
                    </div>
                    @if ($errors->has('status'))
                        <small class="text-danger">{{ $errors->first('status') }}</small>
                    @endif
                </div>
            </div>
            
            <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama">Nama Produk:</label>
                    <input type="text" name="nama" class="form-control" value="{{ $produk->nama }}" required>
                    @if ($errors->has('nama'))
                        <small class="text-danger">{{ $errors->first('nama') }}</small>
                    @endif
                </div>
            </div>

            <!-- Nego Option -->
            <div class="form-group">
                <label for="nego">Bisa Nego:</label>
                <select name="nego" class="form-control" required>
                    <option value="no" {{ old('nego', $produk->nego) == 'no' ? 'selected' : '' }}>Tidak</option>
                    <option value="yes" {{ old('nego', $produk->nego) == 'yes' ? 'selected' : '' }}>Ya</option>
                </select>
                @if ($errors->has('nego'))
                    <small class="text-danger">{{ $errors->first('nego') }}</small>
                @endif
            </div>
            
            <!-- Komoditas -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tipe_barang">Tipe Barang:</label>
                    <input type="text" name="tipe_barang" class="form-control" value="{{ $produk->tipe_barang }}" required>
                    @if ($errors->has('tipe_barang'))
                        <small class="text-danger">{{ $errors->first('tipe_barang') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="komoditas_id">Komoditas:</label>
                <select name="komoditas_id" class="form-control" required>
                    @foreach($komoditas as $k)
                        <option value="{{ $k->id }}" {{ $produk->komoditas_id == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
                @if ($errors->has('komoditas_id'))
                    <small class="text-danger">{{ $errors->first('komoditas_id') }}</small>
                @endif
            </div>
        </div>

            <!-- Kategori -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="kategori_id">Kategori:</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('kategori_id'))
                        <small class="text-danger">{{ $errors->first('kategori_id') }}</small>
                    @endif
                </div>
            </div>
            <!-- Sub Kategori -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sub_kategori_id">Sub Kategori:</label>
                    <select name="sub_kategori_id" id="sub_kategori_id" class="form-control" required>
                        <option value="">Pilih Sub Kategori</option>
                        <!-- Sub kategori akan dimuat melalui AJAX -->
                    </select>
                    @if ($errors->has('sub_kategori_id'))
                        <small class="text-danger">{{ $errors->first('sub_kategori_id') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Tipe Barang -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="uji_fungsi">Uji Fungsi:</label>
                    <input type="text" name="uji_fungsi" class="form-control" value="{{ old('uji_fungsi', $produk->uji_fungsi) }}" required>
                    @if ($errors->has('uji_fungsi'))
                        <small class="text-danger">{{ $errors->first('uji_fungsi') }}</small>
                    @endif
                </div>
            </div>
            <!-- Stok -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
                    @if ($errors->has('stok'))
                        <small class="text-danger">{{ $errors->first('stok') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Masa Berlaku Produk -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="masa_berlaku_produk">Masa Berlaku Produk:</label>
                    <input type="date" name="masa_berlaku_produk" class="form-control" value="{{ $produk->masa_berlaku_produk }}" required>
                    @if ($errors->has('masa_berlaku_produk'))
                        <small class="text-danger">{{ $errors->first('masa_berlaku_produk') }}</small>
                    @endif
                </div>
            </div>
            <!-- Merk -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="merk">Merk:</label>
                    <input type="text" name="merk" class="form-control" value="{{ $produk->merk }}" required>
                    @if ($errors->has('merk'))
                        <small class="text-danger">{{ $errors->first('merk') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- No Produk Penyedia -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_produk_penyedia">No Produk Penyedia:</label>
                    <input type="text" name="no_produk_penyedia" class="form-control" value="{{ $produk->no_produk_penyedia }}" required>
                    @if ($errors->has('no_produk_penyedia'))
                        <small class="text-danger">{{ $errors->first('no_produk_penyedia') }}</small>
                    @endif
                </div>
            </div>
            <!-- Unit Pengukuran -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="unit_pengukuran">Unit Pengukuran:</label>
                    <input type="text" name="unit_pengukuran" class="form-control" value="{{ $produk->unit_pengukuran }}" required>
                    @if ($errors->has('unit_pengukuran'))
                        <small class="text-danger">{{ $errors->first('unit_pengukuran') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Jenis Produk -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="jenis_produk">Jenis Produk:</label>
                    <select name="jenis_produk" class="form-control" required>
                        <option value="PDN" {{ $produk->jenis_produk == 'PDN' ? 'selected' : '' }}>PDN</option>
                        <option value="Impor" {{ $produk->jenis_produk == 'Impor' ? 'selected' : '' }}>Impor</option>
                    </select>
                    @if ($errors->has('jenis_produk'))
                        <small class="text-danger">{{ $errors->first('jenis_produk') }}</small>
                    @endif
                </div>
            </div>
            <!-- Kode KBLI -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kode_kbli">Kode KBLI:</label>
                    <input type="number" name="kode_kbli" class="form-control" value="{{ $produk->kode_kbli }}" required>
                    @if ($errors->has('kode_kbli'))
                        <small class="text-danger">{{ $errors->first('kode_kbli') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Asal Negara -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="asal_negara">Asal Negara:</label>
                    <input type="text" name="asal_negara" class="form-control" value="{{ $produk->asal_negara }}" required>
                    @if ($errors->has('asal_negara'))
                        <small class="text-danger">{{ $errors->first('asal_negara') }}</small>
                    @endif
                </div>
            </div>
            <!-- Nilai TKDN -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nilai_tkdn">Nilai TKDN:</label>
                    <input type="number" step="0.01" name="nilai_tkdn" class="form-control" value="{{ $produk->nilai_tkdn }}" required>
                    @if ($errors->has('nilai_tkdn'))
                        <small class="text-danger">{{ $errors->first('nilai_tkdn') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- SNI -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sni">SNI:</label>
                    <select name="sni" class="form-control" required>
                        <option value="ya" {{ $produk->sni == 'ya' ? 'selected' : '' }}>Ya</option>
                        <option value="tidak" {{ $produk->sni == 'tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @if ($errors->has('sni'))
                        <small class="text-danger">{{ $errors->first('sni') }}</small>
                    @endif
                </div>
            </div>
            <!-- No SNI -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_sni">No SNI:</label>
                    <input type="text" name="no_sni" class="form-control" value="{{ $produk->no_sni }}">
                    @if ($errors->has('no_sni'))
                        <small class="text-danger">{{ $errors->first('no_sni') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Memiliki SVLK -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="memiliki_svlk">Memiliki SVLK:</label>
                    <select name="memiliki_svlk" class="form-control" required>
                        <option value="ya" {{ $produk->memiliki_svlk == 'ya' ? 'selected' : '' }}>Ya</option>
                        <option value="tidak" {{ $produk->memiliki_svlk == 'tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @if ($errors->has('memiliki_svlk'))
                        <small class="text-danger">{{ $errors->first('memiliki_svlk') }}</small>
                    @endif
                </div>
            </div>
            <!-- Jenis Alat -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="jenis_alat">Jenis Alat:</label>
                    <input type="text" name="jenis_alat" class="form-control" value="{{ $produk->jenis_alat }}" required>
                    @if ($errors->has('jenis_alat'))
                        <small class="text-danger">{{ $errors->first('jenis_alat') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Fungsi -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fungsi">Fungsi:</label>
                    <input type="text" name="fungsi" class="form-control" value="{{ $produk->fungsi }}" required>
                    @if ($errors->has('fungsi'))
                        <small class="text-danger">{{ $errors->first('fungsi') }}</small>
                    @endif
                </div>
            </div>
            <!-- Spesifikasi Produk -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="spesifikasi_produk">Spesifikasi Produk:</label>
                    <textarea name="spesifikasi_produk" class="form-control" required>{{ $produk->spesifikasi_produk }}</textarea>
                    @if ($errors->has('spesifikasi_produk'))
                        <small class="text-danger">{{ $errors->first('spesifikasi_produk') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Harga Tayang -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="harga_tayang">Harga Tayang:</label>
                    <input type="number" step="0.01" name="harga_tayang" class="form-control" value="{{ $produk->harga_tayang }}" required>
                    @if ($errors->has('harga_tayang'))
                        <small class="text-danger">{{ $errors->first('harga_tayang') }}</small>
                    @endif
                </div>
            </div>
            <!-- Gambar Produk -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="garansi_produk">Garansi Produk:</label>
                    <input type="text" name="garansi_produk" class="form-control" value="{{ old('garansi_produk', $produk->garansi_produk) }}" required>
                    @if ($errors->has('garansi_produk'))
                        <small class="text-danger">{{ $errors->first('garansi_produk') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="gambar">Gambar Produk:</label>
            <input type="file" name="gambar[]" id="gambar[]" class="form-control" multiple>
            <div class="mt-2">
                @foreach($produk->images as $image)
                    <img src="{{ asset($image->gambar) }}" alt="Gambar Produk" style="width: 100px; height: 100px; margin-right: 10px;">
                @endforeach
            </div>
        </div>

        <div id="detail-list-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk List</th>
                        <th>Spesifikasi Produk List</th>
                        <th>Merk Produk List</th>
                        <th>Tipe Produk List</th>
                        <th>Jumlah Produk List</th>
                        <th>Satuan Produk List</th>
                        <th>Harga Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produk->produkList as $detail)
                        <tr class="detail-list">
                            <td class="numbering">1</td> 
                            <td><input type="text" name="detail[nama][]" class="form-control" value="{{ $detail->nama }}"></td>
                            <td><textarea name="detail[spesifikasi][]" class="form-control">{{ $detail->spesifikasi }}</textarea></td>
                            <td><input type="text" name="detail[merk][]" class="form-control" value="{{ $detail->merk }}"></td>
                            <td><input type="text" name="detail[tipe][]" class="form-control" value="{{ $detail->tipe }}"></td>
                            <td><input type="number" name="detail[jumlah][]" class="form-control" value="{{ $detail->jumlah }}"></td>
                            <td>
                                <select name="detail[satuan][]" class="form-control">
                                    <option value="Set" {{ $detail->satuan == 'Set' ? 'selected' : '' }}>Set</option>
                                    <option value="Paket" {{ $detail->satuan == 'Paket' ? 'selected' : '' }}>Paket</option>
                                </select>
                            </td>
                            <td><input type="number" step="0.01" name="detail[harga_satuan][]" class="form-control" value="{{ $detail->harga_satuan }}"></td>
                            <td><button type="button" class="btn btn-danger remove-detail">Hapus</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-secondary mt-3" id="add-detail">Tambah Detail</button>
        </div>
        <button type="submit" class="btn btn-primary mb-5 mt-3">Simpan</button>
    </div>
    </div>

    </form>

    <script>
        document.getElementById('add-detail').addEventListener('click', function() {
            var detailListContainer = document.querySelector('#detail-list-container tbody');
            var detailList = document.createElement('tr');
            detailList.classList.add('detail-list');
    
            detailList.innerHTML = `
                <td class="numbering"></td> <!-- Numbering Cell -->
                <td><input type="text" name="detail[nama][]" class="form-control"></td>
                <td><textarea name="detail[spesifikasi][]" class="form-control"></textarea></td>
                <td><input type="text" name="detail[merk][]" class="form-control"></td>
                <td><input type="text" name="detail[tipe][]" class="form-control"></td>
                <td><input type="number" name="detail[jumlah][]" class="form-control"></td>
                <td>
                    <select name="detail[satuan][]" class="form-control">
                        <option value="Set">Set</option>
                        <option value="Paket">Paket</option>
                    </select>
                </td>
                <td><input type="number" step="0.01" name="detail[harga_satuan][]" class="form-control"></td>
                <td><button type="button" class="btn btn-danger remove-detail">Hapus</button></td>
            `;
            detailListContainer.appendChild(detailList);
    
            updateNumbering();
    
            // Add event listener to the newly added remove button
            detailList.querySelector('.remove-detail').addEventListener('click', function() {
                this.closest('tr').remove();
                updateNumbering();
            });
        });
    
        // Function to update numbering
        function updateNumbering() {
            const rows = document.querySelectorAll('#detail-list-container tbody .detail-list');
            rows.forEach((row, index) => {
                row.querySelector('.numbering').textContent = index + 1;
            });
        }
    
        // Initial call to set up numbering
        updateNumbering();
    
        // Add event listener to the initial remove buttons
        document.querySelectorAll('.remove-detail').forEach(function(button) {
            button.addEventListener('click', function() {
                this.closest('tr').remove();
                updateNumbering();
            });
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var kategoriSelect = document.getElementById('kategori_id');
        var subKategoriSelect = document.getElementById('sub_kategori_id');

        // Function to load sub categories
        function loadSubKategoris(kategoriId, selectedSubKategoriId = null) {
            subKategoriSelect.innerHTML = '<option value="">Memuat...</option>';

            fetch(`/admin/produk/getSubKategori/${kategoriId}`)
                .then(response => response.json())
                .then(data => {
                    subKategoriSelect.innerHTML = '<option value="">Pilih Sub Kategori</option>';
                    data.forEach(function(subKategori) {
                        var option = document.createElement('option');
                        option.value = subKategori.id;
                        option.textContent = subKategori.nama;
                        if (subKategori.id == selectedSubKategoriId) {
                            option.selected = true;
                        }
                        subKategoriSelect.appendChild(option);
                    });
                });
        }

        // Initial load of sub categories based on the selected kategori
        if (kategoriSelect.value) {
            loadSubKategoris(kategoriSelect.value, '{{ $produk->sub_kategori_id }}');
        }

        // Event listener for kategori change
        kategoriSelect.addEventListener('change', function() {
            loadSubKategoris(this.value);
        });
    });
</script>

<script>
    document.querySelectorAll('input[name="status"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            var status = this.value;
            var productId = "{{ $produk->id }}";  // Pass the product ID to use in the request

            fetch(`/produk/update-status/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({status: status})
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('Status berhasil diperbarui');
                } else {
                    alert('Gagal memperbarui status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui status');
            });
        });
    });
</script>

@endsection

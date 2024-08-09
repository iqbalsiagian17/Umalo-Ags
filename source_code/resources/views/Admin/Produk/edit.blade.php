@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Produk</h1>
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" class="form-control" value="{{ $produk->nama }}" required>
        </div>
        <div class="form-group">
            <label for="tipe_barang">Tipe Barang:</label>
            <input type="text" name="tipe_barang" class="form-control" value="{{ $produk->tipe_barang }}" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
        </div>
        <div class="form-group">
            <label for="masa_berlaku_produk">Masa Berlaku Produk:</label>
            <input type="date" name="masa_berlaku_produk" class="form-control" value="{{ $produk->masa_berlaku_produk }}" required>
        </div>
        <div class="form-group">
            <label for="merk">Merk:</label>
            <input type="text" name="merk" class="form-control" value="{{ $produk->merk }}" required>
        </div>
        <div class="form-group">
            <label for="no_produk_penyedia">No Produk Penyedia:</label>
            <input type="text" name="no_produk_penyedia" class="form-control" value="{{ $produk->no_produk_penyedia }}" required>
        </div>
        <div class="form-group">
            <label for="unit_pengukuran">Unit Pengukuran:</label>
            <input type="text" name="unit_pengukuran" class="form-control" value="{{ $produk->unit_pengukuran }}" required>
        </div>
        <div class="form-group">
            <label for="jenis_produk">Jenis Produk:</label>
            <select name="jenis_produk" class="form-control" required>
                <option value="PDN" {{ $produk->jenis_produk == 'PDN' ? 'selected' : '' }}>PDN</option>
                <option value="Impor" {{ $produk->jenis_produk == 'Impor' ? 'selected' : '' }}>Impor</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kode_kbli">Kode KBLI:</label>
            <input type="number" name="kode_kbli" class="form-control" value="{{ $produk->kode_kbli }}" required>
        </div>
        <div class="form-group">
            <label for="asal_negara">Asal Negara:</label>
            <input type="text" name="asal_negara" class="form-control" value="{{ $produk->asal_negara }}" required>
        </div>
        <div class="form-group">
            <label for="nilai_tkdn">Nilai TKDN:</label>
            <input type="number" step="0.01" name="nilai_tkdn" class="form-control" value="{{ $produk->nilai_tkdn }}" required>
        </div>
        <div class="form-group">
            <label for="no_sni">No SNI:</label>
            <input type="text" name="no_sni" class="form-control" value="{{ $produk->no_sni }}" required>
        </div>
        <div class="form-group">
            <label for="garansi_produk">Garansi Produk:</label>
            <input type="text" name="garansi_produk" class="form-control" value="{{ $produk->garansi_produk }}" required>
        </div>
        <div class="form-group">
            <label for="uji_fungsi">Uji Fungsi:</label>
            <input type="text" name="uji_fungsi" class="form-control" value="{{ $produk->uji_fungsi }}" required>
        </div>
        <div class="form-group">
            <label for="sni">SNI:</label>
            <select name="sni" class="form-control" required>
                <option value="ya" {{ $produk->sni == 'ya' ? 'selected' : '' }}>Ya</option>
                <option value="tidak" {{ $produk->sni == 'tidak' ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
        <div class="form-group">
            <label for="memiliki_svlk">Memiliki SVLK:</label>
            <select name="memiliki_svlk" class="form-control" required>
                <option value="ya" {{ $produk->memiliki_svlk == 'ya' ? 'selected' : '' }}>Ya</option>
                <option value="tidak" {{ $produk->memiliki_svlk == 'tidak' ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jenis_alat">Jenis Alat:</label>
            <input type="text" name="jenis_alat" class="form-control" value="{{ $produk->jenis_alat }}" required>
        </div>
        <div class="form-group">
            <label for="fungsi">Fungsi:</label>
            <input type="text" name="fungsi" class="form-control" value="{{ $produk->fungsi }}" required>
        </div>
        <div class="form-group">
            <label for="spesifikasi_produk">Spesifikasi Produk:</label>
            <textarea name="spesifikasi_produk" class="form-control" required>{{ $produk->spesifikasi_produk }}</textarea>
        </div>
        <div class="form-group">
            <label for="harga_tayang">Harga Tayang:</label>
            <input type="number" step="0.01" name="harga_tayang" class="form-control" value="{{ $produk->harga_tayang }}" required>
        </div>
        <div class="form-group">
            <label for="komoditas_id">Komoditas:</label>
            <select name="komoditas_id" class="form-control" required>
                @foreach($komoditas as $k)
                    <option value="{{ $k->id }}" {{ $produk->komoditas_id == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kategori_id">Kategori:</label>
            <select name="kategori_id" id="kategori_id" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="sub_kategori_id">Sub Kategori:</label>
            <select name="sub_kategori_id" id="sub_kategori_id" class="form-control" required>
                <option value="">Pilih Sub Kategori</option>
                <!-- Sub kategori akan dimuat melalui AJAX -->
            </select>
        </div>
        <div class="form-group">
            <label for="gambar">Gambar Produk:</label>
            <input type="file" name="gambar[]" id="gambar[]" class="form-control" multiple>
            @foreach($produk->images as $image)
                <img src="{{ asset($image->gambar) }}" alt="Gambar Produk" style="width: 100px; height: 100px;">
            @endforeach
        </div>

        <h2 class="mt-5">Detail Produk List</h2>
        <div id="detail-list-container">
            @foreach($produk->produkList as $detail)
            <div class="form-group detail-list">
                <label for="nama_list">Nama Produk List:</label>
                <input type="text" name="detail[nama][]" class="form-control" value="{{ $detail->nama }}">
                <label for="spesifikasi_list">Spesifikasi Produk List:</label>
                <textarea name="detail[spesifikasi][]" class="form-control">{{ $detail->spesifikasi }}</textarea>
                <label for="merk_list">Merk Produk List:</label>
                <input type="text" name="detail[merk][]" class="form-control" value="{{ $detail->merk }}">
                <label for="tipe_list">Tipe Produk List:</label>
                <input type="text" name="detail[tipe][]" class="form-control" value="{{ $detail->tipe }}">
                <label for="jumlah_list">Jumlah Produk List:</label>
                <input type="number" name="detail[jumlah][]" class="form-control" value="{{ $detail->jumlah }}">
                <label for="satuan_list">Satuan Produk List:</label>
                <input type="text" name="detail[satuan][]" class="form-control" value="{{ $detail->satuan }}">
                <label for="harga_satuan">Harga Satuan:</label>
                <input type="number" step="0.01" name="detail[harga_satuan][]" class="form-control" value="{{ $detail->harga_satuan }}">
                <hr>
            </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-secondary mt-3" id="add-detail">Tambah Detail</button>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>

<script>
document.getElementById('add-detail').addEventListener('click', function() {
    var detailListContainer = document.getElementById('detail-list-container');
    var detailList = document.createElement('div');
    detailList.classList.add('form-group', 'detail-list');
    detailList.innerHTML = `
        <label for="nama_list">Nama Produk List:</label>
        <input type="text" name="detail[nama][]" class="form-control">
        <label for="spesifikasi_list">Spesifikasi Produk List:</label>
        <textarea name="detail[spesifikasi][]" class="form-control"></textarea>
        <label for="merk_list">Merk Produk List:</label>
        <input type="text" name="detail[merk][]" class="form-control">
        <label for="tipe_list">Tipe Produk List:</label>
        <input type="text" name="detail[tipe][]" class="form-control">
        <label for="jumlah_list">Jumlah Produk List:</label>
        <input type="number" name="detail[jumlah][]" class="form-control">
        <label for="satuan_list">Satuan Produk List:</label>
        <input type="text" name="detail[satuan][]" class="form-control">
        <label for="harga_satuan">Harga Satuan:</label>
        <input type="number" step="0.01" name="detail[harga_satuan][]" class="form-control">
        <hr>
    `;
    detailListContainer.appendChild(detailList);
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
@endsection
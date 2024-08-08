@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Tambah Produk</h1>
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tipe_barang">Tipe Barang:</label>
            <input type="text" name="tipe_barang" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="masa_berlaku_produk">Masa Berlaku Produk:</label>
            <input type="date" name="masa_berlaku_produk" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="merk">Merk:</label>
            <input type="text" name="merk" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="no_produk_penyedia">No Produk Penyedia:</label>
            <input type="text" name="no_produk_penyedia" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="unit_pengukuran">Unit Pengukuran:</label>
            <input type="text" name="unit_pengukuran" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jenis_produk">Jenis Produk:</label>
            <select name="jenis_produk" class="form-control" required>
                <option value="PDN">PDN</option>
                <option value="Impor">Impor</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kode_kbli">Kode KBLI:</label>
            <input type="number" name="kode_kbli" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="asal_negara">Asal Negara:</label>
            <input type="text" name="asal_negara" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nilai_tkdn">Nilai TKDN:</label>
            <input type="number" step="0.01" name="nilai_tkdn" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="no_sni">No SNI:</label>
            <input type="text" name="no_sni" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="garansi_produk">Garansi Produk:</label>
            <input type="text" name="garansi_produk" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="uji_fungsi">Uji Fungsi:</label>
            <input type="text" name="uji_fungsi" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="sni">SNI:</label>
            <select name="sni" class="form-control" required>
                <option value="ya">Ya</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>
        <div class="form-group">
            <label for="memiliki_svlk">Memiliki SVLK:</label>
            <select name="memiliki_svlk" class="form-control" required>
                <option value="ya">Ya</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jenis_alat">Jenis Alat:</label>
            <input type="text" name="jenis_alat" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fungsi">Fungsi:</label>
            <input type="text" name="fungsi" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="spesifikasi_produk">Spesifikasi Produk:</label>
            <textarea name="spesifikasi_produk" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="harga_tayang">Harga Tayang:</label>
            <input type="number" step="0.01" name="harga_tayang" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="komoditas_id">Komoditas:</label>
            <select name="komoditas_id" class="form-control" required>
                @foreach($komoditas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kategori_id">Kategori:</label>
            <select name="kategori_id" id="kategori_id" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
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
            <input type="file" name="gambar[]" id="gambar[]" class="form-control" multiple required>
        </div>

        <h2 class="mt-5">Detail Produk List</h2>
        <div id="detail-list-container">
            <div class="form-group detail-list">
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
            </div>
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
    `;
    detailListContainer.appendChild(detailList);
});
</script>
<script>
    document.getElementById('kategori_id').addEventListener('change', function() {
        var kategoriId = this.value;
        var subKategoriSelect = document.getElementById('sub_kategori_id');
    
        subKategoriSelect.innerHTML = '<option value="">Memuat...</option>';
    
        fetch(`/admin/produk/getSubKategori/${kategoriId}`)
            .then(response => response.json())
            .then(data => {
                subKategoriSelect.innerHTML = '<option value="">Pilih Sub Kategori</option>';
                data.forEach(function(subKategori) {
                    var option = document.createElement('option');
                    option.value = subKategori.id;
                    option.textContent = subKategori.nama;
                    subKategoriSelect.appendChild(option);
                });
            });
    });
    </script>
@endsection
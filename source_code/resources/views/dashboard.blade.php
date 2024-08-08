@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
    
                <div class="card-body">
                    You are a Admin User.
                </div>

                <div>
                    <a href="{{ route('admin.masterdata.kategori.index') }}">kategori</a>
                </div>
                <div>
                    <a href="{{ route('admin.masterdata.subkategori.index') }}">Subkategori</a>
                </div>                
                <div>
                    <a href="{{ route('admin.masterdata.komoditas.index') }}">komoditas</a>
                </div>
                <div>
                    <a href="{{ route('produk.index') }}">Produk</a>
                </div>
                <div>
                    <a href="{{ route('slider.index') }}">Slider</a>
                </div>
                <div>
                    <a href="{{ route('bigsale.index') }}">Bigsale</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
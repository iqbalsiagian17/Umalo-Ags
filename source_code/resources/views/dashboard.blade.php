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
                    <a href="{{ route('admin.masterdata.subkategori.index') }}">subkategori</a>
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
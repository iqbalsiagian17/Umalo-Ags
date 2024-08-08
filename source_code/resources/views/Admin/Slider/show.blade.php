@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Slider Details</h1>
    <div class="mb-3">
        <label class="form-label">Image:</label>
        <div>
            <img src="{{ asset($slider->image) }}" width="300">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Description:</label>
        <p>{{ $slider->deskripsi }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">URL:</label>
        <p>{{ $slider->url }}</p>
    </div>
    <a href="{{ route('slider.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection

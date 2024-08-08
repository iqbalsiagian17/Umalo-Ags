@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Edit Slider</h1>
    <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ asset($slider->image) }}" width="100" class="mt-2">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Description:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $slider->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL:</label>
            <input type="text" class="form-control" id="url" name="url" value="{{ $slider->url }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

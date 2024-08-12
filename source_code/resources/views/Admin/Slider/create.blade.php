@extends('layouts.admin.master')

@section('content')
<div class="container mt-5">
    <h1>Create Slider</h1>
    <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Description:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL:</label>
            <input type="text" class="form-control" id="url" name="url">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

@extends('layouts.admin.master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h1>Sliders</h1>
        <a href="{{ route('slider.create') }}" class="btn btn-primary">Create Slider</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Description</th>
                <th>URL</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td><img src="{{ asset($slider->image) }}" width="100"></td>
                    <td>{{ $slider->deskripsi }}</td>
                    <td>{{ $slider->url }}</td>
                    <td>
                        <a href="{{ route('slider.show', $slider->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('slider.destroy', $slider->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

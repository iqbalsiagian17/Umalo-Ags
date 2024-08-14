@extends('layouts.admin.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Sliders</h2>
                <a href="{{ route('slider.create') }}" class="btn btn-primary mb-3">Create Slider</a>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <div class="card-body">
                <table class="table table-striped table-hover table-responsive">
                    <thead class="thead-dark">
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
                                <td><img src="{{ asset($slider->image) }}" width="100" class="img-fluid img-thumbnail"></td>
                                <td>{{ $slider->deskripsi }}</td>
                                <td>{{ $slider->url }}</td>
                                <td>
                                    <a href="{{ route('slider.show', $slider->id) }}" class="btn btn-info btn-sm">Show</a>
                                    <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('slider.destroy', $slider->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this slider?');">
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
        </div>
    </div>
</div>
@endsection

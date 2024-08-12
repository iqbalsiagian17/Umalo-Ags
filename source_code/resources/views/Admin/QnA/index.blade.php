@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Q&A</h1>

    <a href="{{ route('qas.create') }}" class="btn btn-primary mb-4">Tambah Q&A</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($qas as $qa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $qa->pertanyaan }}</td>
                <td>{{ $qa->jawaban }}</td>
                <td>
                    <form action="{{ route('qas.destroy', $qa->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('qas.show', $qa->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('qas.edit', $qa->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

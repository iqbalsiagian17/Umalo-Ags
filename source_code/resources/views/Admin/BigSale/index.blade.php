@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Big Sales</h1>
    <a href="{{ route('bigsale.create') }}" class="btn btn-primary">Create Big Sale</a>
    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Mulai</th>
                <th>Berakhir</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bigSales as $bigSale)
            <tr>
                <td>{{ $bigSale->judul }}</td>
                <td>{{ $bigSale->mulai }}</td>
                <td>{{ $bigSale->berakhir }}</td>
                <td>{{ $bigSale->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                <td>
                    <a href="{{ route('bigsale.show', $bigSale->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('bigsale.edit', $bigSale->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('bigsale.destroy', $bigSale->id) }}" method="POST" style="display:inline;">
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

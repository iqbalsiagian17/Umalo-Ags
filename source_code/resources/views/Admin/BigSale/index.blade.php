@extends('layouts.admin.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Big Sales</h2>
                <a href="{{ route('bigsale.create') }}" class="btn btn-primary">Create Big Sale</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-responsive">
                    <thead class="thead-dark">
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
                                <a href="{{ route('bigsale.show', $bigSale->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('bigsale.edit', $bigSale->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('bigsale.destroy', $bigSale->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this Big Sale?');">
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

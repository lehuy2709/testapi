@extends('layout.master')

@section('title', 'Manage Products')

@section('content-title', 'Manage Products')

@section('content')
    <div>
        <a href="{{ Route('products.create') }}" class="btn btn-success" style="margin-bottom:20px;">Create</a>
    </div>
    <table class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $prod)
                <tr>
                    <td>{{ $prod->id }}</td>
                    <td>{{ $prod->name }}</td>
                    <td>{{ number_format($prod->price) }}</td>
                    <td><img src="{{ asset($prod->thumbnail_url) }}" alt="" width="100"></td>
                    <td>

                        <form action="{{ Route('products.update-status', $prod->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if ($prod->status == 1)
                                <button class="badge badge-success" style="border:none">Active</button>
                            @else
                                <button class="badge badge-warning" style="border:none">In-Active</button>
                            @endif
                        </form>
                    </td>
                    <td>
                        <form action="{{ Route('products.delete', $prod->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <div>
        {{ $products->links() }}
    </div>
@endsection

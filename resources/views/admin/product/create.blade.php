@extends('layout.master')

@section('title', 'Create Product')

@section('content-title', 'Create Product')

@section('content')

    <form action="{{ Route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="price">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
            <input type="file" class="form-control" name="thumbnail_url">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Status</label>
            <select class="form-control" name="status">
                <option value="0">In-Active</option>
                <option value="1">Active</option>
            </select>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Create</button>
            <button type="reset" class="btn btn-info">Reset</button>
        </div>

    </form>

@endsection

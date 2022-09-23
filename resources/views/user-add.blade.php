@extends('layout.master')
@section('title','Register User')
@section('content-title', 'Register User')
@section('content')
    <form action="{{Route('users')}}" method="GET">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="username" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
          </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Phone</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" name="phone">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input type="text" class="form-control" id="exampleInputPassword1"  name="address">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection

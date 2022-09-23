@extends('layout.master')
@section('title','List Users')
@section('content-title', 'Quản lý Users')
@section('content')
        <table class="table table-dark">
         <a href="{{Route('register')}}" class="btn btn-success">Register</a>
            <thead>
                <tr>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">SĐT</th>
                    <th scope="col">Địa chỉ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listUsers as $user)
                    <tr>
                        <td>{{ $user['username'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['phone'] }}</td>
                        <td>{{ $user['address'] }}</td>
                    </tr>
                @endforeach


            </tbody>
        </table>

@endsection

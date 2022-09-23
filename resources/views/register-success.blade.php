@extends('layout.main')
@section('title','Register Success')
@section('main-content')

        <table class="table table-dark">
            <thead>
                <tr>

                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$users['username']}}</td>
                    <td>{{$users['email']}}</td>
                    <td>{{$users['password']}}</td>
                </tr>
            </tbody>
        </table>

@endsection

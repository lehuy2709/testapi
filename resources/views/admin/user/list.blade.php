@extends('layout.master')

@section('title', 'Quản lý người dùng')

@section('content-title', 'Quản lý người dùng')

@section('content')
    <div>
        <a href="" class="btn btn-success" style="margin-bottom:20px;">Create</a>
    </div>
    <table class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Status</th>
                <th>Category</th>
                <th>Size</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userPaginate as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->code }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <ul>
                            @foreach ($user->posts as $post)
                                <li>{{ $post->content }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td><img src="{{ asset($user->avatar) }}" alt="" width="100"></td>
                    <td>

                        <form action="{{ Route('users.update-status', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if ($user->role == 1)
                                <button class="badge badge-success" style="border:none">Admin</button>
                            @else
                                <button class="badge badge-warning" style="border:none">User</button>
                            @endif
                        </form>
                    </td>
                    <td>

                        <a href="{{ Route('users.edit', $user->id) }}"><button class="btn btn-info">Sửa</button></a>
                        <form action="{{ Route('users.delete', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Xóa</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $userPaginate->links() }}
    </div>
@endsection

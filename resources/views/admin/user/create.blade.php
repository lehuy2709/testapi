@extends('layout.master')

@section('title', isset($title) ? $title : 'Create User')

@section('content-title', isset($title) ? $title : 'Create User')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ isset($user) ? Route('users.update', $user) : Route('users.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" value="{{ isset($user) ? $user->name : old('name') }}">
        </div>
        {{-- @if ($errors->has('name'))
            <div class="alert alert-danger">
                {{$errors->first('name')}}
            </div>
        @endif --}}
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                value="{{ isset($user->email) ? $user->email : '' }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1" name="password"
                value="{{ isset($user->password) ? $user->password : '' }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Code Student</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="code"
                value="{{ isset($user->code) ? $user->code : '' }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">User Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="username"
                value="{{ isset($user->username) ? $user->username : '' }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Avatar</label>
            <input type="file" class="form-control" name="avatar">
        </div>
        @if (isset($user))
            <div>
                <img src="{{ asset($user->avatar) }}" alt="" width="150px">
            </div>
        @endif

        <br>
        <div class="form-group">
            <label for="exampleInputEmail1">Role</label>
            <input type="radio" name="role" value="1"
                {{ isset($user) && $user->role == 1 ? 'checked' : '' }}>Teacher
            <input type="radio" name="role" value="0"
                {{ isset($user) && $user->role == 0 ? 'checked' : '' }}>Student
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Status</label>
            <input type="radio" name="status" value="1"
                {{ isset($user) && $user->status == 1 ? 'checked' : '' }}>Active
            <input type="radio" name="status" value="0"
                {{ isset($user) && $user->status == 0 ? 'checked' : '' }}>In-Active
        </div>
        <div>
            <button type="submit" class="btn btn-primary">
                @if (isset($nameButton))
                    {{ $nameButton }}
                @else
                    Create
                @endif
            </button>
            <button type="reset" class="btn btn-info">Reset</button>
        </div>

    </form>

@endsection

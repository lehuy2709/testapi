@extends('auth.layout.master')

@section('title', 'Login')

@section('content-title', 'Login')

@section('content')

    <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
            <img src="{{ asset('dist/auth/images/img-01.png') }}" alt="IMG">
        </div>

        <form class="login100-form validate-form" method="POST" action="{{ Route('auth.postRegister') }}">
            @csrf
            <span class="login100-form-title">
                Member Register
            </span>

            <div class="wrap-input100 validate-input">
                <input class="input100" type="text" name="name" placeholder="full name" value="{{ old('name') }}">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger">
                    {{ $errors->first('name') }}
                </div>
            @endif

            <div class="wrap-input100 validate-input">
                <input class="input100" type="text" name="username" placeholder="username" value="{{ old('username') }}">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                </span>
            </div>
            @if ($errors->has('username'))
                <div class="alert alert-danger">
                    {{ $errors->first('username') }}
                </div>
            @endif

            <div class="wrap-input100 validate-input">
                <input class="input100" type="text" name="code" placeholder="code" value="{{ old('code') }}">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-address-card" aria-hidden="true"></i>
                </span>
            </div>
            @if ($errors->has('code'))
                <div class="alert alert-danger">
                    {{ $errors->first('code') }}
                </div>
            @endif

            <div class="wrap-input100 validate-input">
                <input class="input100" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
            </div>
            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <div class="wrap-input100 validate-input">
                <input class="input100" type="password" name="password" placeholder="Password"
                    value="{{ old('password') }}">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </span>
            </div>
            @if ($errors->has('password'))
                <div class="alert alert-danger">
                    {{ $errors->first('password') }}
                </div>
            @endif

            <div class="container-login100-form-btn">
                <button class="login100-form-btn">
                    Register
                </button>
            </div>


            <div class="text-center p-t-136">
                <a class="txt2" href="{{ Route('auth.getlogin') }}">
                    Login
                    <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                </a>
            </div>
        </form>
    </div>




@endsection

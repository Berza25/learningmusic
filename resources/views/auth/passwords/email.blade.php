@extends('layouts.apps')
@section('title', 'Reset Password')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center mb-3">
                            <img src="{{ asset('logo.png') }}" width="100" height="80">
                            <small>Berza Music Studio</small>
                        </div>
                        <div class="text-center mb-3">
                            <h1 class="h4 text-gray-900 mb-4">{{ __('Reset Password') }}</h1>
                            <small>Enter your email address that you used to register. We'll send you an email with a link to reset your password.</small>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger border-left-danger" role="alert">
                                <ul class="pl-4 my-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi-envelope"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            Back to <a href="{{ route('login') }}" style="text-decoration: none;"><strong>Login</strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

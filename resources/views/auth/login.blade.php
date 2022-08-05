@extends('layouts.apps')
@section('title', 'Login')
@section('content')
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4 text-black">
                    <div class="py-5 text-center ms-xl-4">
                        <span class="h4 fw-bold mb-0">Berza Music Studio</span>
                    </div>
                    <div class="align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-2">
                                <label class="form-label" for="form2Example18">Email address</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-2">
                                <label class="form-label">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <button type="submit" class="btn btn-primary rounded">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                        <div class="mt-2 mb-2">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="text-decoration: none;">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        </div>
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <a href="/" style="text-decoration: none;">
                                {{ __('Return to Home') }}
                            </a>
                            <div align="right">
                                <a href="{{ route('register') }}" style="text-decoration: none;">
                                    {{ __('Register') }}
                                </a>
    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 px-0 d-none d-sm-block">
                    <img src="{{ asset('berzalogo.jpg') }}" alt="Login image" class="w-100 vh-100"
                        style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
@endsection

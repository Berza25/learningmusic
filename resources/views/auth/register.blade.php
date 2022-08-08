@extends('layouts.apps')
@section('title', 'Register')
@section('content')
<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 text-black">
                <div class="py-3 text-center ms-xl-4">
                    <img src="{{ url('BERZALOGOKECIL.png') }}" alt="" class="img-fluid">
                    {{-- <span class="h4 fw-bold mb-0">Berza Music Studio</span> --}}
                </div>

                <div class="align-items-center h-custom-2 px-3 ms-xl-4 mt-5 pt-3 pt-xl-0 mt-xl-n5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-2">
                            <label class="form-label" for="form2Example18">Name</label>
                            <input id="name" type="name"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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
                            <label class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary rounded">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                    <div class="d-sm-flex align-items-center justify-content-between mt-2">
                        <a style="text-decoration: none;" href="/">
                            {{ __('Return to Home') }}
                        </a>
                        <div align="right" class="px-0">
                            <a style="text-decoration: none;" href="{{ route('login') }}">
                                {{ __('Login') }}
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

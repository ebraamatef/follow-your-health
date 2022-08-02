@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid ps-md-0">
                        <div class="row g-0">
                            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image" style="background-size:cover"></div>
                            <div class="col-md-8 col-lg-6">
                                <div class="login d-flex align-items-center py-5">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-9 col-lg-8 mx-auto">
                                                <h3 class="login-heading mb-4">Sign In</h3>
                                                <!-- Sign In Form -->
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" name="email" value="{{ old('email') }}" 
                                                        required autocomplete="email" autofocus placeholder="name@example.com">
                                                        <label for="floatingInput">Email address</label>
                                                        @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" name="password" 
                                                        required autocomplete="current-password" placeholder="Password">
                                                        <label for="floatingPassword">Password</label>
                                                        @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                                                        <label class="form-check-label" for="rememberPasswordCheck">
                                                            Remember password
                                                        </label>
                                                    </div>
                                                    <div class="d-grid">
                                                        <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2  primary_color primary_color_border" type="submit">Sign in</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

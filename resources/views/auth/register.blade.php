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
                                                <h3 class="login-heading mb-4 text-center">Account Sign up</h3>
                                                    <form method="POST" action="{{ route('register') }}">
                                                        @csrf
                                                        <div class="acc_type_container mb-5">
                                                            <label class="acc_type">
                                                                <input type="radio" name="type" value="lab">
                                                                <div class="acc_type_lab_img"><p class="acc_type_text">Laboratory</p></div>
                                                            </label>
                                                            <label class="acc_type">
                                                                <input type="radio" name="type" value="doctor">
                                                                <div class="acc_type_doc_img"><p class="acc_type_text">Doctor</p></div>
                                                            </label>
                                                            <label class="acc_type">
                                                                <input type="radio" name="type" value="patient">
                                                                <div class="acc_type_patient_img"><p class="acc_type_text">Patient</p></div>
                                                            </label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput" name="name" value="{{ old('name') }}" required autocomplete="name"
                                                            placeholder="Enter your name" autofocus>
                                                            <label for="floatingInput">Name</label>
                                                            @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" name="email" value="{{ old('email') }}" required autocomplete="email"
                                                            placeholder="name@example.com">
                                                            <label for="floatingInput">Email address</label>
                                                            @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                            @enderror
                                                        </div>

                                                        
                                                        <div class="form-floating mb-3">
                                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" name="password" required autocomplete="new-password">
                                                            <label for="floatingPassword">Password</label>
                                                            @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="password" class="form-control" id="floatingPassword" name="password_confirmation" required autocomplete="new-password">
                                                            <label for="floatingPassword">Confirm Password</label>
                                                        </div>

                                                        <div class="row mb-0">
                                                            <div class="col-md-6 offset-md-4">
                                                                <button type="submit" class="btn btn-primary   primary_color primary_color_border">
                                                                    {{ __('Register') }}
                                                                </button>
                                                            </div>
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

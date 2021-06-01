@extends('layouts/app')

@section('content')

<div class="container mt-5 py-2">
    <div class="row mt-4">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card card-sign-in">
                <div class="card-header text-center">
                    <img src="{{ asset('images/logo-sign-in.png') }}" class="rounded-circle img-thumbnail logo-sign-in">
                    <h3 class="fw-bold">Sign In</h3>
                </div>
                <div class="card-body">
                    <form>    
                        <div class="row mb-3">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="npm" class="form-label fw-bold">NPM</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="npm" placeholder="NPM">
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                    <span class="input-group-text" onclick="showPasswordSignIn();">
                                        <i class="fas fa-eye-slash d-block" id="eye-slash"></i>
                                        <i class="fas fa-eye d-none" id="eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-4"></div>
                            <button type="button" class="col-4 btn btn-lg bg-warning rounded-pill shadow button">Sign In</button>
                            <div class="col-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-2"></div>
                            <p class="col-8 fs-5">Belum terdaftar? <a class="text-register" href="{{ route('register') }}">Silahkan register</a></p>
                            <div class="col-2"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>

@endsection
@extends('layouts/app')

@section('content')

<div class="container my-5 py-3">
    <div class="row mt-4">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card card-register">
                <div class="card-header text-center">
                    <img src="{{ asset('images/logo-register.png') }}" class="rounded-circle img-thumbnail logo-register">
                    <h3 class="fw-bold">Register</h3>
                </div>
                <div class="card-body">
                    <form>    
                        <div class="row mb-3">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="nama" class="form-label fw-bold">Nama</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>

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

                        <div class="row mb-3">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                    <span class="input-group-text" onclick="showPasswordRegister();">
                                        <i class="fas fa-eye-slash d-block" id="eye-slash"></i>
                                        <i class="fas fa-eye d-none" id="eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="profile-picture" class="form-label fw-bold">Profile Picture</label>
                                <input class="form-control" type="file" id="profile-picture-browse" onchange="changeProfilePictureInput();">
                            </div>
                            <div class="col-2"></div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-2"></div>
                            <div class="col-8 text-center">
                                <img src="{{ asset('images/default-profile-picture.png') }}" class="rounded-circle profile-picture-view" id="profile-picture-view">
                            </div>
                            <div class="col-2"></div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-4"></div>
                            <button type="button" class="col-4 btn btn-lg bg-warning rounded-pill shadow button">Register</button>
                            <div class="col-4"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>

@endsection
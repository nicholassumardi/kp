@extends('admin/layouts/app')
@section('indicator')
Dashboard
@endsection
@section('content')
<div class="container-fluid mt--6">
    <form action="">
    <div class="row">
        <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">
                <img src="{{asset('argon/assets/img/theme/itats.jpg')}}" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{asset('argon/assets/img/theme/team-6.jpg')}}" class="rounded-circle">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="row">

                    </div>
                    <div class="text-center mt-5">
                        <h5 class="h3">
                            Mr Enrique<span class="font-weight-light">, 34</span>
                        </h5>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i>Surabaya, Indonesia
                        </div>
                        <div>
                            <i class="ni education_hat mr-2"></i>Institut Teknologi Adhi Tama Surabaya
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Edit profile </h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#!" class="btn btn-sm btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <h6 class="heading-small text-muted mb-4">User information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Name</label>
                                        <input type="text" id="name" class="form-control" placeholder="Full Name"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email address</label>
                                        <input type="email" id="email" class="form-control"
                                            placeholder="john@gmail.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Age</label>
                                        <input type="text" id="age" class="form-control" placeholder="Age" value="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">New Password</label>
                                        <input type="text" id="newpassword" class="form-control"
                                            placeholder="New Password" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <!-- Address -->
                        <h6 class="heading-small text-muted mb-4">Contact information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Address</label>
                                        <input id="input-address" class="form-control" placeholder="Home Address"
                                            value="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-city">City</label>
                                        <input type="text" id="input-city" class="form-control" placeholder="City"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Country</label>
                                        <input type="text" id="input-country" class="form-control" placeholder="Country"
                                            value="">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr class="my-4" />
                        <!-- Description -->
                        <h6 class="heading-small text-muted mb-4">Profile Picture</h6>
                        <div class="d-flex flex-column justify-content-center">
                            <div class="row mb-5 mx-auto">
                                <div class="col">
                                    <img src="{{ asset('images/default-profile-picture.png') }}"
                                        class="rounded-circle custompicture" id="profile-picture-view">
                                </div>
                            </div>
                            <div class="row mb-3 mx-auto">
                                <div class="col-12">
                                    <input class="form-control customicon" type="file" id="profile-picture-browse"
                                        onchange="changeProfilePictureInput();">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
    @endsection
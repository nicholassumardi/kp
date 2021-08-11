@extends('admin/layouts/app')
@section('path')
Profile
@endsection
@section('content')
<div class="container-fluid mt--6">
    <form action="{{route('profileAdmin.update', Auth::id())}}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                <div class="card card-profile">
                    <img src="{{asset('argon/assets/img/theme/itats.jpg')}}" alt="Image placeholder"
                        class="card-img-top">
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    {{-- <img src="{{asset('argon/assets/img/theme/team-6.jpg')}}" class="rounded-circle"> --}}
                                    <img src="{{ asset('storage/' . $admin->path_foto) }}" class="rounded-circle custompicture">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="row">

                        </div>
                        <div class="text-center mt-5">
                            <h5 class="h3">
                                {{$admin->nama}}<span class="font-weight-light">, {{$admin->umur}}</span>
                            </h5>

                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ $admin->kota }}, {{ $admin->negara }}
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
                                <h3 class="mb-0">Profile </h3>
                            </div>
                            <div class="col-4 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Edit Profile</button>
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
                                                value="{{$admin->nama}}" name="nama" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email address</label>
                                            <input type="email" id="email" class="form-control"
                                                value="{{ $user->email }}" name="email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Age</label>
                                            <input type="number" id="age" class="form-control" placeholder="Age"
                                                value="{{$admin->umur}}" name="umur" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">New
                                                Password</label>
                                            <div class="input-group">
                                                <input type="password" id="newpassword" class="form-control"
                                                    placeholder="New Password" value="" name="newpassword">
                                                <span class="input-group-text customicon" onclick="showPassword();">
                                                    <i class="fas fa-eye-slash d-block" id="eye-slash"></i>
                                                    <i class="fas fa-eye d-none" id="eye"></i>
                                                </span>
                                            </div>
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
                                                value="{{$admin->alamat}}" type="text" name="alamat" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-city">City</label>
                                            <input type="text" id="input-city" class="form-control" placeholder="City"
                                                value="{{$admin->kota}}" name="kota" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Country</label>
                                            <input type="text" id="input-country" class="form-control"
                                                placeholder="Country" value="{{$admin->negara}}" name="negara" required>
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
                                        <img src="{{ asset('storage/' . $admin->path_foto) }}"
                                            class="rounded-circle custompicture" id="profile-picture-view">
                                    </div>
                                </div>
                                <div class="row mb-3 mx-auto">
                                    <div class="col-12">
                                        <input class="form-control customicon" type="file" id="profile-picture-browse"
                                            onchange="changeProfilePictureInput();" name="file">
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

    @push('js')
    <script>
    function showPassword() {
        if ($("#newpassword").attr("type") === "password") {
            $("#newpassword").attr("type", "text");
            $("#eye-slash")
                .removeClass("d-block")
                .addClass("d-none");
            $("#eye")
                .removeClass("d-none")
                .addClass("d-block");
        } else {
            $("#newpassword").attr("type", "password");
            $("#eye-slash")
                .removeClass("d-none")
                .addClass("d-block");
            $("#eye")
                .removeClass("d-block")
                .addClass("d-none");
        }
    };
    function changeProfilePictureInput() {
    var input = $("#profile-picture-browse")[0];

    if (input.files && input.files[0]) {
        var fileReader = new FileReader();

        fileReader.onload = function (e) {
            $("#profile-picture-view")
                .attr("src", e.target.result)
        };

        fileReader.readAsDataURL(input.files[0]);
    }
}
    </script>
    @endpush
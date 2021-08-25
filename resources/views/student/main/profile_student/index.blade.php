@extends('student/layouts/app')
@section('path')
Profile
@endsection
@section('content')
<div class="container-fluid mt--6">
    <form action="{{route('profileStudent.update', Auth::id())}}" method="POST" enctype="multipart/form-data">
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
                                    <img src="{{ asset('storage/' . $mahasiswa->path_foto) }}"
                                        class="rounded-circle customprofilepicture">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="row">

                        </div>
                        <div class="text-center mt-5">
                            <h5 class="h3">
                                {{$mahasiswa->nama}}<span class="font-weight-light">, {{$mahasiswa->umur}}</span>
                            </h5>

                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ $mahasiswa->kota }}, {{ $mahasiswa->negara }}
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
                                                value="{{$mahasiswa->nama}}" name="nama" required>
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
                                                value="{{$mahasiswa->umur}}" name="umur" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">New
                                                Password</label>
                                            <div class="input-group">
                                                <input type="password" id="newpassword" class="form-control"
                                                    placeholder="New Password" value="" name="newpassword">
                                                <span class="input-group-text customicon" id="show-hide-password">
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
                                                value="{{$mahasiswa->alamat}}" type="text" name="alamat" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-city">City</label>
                                            <input type="text" id="input-city" class="form-control" placeholder="City"
                                                value="{{$mahasiswa->kota}}" name="kota" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Country</label>
                                            <input type="text" id="input-country" class="form-control"
                                                placeholder="Country" value="{{$mahasiswa->negara}}" name="negara" required>
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
                                        <img src="{{ asset('storage/' . $mahasiswa->path_foto) }}"
                                            class="rounded-circle customprofilepicture" id="profile-picture-view" data-old-src="{{ asset('storage/' . $mahasiswa->path_foto) }}">
                                    </div>
                                </div>
                                <div class="row mb-3 mx-auto">
                                    <div class="col-12">
                                        <input class="form-control customicon" type="file" id="profile-picture-browse" name="file">
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
        $(function() {
            $("#show-hide-password").on("click", function() {
                const newPassword = $("#newpassword");
                const eyeSlash = $("#eye-slash");
                const eye = $("#eye");

                if (newPassword.attr("type") === "password") {
                    newPassword.attr("type", "text");
                    eyeSlash.removeClass("d-block").addClass("d-none");
                    eye.removeClass("d-none").addClass("d-block");
                } else {
                    newPassword.attr("type", "password");
                    eye.removeClass("d-block").addClass("d-none");
                    eyeSlash.removeClass("d-none").addClass("d-block");
                }
            });

            $("#profile-picture-browse").on("change", function() {
                const profilePicture = $("#profile-picture-view");
                const file = $(this)[0].files[0];

                // Jika memilih file
                if (file !== undefined) {
                    const fileReader = new FileReader();

                    fileReader.onload = function (e) {
                        profilePicture.attr("src", e.target.result);
                    };

                    fileReader.readAsDataURL(file);
                } else { // Jika tidak memilih file
                    profilePicture.attr("src", profilePicture.data("oldSrc"));
                }
            });
        });
    </script>
    @endpush
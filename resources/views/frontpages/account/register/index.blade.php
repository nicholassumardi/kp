@extends('frontpages/account/layouts/app')

@section('content')

<div class="main-content">
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-6 col-md-8 px-5 mb-4" data-aos="fade-right" data-aos-duration="1500">
                        <h1 class="text-white customheading">Hi, Welcome!</h1>
                        <p class="text-lead text-white customtext">Welcome to Itats Language Centre, <br> please kindly fill in the form below to create your account.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt--8 pb-5 mt-5" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="500">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card card-register">
                    <div class="card-header text-center">
                        <a href="/"><img src="{{ asset('images/logo-sign-in.jpg') }}"
                                class="rounded-circle img-thumbnail logo-sign-in"></a>
                        <h3 class="fw-bold customtext">Register</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('register.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="id_tipe_user" value="4" id="input-id-tipe-user">


                            <div class="row mb-3">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <label for="name" class="form-label fw-bold customtext">Type</label>
                                    <div class="input-group">
                                        <span class="input-group-text customicon ">
                                            <i class="bi bi-people-fill"></i>
                                        </span>
                                        <select class="form-select" name="" id="dropdown-register">
                                            <option value="Mahasiswa" data-id-tipe-user="4">Mahasiswa</option>
                                            <option value="Umum" data-id-tipe-user="5">Umum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2"></div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <label for="name" class="form-label fw-bold customtext">Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text customicon ">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" name="nama" id="name"
                                            placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-2"></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <label for="email" class="form-label fw-bold customtext">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text customicon">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-2"></div>
                            </div>

                            <div class="row mb-3" id="container-npm">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <label for="npm" class="form-label fw-bold customtext">NPM</label>
                                    <div class="input-group">
                                        <span class="input-group-text customicon ">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" name="npm" id="npm" placeholder="NPM" required> 
                                    </div>
                                </div>
                                <div class="col-2"></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <label for="password" class="form-label fw-bold customtext">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text customicon">
                                            <i class="fas fa-key"></i>
                                        </span>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Password" required>
                                        <span class="input-group-text customicon " id="show-hide-password">
                                            <i class="fas fa-eye-slash d-block" id="eye-slash"></i>
                                            <i class="fas fa-eye d-none" id="eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-2"></div>
                            </div>



                            <div class="row mb-5">
                                <div class="col-4"></div>

                                <button type="submit"
                                    class="col-4 btn btn-lg bg-warning rounded-pill shadow button custombutton"
                                    id="button-submit">Register</button>
                                <div class="col-4"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(function() {
        $("#show-hide-password").on("click", function() {
            const password = $("#password");
            const eyeSlash = $("#eye-slash");
            const eye = $("#eye");

            if (password.attr("type") === "password") {
                password.attr("type", "text");
                eyeSlash.removeClass("d-block").addClass("d-none");
                eye.removeClass("d-none").addClass("d-block");
            } else {
                password.attr("type", "password");
                eye.removeClass("d-block").addClass("d-none");
                eyeSlash.removeClass("d-none").addClass("d-block");
            }
        });
        
    $("#dropdown-register").on("change", async function() {
            
            const containerNPM = $("#container-npm");
            const inputIdTipeUser = $("#input-id-tipe-user");
            const npm = $("#npm");

            if ($(this).val() === "Mahasiswa") {
                containerNPM.removeClass("d-none");
                inputIdTipeUser.val(4);
                npm.attr("required", "required");
            } else {
                containerNPM.addClass("d-none");
                inputIdTipeUser.val(5);
                npm.removeAttr("required");
            }
        });
    });
</script>
@endpush
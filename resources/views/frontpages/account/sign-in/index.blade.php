@extends('frontpages/account/layouts/app')

@section('content')

<div class="main-content">
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-6 col-md-8 px-5 mb-4" data-aos="fade-right" data-aos-duration="1500">
                        <h1 class="text-white customheading">Welcome Back!</h1>
                        <p class="text-lead text-white customtext">It's nice to see you again! <br> Please Sign In to continue to your account.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt--8 pb-5 mt-5" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="500">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card card-sign-in">
                    <div class="card-header text-center">
                        <a href="/"><img src="{{ asset('images/logo-sign-in.jpg') }}"
                            class="rounded-circle img-thumbnail logo-sign-in"></a>
                        <h3 class="fw-bold customtext">Sign In</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login.authenticate') }}" method="POST">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <label for="npm" class="form-label fw-bold customtext">NPM/ EMAIL</label>
                                    <div class="input-group">
                                        <span class="input-group-text customicon">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" name="username" id="npm" placeholder="NPM/ EMAIL">
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
                                            placeholder="Password">
                                        <span class="input-group-text customicon" id="show-hide-password">
                                            <i class="fas fa-eye-slash d-block" id="eye-slash"></i>
                                            <i class="fas fa-eye d-none" id="eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"></div>
                                <button type="submit"
                                    class="col-4 btn btn-lg bg-warning  shadow button custombutton">Sign
                                    In</button>
                                <div class="col-4"></div>
                            </div>
                            <div class="row text-center">
                                <div class="col-2"></div>
                                <p class="col-8 fs-5 customtext">Don't have an account? <a class="text-register"
                                        href="{{ route('register.create') }}">Register Now</a></p>
                                <div class="col-2"></div>
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
        });
    </script>
@endpush
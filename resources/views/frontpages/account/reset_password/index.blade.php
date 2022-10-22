@extends('frontpages/account/layouts/app')

@section('content')

<div class="main-content">
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-6 col-md-8 px-5 mb-4" data-aos="fade-right" data-aos-duration="1500">
                        <h1 class="text-white customheading">Reset Your Password Here!</h1>
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
                        <h3 class="fw-bold customtext">Reset Password</h3>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                           
                            @foreach ($errors->all() as $error)
                            <i class="bi bi-info-square-fill"></i> {{ $error }}
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @elseif(session('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <strong>Sorry,</strong> {{ session('failed') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <form action="{{ url()->full() }}" method="POST" required>
                            @csrf

                            <div class="row mb-3">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <label for="password" class="form-label fw-bold customtext">New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text customicon">
                                            <i class="fas fa-key"></i>
                                        </span>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="New Password" required>
                                        <span class="input-group-text customicon" id="show-hide-password"
                                            onclick="showPassword()">
                                            <i class="fas fa-eye-slash d-block" id="eye-slash"></i>
                                            <i class="fas fa-eye d-none" id="eye"></i>
                                        </span>
                                    </div>
                                    @error('password') <small class="text-danger font-italic">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-2"></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <label for="password" class="form-label fw-bold customtext">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text customicon">
                                            <i class="fas fa-key"></i>
                                        </span>
                                        <input type="password" class="form-control" name="confirm_password"
                                            id="confirm-password" placeholder="Confirm Password" required>
                                        <span class="input-group-text customicon" id="show-hide-password"
                                            onclick="showConfirmPassword()">
                                            <i class="fas fa-eye-slash d-block" id="confirm-eye-slash"></i>
                                            <i class="fas fa-eye d-none" id="confirm-eye"></i>
                                        </span>
                                    </div>
                                    @error('password_confirmation') <small class="text-danger font-italic">{{
                                        $message }}</small> @enderror
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"></div>
                                <button type="submit"
                                    class="col-4 btn btn-lg bg-warning  shadow button custombutton">Reset</button>
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
    function forgotPassword() {
			$.ajax({
				url: '{{ url("forgot_password") }}',
				type: 'POST',
				dataType: 'JSON',
				data: {
                        email: $('#emailForReset').val(),
                },
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(response) {
					if(response.status == 200) {
						notif(response.message, '#198754');
					} else {
						notif(response.message, '#DC3545');
					}
				},
				error: function() {
					notif('Server Error!', '#DC3545');
				}
			});
		}
</script>
<script>
    function showPassword() {
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

    }


    function showConfirmPassword() {
                const password = $("#confirm-password");
                const eyeSlash = $("#confirm-eye-slash");
                const eye = $("#confirm-eye");

                if (password.attr("type") === "password") {
                    password.attr("type", "text");
                    eyeSlash.removeClass("d-block").addClass("d-none");
                    eye.removeClass("d-none").addClass("d-block");
                } else {
                    password.attr("type", "password");
                    eye.removeClass("d-block").addClass("d-none");
                    eyeSlash.removeClass("d-none").addClass("d-block");
                }
    }
</script>
@endpush
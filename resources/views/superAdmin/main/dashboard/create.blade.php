@extends('superAdmin/layouts/app')
@section('indicator')
Dashboard
@endsection
@section('content')
<div class="container-fluid mt--6">
    <form action="{{route('super-admin.store')}}" method="post">
        @csrf
        <div class="card">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h3 class="mb-0">Add Admin</h3>
                    <a href="{{route('super-admin.index')}}" class="btn btn-outline-success btn-sm"><i
                            class="bi bi-arrow-left"></i> Back</a>
                </div>
                <div class="card-body p-5">
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h3>Tiper User <span class="text-danger">*</span></h3>
                        </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="" name="id_tipe_user">
                                <option value="2" data-id-tipe-user="2">Admin PUSBA</option>
                                <option value="3" data-id-tipe-user="3">Admin Abstrak</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h3>Nama <span class="text-danger">*</span></h3>
                        </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" required name="nama"
                                placeholder="Nama">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h3>Email <span class="text-danger">*</span></h3>
                        </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" required name="email"
                                placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h3>Password <span class="text-danger">*</span></h3>
                        </label>
                        <div class="input-group col-sm-7">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" required>
                            <span class="input-group-text customicon " id="show-hide-password">
                                <i class="fas fa-eye-slash d-block" id="eye-slash"></i>
                                <i class="fas fa-eye d-none" id="eye"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
                    </div>
                </div>

            </div>

    </form>
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
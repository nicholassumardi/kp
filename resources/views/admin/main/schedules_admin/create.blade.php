@extends('admin/layouts/app')
@section('indicator')
Course
@endsection
@section('content')
<div class="container-fluid mt--6">
    <form action="" method="post">
        @csrf
        <div class="card">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h3 class="mb-0">Add Schedules</h3>
                    <a href="/Schedules" class="btn btn-outline-success btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
                </div>
                <div class="card-body p-5">
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>Course
                                Name <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="" name="">
                                <option value="1">English Course</option>
                                <option value="0">TEFL</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>Day <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="" name="">
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Tuesday">Wednesday</option>
                                <option value="Tuesday">Thursday</option>
                                <option value="Tuesday">Friday</option>
                                <option value="Tuesday">Saturday</option>
                                <option value="Tuesday">Sunday</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>Start Time <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <div class="md-form">
                                <input type="time" id="inputMDEx1" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>End Time <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <div class="md-form">
                                <input type="time" id="" class="form-control">
                            </div>
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
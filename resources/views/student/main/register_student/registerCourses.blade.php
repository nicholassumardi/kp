@extends('student/layouts/app')
@section('path')
Register Courses
@endsection
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h2 class="mb-0">Register</h2>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <div class="card-body">
                        <h3 class="mb-0">Please make sure all fields are filled in correctly.</h3>
                        <div class="row mt-5 mb-3 justify-content-center">
                            <div class="col-xl-10">
                                <label for="form-control">Courses</label>
                                <select class="form-control" id="courses">
                                    <option>English Course</option>
                                    <option>TEFL</option>
                                </select>
                            </div>


                        </div>

                        <div class="row mt-3 mb-5 justify-content-center">
                            <div class="col-xl-10">
                                <label for="session">Session</label>
                                <select class="form-control" id="session">
                                    <option>Monday 08:00-12:00 AM</option>
                                    <option>Tuesday 08:00-12:00 AM</option>
                                    <option>Saturday 08:00-12:00 AM</option>
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-5">
                            <div class="col-xl-10"><button type="button" class="btn btn-primary btn-lg btn-block">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
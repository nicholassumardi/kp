@extends('admin/layouts/app')
@section('indicator')
Dashboard
@endsection
@section('content')
<div class="container-fluid mt--6">

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-indigo text-white rounded-circle shadow">
                                <i class="bi bi-journal"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Courses</h5>
                            <span class="text-success mr-2">2</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="bi bi-journal-check"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Active Courses</h5>
                            <span class="text-success mr-2">2</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Students</h5>
                            <span class="text-success mr-2">2</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Active Students</h5>
                            <span class="text-success mr-2">2</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Active Courses</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Course Name</th>
                                <th scope="col" class="sort" data-sort="name">Type</th>
                                <th scope="col" class="sort" data-sort="budget">Students</th>
                                <th scope="col" class="sort" data-sort="status">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <td scope="row">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">English Course</span>
                                    </div>

                                <td>
                                    Pre Test
                                </td>
                                <td class="budget">
                                    {{mt_rand(00,99)}}
                                </td>
                                <td class="">
                                    <a href="/admin/show" class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-eye"></i></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>



        </div>
        @endsection
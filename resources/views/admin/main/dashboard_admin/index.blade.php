@extends('admin/layouts/app')
@section('path')
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
                            <span class="text-success mr-2">{{ $kursus_count }}</span>
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
                            <span class="text-success mr-2">{{ $kursus_aktif_count }}</span>
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
                            <span class="text-success mr-2">{{ $mahasiswa_count }}</span>
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
                            <span class="text-success mr-2">{{ $mahasiswa_aktif_count }}</span>
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
                                <th>Course Name</th>
                                {{-- <th scope="col" class="sort" data-sort="schedules">Schedule</th> --}}
                                <th>Description</th>
                                <th>Maximum Participants</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($data_kursus as $kursus)
                       <tbody class="list">
                            <tr>
                                <td scope="row">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm"> {{$kursus->nama_kursus}}</span>
                                    </div>
                                </td>
                                <td>
                                    {{ $kursus->deskripsi }}
                                </td>
                                <td>
                                    {{ $kursus->batas_partisipan }}
                                </td>
                                {{-- <td scope="row">
                                    <div class="media-body">
                                        {{\Carbon\Carbon::createFromFormat('H:i:s',$da->jadwal_mulai)->format('H:i')}}
                                -
                                {{\Carbon\Carbon::createFromFormat('H:i:s',$da->jadwal_selesai)->format('H:i')}}
                                    </div>
                                </td> --}}
                                <td class="budget">
                                    <li class="btn btn-sm {{$kursus->status==1?'btn-success':'btn-danger'}} disabled">
                                        {{$kursus->status==1?'Active':'Inactive'}}</li>
                                </td>
                                <td class="">
                                    <a href="{{ route('admin.edit', ['id_kursus' => $kursus->id_kursus]) }}" class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-eye"></i></a>
                                </td>
                            </tr>

                        </tbody>
                        @endforeach
                      
                    </table>
                </div>
            </div>



        </div>
        @endsection
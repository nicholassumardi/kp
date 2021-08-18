@extends('admin/layouts/app')
@section('path')
Profile
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">Course</h3>
            <a href="{{route('addCourse.create')}}" class="btn btn-primary btn-sm">Add Course</a>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataadmin as $da)
                        <tr>
                            <td>{{$da->nama_kursus}} @if (isset($da->tipe_kursus)) {{ '- ' . $da->tipe_kursus }} @endif</td>
                            
                            <td class="text-center">
                                <li class="btn btn-sm {{$da->status==1?'btn-success':'btn-danger'}} disabled">
                                    {{$da->status==1?'Active':'Inactive'}}</li>
                            </td>

                            <td class="text-center">
                                <a href="{{route('addCourse.edit',$da->id_kursus)}}" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-pen-fill text-green"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-trash2-fill text-red"></i></a>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
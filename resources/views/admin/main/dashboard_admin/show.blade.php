@extends('admin/layouts/app')
@section('indicator')
    Students Data
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">Students Data</h3>
            <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left"></i>Back</a>
        </div>
        

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Course Name</th>
                            <th>Photo</th>
                            <th>Payment Proof (Receipt)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nicholas Sumardi</td>
                            <td>English Course</td>
                            <td><img src="{{asset('images/wilm.jpg')}}" alt="" class=" text-center custompicture"></td>
                            <td><img src="{{asset('images/images.jpg')}}" alt="" class="text-center custompicture"></td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pen-fill text-green"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-printer-fill text-indigo"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
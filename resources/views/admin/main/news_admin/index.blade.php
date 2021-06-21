@extends('admin/layouts/app')
@section('indicator')
    News
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">News</h3>
            <a href="#" class="btn btn-primary btn-sm">Add News</a>
        </div>
        

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>20-12-2021</td>
                            <td>New Register Open Now</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pen-fill text-green"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-trash2-fill text-red"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
@extends('superAdmin/layouts/app')
@section('indicator')
Dashboard
@endsection
@section('content')
<div class="container-fluid mt--6">

    <div class="card shadow mb-4">
  
        

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Admin</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Budi Santoso</td>
                            <td class="text-center">
                                <li class="btn btn-sm btn-success disabled">Active</li>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pen-fill text-green"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-trash2-fill text-red"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>Felix Setiawan</td>
                            <td class="text-center">
                                <li class="btn btn-sm btn-danger disabled">Inactive</li>
                            </td>
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
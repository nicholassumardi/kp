@extends('student/layouts/app')
@section('path')
Abstract
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">Abstract</h3>
            <a href="{{route('abstract-student.create')}}" class="btn btn-primary btn-sm">Send Abstract</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered invisible" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Status</th>
                            <th class="text-center">File Anda</th>
                            <th class="text-center">File Admin</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_abstract as $abstract)
                        <tr>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm {{ $abstract->status === 'unverified' ?'btn-danger' : ($abstract->status === 'pending' ? 'btn-warning' : 'btn-success') }} disabled">
                                    {{ $abstract->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($abstract->path_file_abstrak_mahasiswa) }}
                            </td>
                            <td class="text-center">{{ basename($abstract->path_file_abstrak_admin) }} </td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ asset('storage/' . $abstract->path_file_abstrak_admin) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-download text-gray"></i></a>
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
@push('js')
<script>
    $(function () {
        // Tampilkan tabel setelah #dataTable telah terload sepenuhnya.
        $("#dataTable").removeClass("invisible");
    });
</script>
@endpush
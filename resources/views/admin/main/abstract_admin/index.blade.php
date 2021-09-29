@extends('admin/layouts/app')
@section('path')
Abstract
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">Abstract</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered invisible" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Proof of Payment</th>
                            <th>Status</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_abstract as $abstract)
                        <tr>
                            <td class="text-center">{{ $abstract->mahasiswa->nama }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $abstract->path_foto_kuitansi) }}"
                                    class="custombuktipembayaran">
                            </td>
                            <td class="text-center js-td-status">
                                <li
                                    class="btn btn-sm js-status {{ $abstract->status === 'unverified' ?'btn-danger' : ($abstract->status === 'pending' ? 'btn-warning' : 'btn-success') }} disabled">
                                    {{ $abstract->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($abstract->path_file_abstrak_mahasiswa) }}
                            </td>
                            <td class="d-flex justify-content-center">
                                {{-- <form
                                    action="{{route('abstract-admin.changeStatus', ['id_abstrak' => $abstract->id_abstrak, 'id_mahasiswa' => $abstract->mahasiswa_id])}}"
                                method="POST">
                                @method('PATCH')
                                @csrf --}}

                                <a href="{{ asset('storage/' . $abstract->path_file_abstrak_mahasiswa) }}"
                                    class="btn btn-sm btn-outline-secondary js-btn-download"
                                    data-id="{{ $abstract->id_abstrak }}"><i class="bi bi-download text-gray"></i></a>



                                <a href="{{route('abstract-admin.editPage', ['id_abstrak' => $abstract->id_abstrak, 'id_mahasiswa' => $abstract->mahasiswa_id])}}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-pen-fill text-green"></i></a>

                                <form action="" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form>
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
        // Button download
        $("#dataTable").on("click", ".js-btn-download", function () {
            let jsStatus = $(this).parent().siblings(".js-td-status").find(".js-status");

            $.post(`api/abstrak/${ $(this).data("id") }`, function(data) {

            }); 

            jsStatus
                    .removeClass("btn-danger")
                    .addClass("btn-warning")
                    .text("pending");
        });

        // Tampilkan tabel setelah #dataTable telah terload sepenuhnya.
        $("#dataTable").removeClass("invisible");
    });
</script>
@endpush
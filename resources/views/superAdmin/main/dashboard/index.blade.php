@extends('superAdmin/layouts/app')
@section('indicator')
Dashboard
@endsection
@section('content')
<div class="container-fluid mt--6">

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered invisible" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Admin</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listAdmin as $admin)
                        <tr>
                            <td>{{$admin->nama}}</td>
                            <td class="text-center">
                                <li class="btn btn-sm {{$admin->status==1?'btn-success':'btn-danger'}} disabled">
                                    {{$admin->status==1?'Active':'Inactive'}}</li>
                            </td>
                            <td class="text-center">
                                <form action="{{route('super-admin.update', $admin->id_user)}}" enctype="multipart/form-data" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" class="js-status" name="status">

                                    <button type="button" class="btn btn-sm btn-outline-secondary js-btn-activate" value="1"><i class="bi bi-check-circle-fill text-green"></i></button>

                                    <button type="button" class="btn btn-outline-danger btn-sm js-btn-inactivate" value="0"><i class="bi bi-trash"></i></button>
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
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        })

        // Button activate
        $("#dataTable").on("click", ".js-btn-activate", function () {
            swalWithBootstrapButtons.fire({
                title: "Aktifkan Admin ?",
                text: "Apakah anda yakin aktifkan Admin ?",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Ya!",
                cancelButtonText: "Batal !",
                reverseButtons: true,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Ubah value dari input status
                    $(this)
                        .siblings(".js-status")
                        .val($(this).val());

                    $(this).parent().submit(); // Submit form
                }
            })
        })

        // Button inactivate
        $("#dataTable").on("click", ".js-btn-inactivate", function () {
            swalWithBootstrapButtons.fire({
                title: "Non-Aktifkan Admin ?",
                text: "Apakah anda yakin Menonaktifkan Admin ?",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Ya!",
                cancelButtonText: "Batal !",
                reverseButtons: true,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Ubah value dari input status
                    $(this)
                        .siblings(".js-status")
                        .val($(this).val());

                    $(this).parent().submit(); // Submit form
                }
            })
        });

        // Tampilkan tabel setelah #dataTable telah terload sepenuhnya.
        $("#dataTable").removeClass("invisible");
    });
</script>
@endpush
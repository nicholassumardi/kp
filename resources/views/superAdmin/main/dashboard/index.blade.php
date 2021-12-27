@extends('superAdmin/layouts/app')
@section('indicator')
Dashboard
@endsection
@section('content')
<div class="container-fluid mt--6">

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">Admin</h3>
            <a href="{{route('super-admin.create')}}" class="btn btn-primary btn-sm">Add Admin</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered invisible" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Admin</th>
                            <th>Tipe User</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listAdmin as $user)
                        <tr>
                            <td>{{$user->nama}}</td>
                            <td class="text-center">{{ $user->tipe_user_id == 2 ? 'Admin PUSBA' : 'Admin Penerjemah' }}</td>
                            <td class="text-center">
                                <li class="btn btn-sm {{$user->status==1?'btn-success':'btn-danger'}} disabled">
                                    {{$user->status==1?'Active':'Inactive'}}</li>
                            </td>
                            <td class="text-center">
                                <form action="{{route('super-admin.update', $user->id_user)}}" enctype="multipart/form-data" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" class="js-status" name="status">

                                    <button type="button" class="btn btn-sm btn-outline-secondary js-btn-activate" value="1"><i class="bi bi-check-square text-green"></i></button>

                                    <button type="button" class="btn btn-outline-danger btn-sm js-btn-inactivate" value="0"><i class="bi bi-x-square text-danger"></i></button>
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
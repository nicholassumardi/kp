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
                        @foreach ($listAdmin as $admin)
                        <tr>

                            <td>{{$admin->nama}}</td>
                            <td class="text-center">
                                <li class="btn btn-sm {{$admin->status==1?'btn-success':'btn-danger'}} disabled">
                                    {{$admin->status==1?'Active':'Inactive'}}</li>
                            </td>
                            <td class="text-center">
                                <form action="{{route('super-admin.update', $admin->id_user)}}" enctype="multipart/form-data"
                                    method="POST" class="formDeleteProgram d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input id="status" type="hidden" name="status" value="">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="warning-activate"
                                        data-id="{{$admin->id_user}}" value="1" name="switchButton"><i class="bi bi-check-circle-fill text-green"></i></button>
                                    <button type="button" class="btn btn-outline-danger btn-sm btnDeleteProgram" id="warning-inactivate"
                                        data-id="{{$admin->id_user}}" value="0" name="switchButton"><i class="bi bi-trash"></i></button>
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
            $('#dataTable').on('click', '#warning-activate', function () {
                swalWithBootstrapButtons.fire({
                    title: 'Aktifkan Admin ?',
                    text: "Apakah anda yakin aktifkan Admin ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Batal !',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#status').val($('#warning-activate').val())
                        $('.formDeleteProgram').submit()
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Berhasil Dibatalkan !',
                            'Anda membatalkan aktifkan Admin...',
                            'error'
                        )
                    }
                })
            })

            // Button inactivate
            $('#dataTable').on('click', '#warning-inactivate', function () {
                swalWithBootstrapButtons.fire({
                    title: 'Non-Aktifkan Admin ?',
                    text: "Apakah anda yakin Menonaktifkan Admin ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Batal !',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#status').val($('#warning-inactivate').val())
                        $('.formDeleteProgram').submit()
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Berhasil Dibatalkan !',
                            'Anda membatalkan menonaktifkan Admin...',
                            'error'
                        )
                    }
                })
            })
        })
</script>
@endpush
@extends('superAdmin/layouts/app')
@section('indicator')
List Akun Mahasiswa
@endsection
@section('content')
<div class="container-fluid mt--6">

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-start">
            <h3 class="mb-0">Mahasiswa</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered invisible" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>NPM</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listMahasiswa as $mahasiswa)
                        <tr>
                            <td class="text-center">{{$mahasiswa->nama}}</td>
                            <td class="text-center">{{$mahasiswa->npm}}</td>
                            <td class="text-center">{{$mahasiswa->user->email}}</td>
                            <td class="text-center">
                                <li class="btn btn-sm {{$mahasiswa->user->status==1?'btn-success':'btn-danger'}} disabled">
                                    {{$mahasiswa->user->status==1?'Active':'Inactive'}}</li>
                            </td>
                            <td class="text-center">
                                <form action="{{route('listAkunMahasiswa.update', $mahasiswa->user->id_user)}}" enctype="multipart/form-data" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    {{-- <input type="hidden" class="js-status" name="status">

                                    <button type="button" class="btn btn-sm btn-outline-secondary js-btn-activate" value="1"><i class="bi bi-check-square text-green"></i></button>

                                    <button type="button" class="btn btn-outline-danger btn-sm js-btn-inactivate" value="0"><i class="bi bi-x-square text-danger"></i></button> --}}
                                    <button type="button" class="btn btn-outline-danger btn-sm js-btn-reset"><i class="bi bi-key-fill text-danger"></i></button>
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

     

        // Button Reset Password
        $("#dataTable").on("click", ".js-btn-reset", function () {
            swalWithBootstrapButtons.fire({
                title: "Reset Password ?",
                text: "Apakah anda yakin  ?",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Ya!",
                cancelButtonText: "Batal !",
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Ubah value dari input status
                   

                    $(this).parent().submit(); // Submit form
                }
            })
        });

        // Tampilkan tabel setelah #dataTable telah terload sepenuhnya.
        $("#dataTable").removeClass("invisible");
    });
</script>
@endpush
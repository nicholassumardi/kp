@extends('admin/layouts/app')
@section('path')
Students Data
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">Students Data</h3>
            <a href="{{route('admin.index')}}" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left"></i>Back</a>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Year</th>
                            <th>Course Name</th>
                            <th>Photo</th>
                            <th>Payment Proof (Receipt)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nama_mahasiswa as $key => $nm)
                        <tr>
                            <td>{{$nm->nama}}</td>
                            <td>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data_kursus[$key]->created_at)->year}}
                            </td>
                            <td class="text-center">{{$nama_kursus[$key]->nama_kursus}}</td>
                            <td class="text-center"><i
                                    class="btn btn-sm {{$data_kursus[$key]->status_verifikasi==1?'bi bi-check btn-success':'bi bi-x btn-danger'}} disabled">
                                    {{$data_kursus[$key]->status_verifikasi==1?'Verfied':'Unverified'}}</i></td>
                            <td><img src="{{ asset('storage/' . $data_kursus[$key]->path_foto_mahasiswa) }}" alt=""
                                    class=" text-center customfotoprofile"></td>
                            <td><img src="{{ asset('storage/' . $data_kursus[$key]->path_foto_kuitansi) }}" alt=""
                                    class="text-center custombuktipembayaran"></td>
                            <td class="text-center">
                                <form action="{{route('admin.update', $data_kursus[$key]->mahasiswa_id)}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="btn btn-sm btn-outline-secondary js-btn-activate">
                                        <i class="bi bi-check-square text-green"></i>
                                    </button>

                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>


                                    <a href="#" class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('admin.sendKomentar', $data_kursus[$key]->mahasiswa_id)}}"
                                            id="form-send" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group text-start">
                                                <label for="message-text"
                                                    class="col-form-label text-start"><b>Message:</b></label>
                                                <textarea class="form-control width:500px;" id="message-text"
                                                    name="komentar"></textarea>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="btn-send">Send</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        });

        // Button activate
        $("#dataTable").on("click", ".js-btn-activate", function () {
            swalWithBootstrapButtons.fire({
                title: "Verifikasi Mahasiswa?",
                text: "Apakah anda yakin memverifikasi mahasiswa ini?",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Ya!",
                cancelButtonText: "Batal!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent().submit(); // Submit form
                }
            });
        });

        // // Button kirim komentar
        // $("#btn-send").on("click", function () {

        //         $('#form-send').attr('action', '');
        //         $(this).parent().submit(); // Submit form
        //     });
        // });
    });
</script>
@endpush
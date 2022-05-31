@extends('admin/layouts/app')
@section('path')
Students Data
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-xl-10 col-9">
                    <h3 class="mb-0">Students Data</h3>
                </div>

                <div class="col ml-xl-5">
                    <a href="{{route('admin.index')}}" class="btn btn-primary btn-sm"><i
                            class="bi bi-arrow-left"></i>Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h3>{{$kursus->nama_kursus}}</h3>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col">
                    <p>{{\Carbon\Carbon::createFromFormat('H:i:s',$jadwal->jadwal_mulai)->format('H:i')}}
                        -
                        {{\Carbon\Carbon::createFromFormat('H:i:s',$jadwal->jadwal_selesai)->format('H:i')}}</p>
                </div>
            </div> --}}
        </div>



        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Card Number</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Payment Proof (Receipt)</th>
                            <th class="text-center">Student Picture</th>
                            {!! $kursus->sertifikat === 1 ? '<th>English Course Certificate</th>' : '' !!}
                            <th class="text-center">Action</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kursus->tipe_kursus === 'mahasiswa')
                        @foreach ($kursus->mahasiswa as $key => $mahasiswa)
                        <tr>
                            <td class="align-middle">{{$mahasiswa->nama}}</td>

                            <td class="align-middle">{{$mahasiswa->pivot->no_kartu_mahasiswa}}</td>

                            <td class="align-middle">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $mahasiswa->pivot->created_at)->year}}
                            </td>

                            <td class="text-center align-middle"><i
                                    class="btn btn-sm {{$mahasiswa->pivot->status_verifikasi==1?'bi bi-check btn-success':'bi bi-x btn-danger'}} disabled">
                                    {{$mahasiswa->pivot->status_verifikasi==1?'Verfied':'Unverified'}}</i></td>

                            <td class="align-middle">{{--<img
                                    src="{{ asset('storage/' . $mahasiswa->pivot->path_foto_kuitansi) }}" alt=""
                                    class="text-center custombuktipembayaran"> --}}

                                <a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop1"><img
                                        src="{{ asset('storage/' . $mahasiswa->pivot->path_foto_kuitansi) }}" alt=""
                                        id="imageresource1" class="text-center custombuktipembayaran"></a>
                            </td>


                            <td class="align-middle">
                                <a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop2"><img
                                        src="{{ asset('storage/' . $mahasiswa->pivot->path_foto_mahasiswa) }}" alt=""
                                        id="imageresource2" class="text-center customfotoprofile"> </a>
                            </td>

                            @if ($kursus->sertifikat === 1)
                            <td class="align-middle text-center"><a href="#" data-toggle="modal"
                                    data-target="#modalKurikulum" class="pop3"><img
                                        src="{{asset('storage/' . $mahasiswa->pivot->path_foto_sertifikat)}}"
                                        id="imageresource3" class='text-center customfotoprofile'></td></a>
                            @endif

                            <td class="text-center align-middle">
                                <form
                                    action="{{ route('admin.update', ['id_mahasiswa' => $mahasiswa->id_mahasiswa, 'id_kursus' => $kursus->id_kursus]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="btn btn-sm btn-outline-secondary js-btn-activate">
                                        <i class="bi bi-check-square text-green"></i>
                                    </button>

                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{ route('admin.sendKomentar', ['id_mahasiswa' => $mahasiswa->id_mahasiswa, 'id_kursus' => $kursus->id_kursus]) }}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                </form>
                            </td>


                            <td class="align-middle">
                                <a href="{{ route('generate.pdf', ['id_kursus' => $kursus->id_kursus, 'id_mahasiswa_satu' => $mahasiswa->id_mahasiswa]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>
                            </td>

                        </tr>
                        @endforeach
                        @endif

                        @if ($kursus->tipe_kursus === 'mahasiswa dan umum')

                        @foreach ($kursus->mahasiswa as $key => $mahasiswa)
                        <tr>
                            <td class="align-middle">{{$mahasiswa->nama}}</td>

                            <td class="align-middle">{{$mahasiswa->pivot->no_kartu_mahasiswa}}</td>

                            <td class="align-middle">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $mahasiswa->pivot->created_at)->year}}
                            </td>

                            <td class="text-center align-middle"><i
                                    class="btn btn-sm {{$mahasiswa->pivot->status_verifikasi==1?'bi bi-check btn-success':'bi bi-x btn-danger'}} disabled">
                                    {{$mahasiswa->pivot->status_verifikasi==1?'Verfied':'Unverified'}}</i></td>

                            <td class="align-middle"><a href="#" data-toggle="modal" data-target="#modalKurikulum"
                                    class="pop1"><img
                                        src="{{ asset('storage/' . $mahasiswa->pivot->path_foto_kuitansi) }}" alt=""
                                        id="imageresource1" class="text-center custombuktipembayaran"></a></td>

                            <td class="align-middle"><a href="#" data-toggle="modal" data-target="#modalKurikulum"
                                    class="pop2"><img
                                        src="{{ asset('storage/' . $mahasiswa->pivot->path_foto_mahasiswa) }}" alt=""
                                        id="imageresource2" class="text-center customfotoprofile"></td>
                            </a>
                            @if ($kursus->sertifikat === 1)
                            <td class="align-middle text-center"><a href="#" data-toggle="modal"
                                    data-target="#modalKurikulum" class="pop3"><img
                                        src="{{asset('storage/' . $mahasiswa->pivot->path_foto_sertifikat)}}"
                                        id="imageresource3" class='text-center customfotoprofile'></a></td>
                            @endif

                            <td class="text-center align-middle">
                                <form
                                    action="{{ route('admin.update', ['id_mahasiswa' => $mahasiswa->id_mahasiswa, 'id_kursus' => $kursus->id_kursus]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="btn btn-sm btn-outline-secondary js-btn-activate">
                                        <i class="bi bi-check-square text-green"></i>
                                    </button>

                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{ route('admin.sendKomentar', ['id_mahasiswa' => $mahasiswa->id_mahasiswa, 'id_kursus' => $kursus->id_kursus]) }}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                </form>
                            </td>


                            <td class="align-middle">
                                <a href="{{ route('generate.pdf', ['id_kursus' => $kursus->id_kursus, 'id_mahasiswa_satu' => $mahasiswa->id_mahasiswa]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>
                            </td>

                        </tr>
                        @endforeach

                        @foreach ($kursus->umum as $key => $umum)
                        <tr>
                            <td class="align-middle">{{$umum->nama}}</td>

                            <td class="align-middle">{{$umum->pivot->no_kartu_umum}}</td>

                            <td class="align-middle">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $umum->pivot->created_at)->year}}
                            </td>

                            <td class="text-center align-middle"><i
                                    class="btn btn-sm {{$umum->pivot->status_verifikasi==1?'bi bi-check btn-success':'bi bi-x btn-danger'}} disabled">
                                    {{$umum->pivot->status_verifikasi==1?'Verfied':'Unverified'}}</i></td>

                            <td class="align-middle"><a href="#" data-toggle="modal" data-target="#modalKurikulum"
                                    class="pop4"><img src="{{ asset('storage/' . $umum->pivot->path_foto_kuitansi) }}"
                                        alt="" id="imageresource4" class="text-center custombuktipembayaran"></a></td>

                            <td class="align-middle"><a href="#" data-toggle="modal" data-target="#modalKurikulum"
                                    class="pop5"><img src="{{ asset('storage/' . $umum->pivot->path_foto_umum) }}"
                                        alt="" id="imageresource5" class="text-center customfotoprofile"></a></td>

                            @if ($kursus->sertifikat === 1)
                            <td class="align-middle text-center"><a href="#" data-toggle="modal"
                                    data-target="#modalKurikulum" class="pop6"><img
                                        src="{{asset('storage/' . $umum->pivot->path_foto_sertifikat)}}"
                                        id="imageresource6" class='text-center customfotoprofile'></a></td>
                            @endif

                            <td class="text-center align-middle">
                                <form
                                    action="{{ route('admin.update2', ['id_umum' => $umum->id_umum, 'id_kursus' => $kursus->id_kursus]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="btn btn-sm btn-outline-secondary js-btn-activate">
                                        <i class="bi bi-check-square text-green"></i>
                                    </button>

                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{ route('admin.sendKomentar2', ['id_umum' => $umum->id_umum, 'id_kursus' => $kursus->id_kursus]) }}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                </form>
                            </td>


                            <td class="align-middle">
                                <a href="{{ route('generateUmum.pdf', ['id_kursus' => $kursus->id_kursus, 'id_umum_satu' => $umum->id_umum]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>
                            </td>

                        </tr>
                        @endforeach
                        @endif

                        @if ($kursus->tipe_kursus === 'umum')
                        @foreach ($kursus->umum as $key => $umum)
                        <tr>
                            <td class="align-middle">{{$umum->nama}}</td>

                            <td class="align-middle">{{$umum->pivot->no_kartu_umum}}</td>

                            <td class="align-middle">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $umum->pivot->created_at)->year}}
                            </td>

                            <td class="text-center align-middle"><i
                                    class="btn btn-sm {{$umum->pivot->status_verifikasi==1?'bi bi-check btn-success':'bi bi-x btn-danger'}} disabled">
                                    {{$umum->pivot->status_verifikasi==1?'Verfied':'Unverified'}}</i></td>

                            <td class="align-middle"><a href="#" data-toggle="modal" data-target="#modalKurikulum"
                                    class="pop4"><img src="{{ asset('storage/' . $umum->pivot->path_foto_kuitansi) }}"
                                        id="imageresource4" alt="" class="text-center custombuktipembayaran"></a></td>

                            <td class="align-middle"><a href="#" data-toggle="modal" data-target="#modalKurikulum"
                                    class="pop5"><img src="{{ asset('storage/' . $umum->pivot->path_foto_umum) }}"
                                        alt="" id="imageresource5" class="text-center customfotoprofile"></a></td>

                            @if ($kursus->sertifikat === 1)
                            <td class="align-middle text-center"><a href="#" data-toggle="modal"
                                    data-target="#modalKurikulum" class="pop6"><img
                                        src="{{asset('storage/' . $umum->pivot->path_foto_sertifikat)}}"
                                        id="imageresource6" class='text-center customfotoprofile'></a></td>
                            @endif

                            <td class="text-center align-middle">
                                <form
                                    action="{{ route('admin.update2', ['id_umum' => $umum->id_umum, 'id_kursus' => $kursus->id_kursus]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="btn btn-sm btn-outline-secondary js-btn-activate">
                                        <i class="bi bi-check-square text-green"></i>
                                    </button>

                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{ route('admin.sendKomentar2', ['id_umum' => $umum->id_umum, 'id_kursus' => $kursus->id_kursus]) }}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                </form>
                            </td>


                            <td class="align-middle">
                                <a href="{{ route('generateUmum.pdf', ['id_kursus' => $kursus->id_kursus, 'id_umum_satu' => $umum->id_umum]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>
                            </td>

                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-komentar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-send" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group text-start">
                        <label for="message-text" class="col-form-label text-start"><b>Message:</b></label>
                        <textarea class="form-control width:500px;" id="message-text" name="komentar"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-send">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>



{{-- Modal Pop UP --}}
<div class="modal fade" id="modalKurikulum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="imagepreview" class="img-fluid">
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

        // Button kirim komentar
        $("#dataTable").on("click", ".btn-komentar", function () {
            $("#form-send").attr("action", $(this).data("action")); 
        });

        $("#modal-komentar").on("hidden.bs.modal", function () {
            $("#form-send").attr("action", ""); 
            $("#message-text").val(""); 
        });

        $("#dataTable").on("click", ".pop1, .pop2, .pop3, .pop4, .pop5, .pop6", function () {
            
           
            // Ubah value dari input status
            // $(this)
            //     .siblings(".js-status")
            //     .val($(this).val());

            // $(this).parent().submit(); // Submit form
            console.log();
            let className = $(this).attr("class");
            let a = className.substring(className.length-1, className.length);
            $('#imagepreview').attr('src', $(this).find("img").attr('src'));
            
            // $('#imagepreview').attr('src', $('#imageresource1').attr('src'));
            // $('#imagepreview').attr('src', $('#imageresource2').attr('src'));
    
        });
        // $("#dataTable").on("click", ".pop1", function () {
            
           
        //     // Ubah value dari input status
        //     // $(this)
        //     //     .siblings(".js-status")
        //     //     .val($(this).val());

        //     // $(this).parent().submit(); // Submit form
        //     $('#imagepreview').attr('src', $('#imageresource1').attr('src'));
    
        // });
        // $("#dataTable").on("click", ".pop2", function () {
            
           
        //     // Ubah value dari input status
        //     // $(this)
        //     //     .siblings(".js-status")
        //     //     .val($(this).val());

        //     // $(this).parent().submit(); // Submit form
        //     $('#imagepreview').attr('src', $('#imageresource2').attr('src'));
    
        // });

        

// $("#pop").on("click", function() {
// $('#imagepreview').attr('src', $('#imageresource').attr('src'));
// $('#imagepreview').attr('src', $('#imageresource1').attr('src'));
// });
});
</script>




@endpush
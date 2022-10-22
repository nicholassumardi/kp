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
                <div class="col-xl-5 col-4">
                    <h3 class="mb-0">Students Data</h3>
                </div>
                <div class="col-xl-5 col-5">
                    <a href="{{route('admin.exportExcel', ['id_kursus' => $kursus->id_kursus, 'tipe_kursus' => $kursus->tipe_kursus])}}"
                        class="btn btn-primary btn-sm"><i class="bi-printer-fill"> </i>Export Excel</a>
                </div>
                <div class="col">
                    <a href="{{route('admin.index')}}" class="btn btn-primary btn-sm"><i
                            class="bi bi-arrow-left"></i>Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h3>{{$kursus->nama_kursus}}</h3>
                    <input type="hidden" id="tipeKursus" value="{{$kursus->tipe_kursus}}">
                    <input type="hidden" id="idKursus" value="{{$kursus->id_kursus}}">
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col">
                <p>{{\Carbon\Carbon::createFromFormat('H:i:s',$jadwal->jadwal_mulai)->format('H:i')}}
                    -
                    {{\Carbon\Carbon::createFromFormat('H:i:s',$jadwal->jadwal_selesai)->format('H:i')}}</p>
            </div>
        </div> --}}




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
                            {{-- {!! $kursus->sertifikat === 1 ? '' : '' !!} --}}
                            <th>English Course Certificate</th>
                            <th class="text-center">Action</th>
                            <th>Print</th>
                        </tr>
                    </thead>

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
     
        loadDataTable();
       

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

        $("#dataTable").on("click", ".pop", function () {
            $('#imagepreview').attr('src', $(this).data('imgSrc'));
        });
    });
    const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        });
    function loadDataTable() {
     
            $('#dataTable').DataTable({
                serverSide: true,
                deferRender: true,
                destroy: true,
                order: [[0, 'asc']],
                iDisplayInLength: 10,
                scrollX: true,
                ajax: {
                    url: '{{ url("admin-edit/datatable") }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        tipeKursus:$('#tipeKursus').val(),
                        idKursus:$('#idKursus').val(),
                    },
                    beforeSend: function() {
                        loadingOpen('#dataTable');
                    },
                    complete: function() {
                        loadingClose('#dataTable');
        
                    },
                    error: function() {
                        loadingClose('#dataTable');
                    }
                },
                columns: [
                   { name: 'id_abstrak', searchable: false, className: 'text-center align-middle' },
                   { name: 'mahasiswa_id', className: 'text-center align-middle' },
                   { name: 'created_at', searchable: false, className: 'text-center align-middle'},
                   { name: 'email', searchable: false, className: 'text-center align-middle'},
                   { name: 'student_phone', searchable: false, className: 'text-center align-middle'},
                   { name: 'proof', searchable: false, className: 'text-center align-middle'},
                   { name: 'status', searchable: false, className: 'text-center align-middle'},
                   { name: 'file', searchable: false, className: 'text-center align-middle'},
                   { name: 'edit_status', searchable: false, className: 'text-center align-middle'},
                 
                
                ]
            });
        }

    function updateStatusMahasiswa(idMhs, idKursus){

        swalWithBootstrapButtons.fire({
                title: "Verify Account?",
                text: "Verify this account ?",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: '{{ url("admin") }}' + '/' + idMhs + '/' + idKursus,
                    type: 'PATCH',
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if(response.status == 200) {
                            $('#dataTable').DataTable().ajax.reload(null, false);
                            notif(response.message, '#198754');
                        } else {
                            notif(response.message, '#DC3545');
                        }
                    },
                    error: function() {
                        notif('Server Error!', '#DC3545');
                    }
                });
                }
            });
       

    }

    function updateStatusUmum(idUmum, idKursus){
    swalWithBootstrapButtons.fire({
            title: "Verify Account?",
            text: "Verify this account ?",
            icon: "warning",
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: "Yes!",
            cancelButtonText: "Cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: '{{ url("admin2") }}' + '/' + idUmum + '/' + idKursus,
                type: 'PATCH',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status == 200) {
                        $('#dataTable').DataTable().ajax.reload(null, false);
                        notif(response.message, '#198754');
                    } else {
                        notif(response.message, '#DC3545');
                    }
                },
                error: function() {
                    notif('Server Error!', '#DC3545');
                }
            });
            }
        });


    }
</script>
@endpush
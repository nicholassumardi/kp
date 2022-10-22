@extends('admin/layouts/app')
@section('path')
Penerjemahan
@endsection
@section('content')

<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4 d-flex justify-content-evenly">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="col-lg-7">
                <h3 class="mb-0">Penerjemahan</h3>
            </div>
            <div class="col-lg">
                <select class="form-select" id="tipeUser-dropdown" onchange="loadDataTable()">
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Umum">Umum</option>
                </select>
            </div>
            <div class="col-lg">
                <select class="form-select" id="tipePenerjemahan-dropdown" onchange="loadDataTable()">
                    <option value="Abstrak">Abstrak</option>
                    <option value="Ijazah">Ijazah</option>
                    <option value="Transkrip">Transkrip</option>
                    <option value="Jurnal">Jurnal</option>
                </select>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>File Type</th>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Student Phone Number</th>
                            <th>Proof of Payment</th>
                            <th>Status</th>
                            <th>File</th>
                            <th>Edit Status</th>
                            <th>Action</th>
                            <th>Print</th>
                            <th>Deactive</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

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

</div>


@endsection
@push('js')
<script>
    $(function () {

        // Tampilkan tabel setelah #dataTable telah terload sepenuhnya.
        $("#dataTable").removeClass("invisible");
        loadDataTable();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        });

        // Button Deactive
        $("#dataTable").on("click", ".js-button-submit", function () {
            swalWithBootstrapButtons.fire({
                title: "Deactive File?",
                text: "Are you sure want to make change? File will not shown after deactive",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent().submit();
                }
            });
        });
 

        // JS Umum
        // Button Pending abstrak umum
        $("#dataTable").on("click", ".js-btn-abstrak-umum-pending", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "abstrakUmum"
            };

            $.post(
                "api/abstrak-jurnal-change-status", 
                postData,
                function(jsonData) {
                    const abstrak = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-warning")
                        .text(abstrak.status);
                }
            ); 
        });
        
         // Button verified abstrak umum
         $("#dataTable").on("click", ".js-btn-abstrak-umum-verified", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "abstrakUmum"
            };

            $.post(
                "api/abstrak-jurnal-verified", 
                postData,
                function(jsonData) {
                    const abstrak = jsonData;
                    
                    jsStatus
                        .removeClass("btn-warning")
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(abstrak.status);
                }
            ); 
        });

         // Button pending jurnal umum
        $("#dataTable").on("click", ".js-btn-jurnal-umum-pending", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "jurnalUmum"
            };
            
            $.post(
                "api/abstrak-jurnal-change-status", 
                postData,
                function(jsonData) {
                    const jurnal = jsonData;
                
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-warning")
                        .text(jurnal.status);
                }
            ); 
        });
            // Button verified jurnal umum
            $("#dataTable").on("click", ".js-btn-jurnal-umum-verified", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "jurnalUmum"
            };

            $.post(
                "api/abstrak-jurnal-verified", 
                postData,
                function(jsonData) {
                    const jurnal = jsonData;
                    
                    jsStatus
                        .removeClass("btn-warning")
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(jurnal.status);
                }
            ); 
        });


        // Button checked transkrip nilai umum
        $("#dataTable").on("click", ".js-btn-transkrip-umum-checked", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "transkrip_nilai_umum"
            };

            $.post(
                "api/transkrip-ijazah-change-status", 
                postData,
                function(jsonData) {
                    const transkripNilai = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(transkripNilai.status);
                }
            ); 
        });

        // Button checked ijazah umum
        $("#dataTable").on("click", ".js-btn-ijazah-umum-checked", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "ijazah_umum"
            };

            $.post(
                "api/transkrip-ijazah-change-status", 
                postData,
                function(jsonData) {
                    const ijazah = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(ijazah.status);
                }
            ); 
        });



          // JS Mahasiswa
        // Button Pending abstrak
        $("#dataTable").on("click", ".js-btn-abstrak-pending", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "abstrak"
            };

            $.post(
                "api/abstrak-jurnal-change-status", 
                postData,
                function(jsonData) {
                    const abstrak = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-warning")
                        .text(abstrak.status);
                }
            ); 
        });
        // Button verified abstrak
        $("#dataTable").on("click", ".js-btn-abstrak-verified", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "abstrak"
            };
     
            $.post(
                "api/abstrak-jurnal-verified", 
                postData,
                function(jsonData) {
                    const abstrak = jsonData;
                    jsStatus
                        .removeClass("btn-warning")
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(abstrak.status);
                }
            ); 
        });
        // Button jurnal pending
        $("#dataTable").on("click", ".js-btn-jurnal-pending", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "jurnal"
            };
            
            $.post(
                "api/abstrak-jurnal-change-status", 
                postData,
                function(jsonData) {
                    const jurnal = jsonData;
                
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-warning")
                        .text(jurnal.status);
                }
            ); 
        });
          // Button jurnal verified
        $("#dataTable").on("click", ".js-btn-jurnal-verified", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "jurnal"
            };

            $.post(
                "api/abstrak-jurnal-verified", 
                postData,
                function(jsonData) {
                    const jurnal = jsonData;
                    
                    jsStatus
                        .removeClass("btn-warning")
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(jurnal.status);
                }
            ); 
        });

        // Button transkrip nilai check
        $("#dataTable").on("click", ".js-btn-transkrip-checked", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "transkrip_nilai"
            };

            $.post(
                "api/transkrip-ijazah-change-status", 
                postData,
                function(jsonData) {
                    const transkripNilai = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(transkripNilai.status);
                }
            ); 
        });

        // Button ijazah checked
        $("#dataTable").on("click", ".js-btn-ijazah-checked", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "ijazah"
            };

            $.post(
                "api/transkrip-ijazah-change-status", 
                postData,
                function(jsonData) {
                    const ijazah = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(ijazah.status);
                }
            ); 
        });

        $("#dataTable").removeClass("invisible");
        

        // Tampilkan tabel setelah #dataTable telah terload sepenuhnya.


        $("#tipeUser-dropdown").on("change", async function() {
            const tipeUserDropdown = $(this);
            const divMahasiswa = $("#div-mahasiswaParent");
            const divUmum = $("#div-umumParent");


            if (tipeUserDropdown.val() === "Mahasiswa") {
                divMahasiswa.removeClass("d-none");
                divUmum.addClass("d-none");
            } else if (tipeUserDropdown.val() === "Umum") {
                divUmum.removeClass("d-none");
                divMahasiswa.addClass("d-none");
            }
        });

        // Button kirim komentar
        $("#dataTable").on("click", ".btn-komentar", function () {
            $("#form-send").attr("action", $(this).data("action")); 
        });

        $("#modal-komentar").on("hidden.bs.modal", function () {
            $("#form-send").attr("action", ""); 
            $("#message-text").val(""); 
        });




    });

    function deactiveAbstract(id){
        swalWithBootstrapButtons.fire({
                title: "Deactive File?",
                text: "Are you sure want to make change? File will not shown after deactive",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("penerjemahan-deactiveAbstrak") }}' + '/' + id,
                        type: 'POST',
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

    function deactiveTanskrip(id){
        swalWithBootstrapButtons.fire({
                title: "Deactive File?",
                text: "Are you sure want to make change? File will not shown after deactive",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("penerjemahan-deactiveTranskrip") }}' + '/' + id,
                        type: 'POST',
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


    function deactiveIjazah(id){
        swalWithBootstrapButtons.fire({
                title: "Deactive File?",
                text: "Are you sure want to make change? File will not shown after deactive",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("penerjemahan-deactiveIjazah") }}' + '/' + id,
                        type: 'POST',
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


    function deactiveJurnal(id){
        swalWithBootstrapButtons.fire({
                title: "Deactive File?",
                text: "Are you sure want to make change? File will not shown after deactive",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("penerjemahan-deactiveJurnal") }}' + '/' + id,
                        type: 'POST',
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


    function deactiveAbstractUmum(id){
        swalWithBootstrapButtons.fire({
                title: "Deactive File?",
                text: "Are you sure want to make change? File will not shown after deactive",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("penerjemahan-deactiveAbstrakUmum") }}' + '/' + id,
                        type: 'POST',
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
    function deactiveTranskipUmum(id){
        swalWithBootstrapButtons.fire({
                title: "Deactive File?",
                text: "Are you sure want to make change? File will not shown after deactive",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("penerjemahan-deactiveTranskipUmum") }}' + '/' + id,
                        type: 'POST',
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

    function deactiveIjazahUmum(id){
        swalWithBootstrapButtons.fire({
                title: "Deactive File?",
                text: "Are you sure want to make change? File will not shown after deactive",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("penerjemahan-deactiveIjazahUmum") }}' + '/' + id,
                        type: 'POST',
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

    function deactiveJurnalUmum(id){
        swalWithBootstrapButtons.fire({
                title: "Deactive File?",
                text: "Are you sure want to make change? File will not shown after deactive",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("penerjemahan-deactiveJurnalUmum") }}' + '/' + id,
                        type: 'POST',
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
    function loadDataTable() {
            $('#dataTable').DataTable({
                serverSide: true,
                deferRender: true,
                destroy: true,
                order: [[0, 'asc']],
                iDisplayInLength: 10,
                scrollX: true,
                ajax: {
                    url: '{{ url("penerjemahan-admin/datatable") }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        tipeUser:$('#tipeUser-dropdown').val(),
                        tipePenerjemahan:$('#tipePenerjemahan-dropdown').val()
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
                   { name: 'action', searchable: false, className: 'text-center align-middle'},
                   { name: 'print', searchable: false, className: 'text-center align-middle'},
                   { name: 'deactive', searchable: false, className: 'text-center align-middle'},
                
                ]
            });
        }
</script>
@endpush
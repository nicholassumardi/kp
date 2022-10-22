@extends('superAdmin/layouts/app')
@section('indicator')
List Akun Umum
@endsection
@section('content')
<div class="container-fluid mt--6">

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-start">
            <h3 class="mb-0">Umum</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

</div>

@endsection
@push('js')
<script>
   $(function () {
        loadDataTable();
        // Tampilkan tabel setelah #dataTable telah terload sepenuhnya.
        $("#dataTable").removeClass("invisible");
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
                    url: '{{ url("listAkunUmum/datatable") }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                   { name: 'nama', className: 'text-center align-middle' },
                   { name: 'email', searchable: false, className: 'text-center align-middle' },
                   { name: 'status', orderable:false, searchable: false, className: 'text-center align-middle' },
                   { name: 'action', orderable:false, searchable: false, className: 'text-center align-middle' },
                ]
            });
        }
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        })

        function resetPassword(id){
        swalWithBootstrapButtons.fire({
                title: "Reset Password?",
                text: "Reset password?",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("listAkunUmum/update") }}' + '/' + id,
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
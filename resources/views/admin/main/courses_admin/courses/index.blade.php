@extends('admin/layouts/app')
@section('path')
Course
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">Course</h3>
            <a href="{{route('addCourse.create')}}" class="btn btn-primary btn-sm">Add Course</a>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered invisible" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataadmin as $da)
                        <tr>
                            <td>
                                {{$da->nama_kursus}}
                            </td>

                            <td>
                                {{$da->deskripsi}}
                            </td>

                            <td class="text-center">
                                <li class="btn btn-sm {{$da->status==1?'btn-success':'btn-danger'}} disabled">
                                    {{$da->status==1?'Active':'Inactive'}}</li>
                            </td>

                            <td class="d-flex justify-content-center">
                                <a href="{{route('addCourse.edit',$da->id_kursus)}}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-pen-fill text-green"></i></a>
                                <form action="{{route('addCourse.deactive',$da->id_kursus)}}" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary  js-button-submit" type="button"><i
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
        // Tampilkan tabel setelah #dataTable telah terload sepenuhnya.
        $("#dataTable").removeClass("invisible");

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        });

        // Button Delete
        $("#dataTable").on("click", ".js-button-submit", function () {
            swalWithBootstrapButtons.fire({
                title: "Deactive Course?",
                text: "Are you sure want to make change to this course ?",
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
    });
   
       

</script>
@endpush
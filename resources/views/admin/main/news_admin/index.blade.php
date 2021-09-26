@extends('admin/layouts/app')
@section('path')
News
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">News</h3>
            <a href="{{route('addNews.create')}}" class="btn btn-primary btn-sm">Add News</a>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_berita as $berita)
                        <tr>
                            <td class="text-center">
                                {{$berita->tanggal_berita}}
                            </td>

                            <td class="text-center">
                                {{$berita->judul_berita}}
                            </td>

                            <td class="d-flex justify-content-center">
                                <a href="{{route('addNews.edit', $berita->id_berita)}}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-pen-fill text-green"></i></a>
                                <form action="{{route('addNews.destroy', $berita->id_berita)}}" method="POST"
                                    class="formDeleteBerita">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-secondary button-delete"><i
                                            class="bi bi-trash2-fill text-red"
                                           ></i></button>
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
        });

        // Button Delete
        $("#dataTable").on("click", ".button-delete", function () {
            swalWithBootstrapButtons.fire({
                title: "Delete berita?",
                text: "Apakah anda yakin ingin melakukan delete pada berita ini?",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Ya!",
                cancelButtonText: "Batal!",
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
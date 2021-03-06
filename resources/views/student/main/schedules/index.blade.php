@extends('student/layouts/app')
@section('path')
Quota
@endsection
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Quota</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light text-center">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Test Name</th>
                                <th scope="col" class="sort" data-sort="name">Description</th>
                                <th scope="col" class="sort" data-sort="budget">Quota</th>
                            </tr>
                        </thead>
                        @foreach ($nama_kursus as $nk)
                        <tr class="text-center">
                            <th scope="row">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$nk->nama_kursus}}</span>
                                </div>
                            </th>
                            <th scope="row">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$nk->deskripsi}}</span>
                                </div>
                            </th>
                            <td class="budget">
                                <!-- Button trigger modal -->
                                <button type="button" class="view-quota btn btn-primary" value="{{$nk->id_kursus}}">
                                    View Quota
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="">
                            <ul class="pagination justify-content-end mb-0">
                                {!! $nama_kursus->links() !!}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal-quota" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quota">Quota</h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center" id="modal-body">
                        {{-- data disini --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="close btn btn-secondary"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @push('js')
        <script>
            $(function() {
                $(".view-quota").on("click", function() {
                    $.getJSON(
                        `/api/courses/${ $(this).val() }`, 
                        function(jsonData) {
                            let div = "<div class='modal-body' id='modal-body'>";
                            $.each(jsonData, function(i, kursus) {
                                div += "<p>"
                                // + `<b> ${jadwal.hari} `
                                // + `, ${jadwal.jadwal_mulai.substring(0, 5)} - `
                                // + `${jadwal.jadwal_selesai.substring(0, 5)}</b> | `
                                + `<b>${kursus.partisipan_saat_ini} / `
                                + `${kursus.batas_partisipan}</b>`
                                + "</p>";
                            });
                            div += "</div>";
                            $("#modal-body").html(div);
                            $("#modal-quota").modal("show");
                        }
                    );
                });
            });
        </script>
        @endpush
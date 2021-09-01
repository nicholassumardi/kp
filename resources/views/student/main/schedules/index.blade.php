@extends('student/layouts/app')
@section('path')
Schedules
@endsection
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Schedules</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light text-center">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Test Name</th>
                                <th scope="col" class="sort" data-sort="budget">Schedules</th>
                            </tr>
                        </thead>
                        @foreach ($nama_kursus as $nk)
                        <tr class="text-center">
                            <th scope="row">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$nk->nama_kursus}} @if (isset($nk->tipe_kursus)) {{ '- ' . $nk->tipe_kursus }} @endif</span>
                                </div>
                            </th>
                            <td class="budget">
                                <!-- Button trigger modal -->
                                <button type="button" class="view-schedules btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenter" id="view-schedules" value="{{$nk->id_kursus}}">
                                    View Schedules
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="schedules">Schedules</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modal-body">
                                         
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="close btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>

                    </table>

                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @push('js')
        <script>
            $(function() {
                $(".view-schedules").on("click", function() {
                    // Ubah dropdown schedules
                    $.getJSON(
                        `/api/courses/${ $(this).val() }/schedules`, 
                        function(jsonData) {
                            let select = "<div class='modal-body' id='modal-body'>";
                            $.each(jsonData, function(i, jadwal) {
                                select += "<p>"
                                + jadwal.hari 
                                + `, ${jadwal.jadwal_mulai.substring(0, 5)} - ${jadwal.jadwal_selesai.substring(0, 5)}</p>`;
                            });
                            select += "</div>";
                            $("#modal-body").html(select);
                        }
                    );
                });
            });
        </script>
        @endpush
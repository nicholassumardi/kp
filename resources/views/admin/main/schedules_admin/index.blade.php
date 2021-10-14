@extends('admin/layouts/app')
@section('path')
Schedules
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">Schedules</h3>
            <a href="{{route('schedules.create')}}" class="btn btn-primary btn-sm">Add Schedules</a>
        </div>



        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered invisible" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Description</th>
                            <th>Schedules</th>
                            <th>Maximum Participants</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nama_kursus as $key => $nk)

                        <tr>
                            <td>{{$nk->nama_kursus}} @if (isset($nk->tipe_kursus)) {{ '- ' . $nk->tipe_kursus }} @endif</td>
                            <td>{{ $nk->deskripsi }}</td>
                            <td>{{$jadwal[$key]->hari}},
                                {{\Carbon\Carbon::createFromFormat('H:i:s',$jadwal[$key]->jadwal_mulai)->format('H:i')}}
                                -
                                {{\Carbon\Carbon::createFromFormat('H:i:s',$jadwal[$key]->jadwal_selesai)->format('H:i')}}
                            </td>

                            <td>{{ $jadwal[$key]->batas_partisipan }}</td>

                            <td class="d-flex justify-content-center">
                                <a href="{{route('schedules.edit',$jadwal[$key]->id_jadwal)}}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-pen-fill text-green"></i></a>
                                <form action="{{route('schedules.destroy',$jadwal[$key]->id_jadwal)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary"><i
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
    });
</script>
@endpush
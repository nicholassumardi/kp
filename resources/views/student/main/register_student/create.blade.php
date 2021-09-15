@extends('student/layouts/app')
@section('path')
Register Courses
@endsection
@section('content')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h2 class="mb-0">Register</h2>
                </div>

                <form action="{{ route('registerCourses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Light table -->
                    <div class="table-responsive">
                        <div class="card-body">
                            <h3 class="mb-0">Please make sure all fields are filled in correctly.</h3>
                            <div class="row mt-5 justify-content-center">
                                <div class="col-xl-10">
                                    <label for="form-control">Courses</label>

                                    <select class="form-control" id="courses-dropdown" name="kursus_id">
                                        @foreach ($nama_kursus as $nk)
                                        <option value="{{$nk->id_kursus}}">{{$nk->nama_kursus}} @if (isset($nk->tipe_kursus)) {{ '- ' . $nk->tipe_kursus }} @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3 mb-4 justify-content-center">
                                <div class="col-xl-10">
                                    <label for="session">Session</label>
                                    <select class="form-control" id="courses-session" name="jadwal_id">
                                        @foreach ($jadwal as $jdwl)
                                        <option value="{{$jdwl->id_jadwal}}">{{$jdwl->hari}}, {{\Carbon\Carbon::createFromFormat('H:i:s',$jdwl->jadwal_mulai)->format('H:i')}} - {{\Carbon\Carbon::createFromFormat('H:i:s',$jdwl->jadwal_selesai)->format('H:i')}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3 justify-content-center {{ $kursus_index_pertama->bukti_pembayaran === 1 ? 'mb-4' : 'mb-5' }}" id="container-foto-bukti-pembayaran">
                                <div class="col-xl-10">
                                    <label for="form-control">Foto Bukti Pembayaran</label>
                                    <input class="form-control customicon" type="file" name="path_foto_kuitansi">
                                    <small class="form-text text-muted">* Foto harus discan dan dalam keadaan landscape.</small>
                                </div>
                            </div>

                            <div class="row mt-3 mb-5 justify-content-center {{ $kursus_index_pertama->bukti_pembayaran !== 1 ? 'd-none' : '' }}" id="container-foto-mahasiswa">
                                <div class="col-xl-10">
                                    <label for="form-control">Foto Mahasiswa</label>
                                    <input class="form-control customicon" type="file" name="path_foto_mahasiswa">
                                    <small class="form-text text-muted">
                                        * Foto harus 3x4 dengan background merah.
                                        <br>
                                        * Foto harus dalam keadaan portrait.
                                    </small>
                                </div>
                            </div>
                            
                            <div class="row justify-content-center mb-5">
                                <div class="col-xl-10">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection
    
    @push('js')
    <script>
        $(function() {
            $("#courses-dropdown").on("change", function() {
                // Ubah dropdown schedules
                $.getJSON(
                    `api/courses/${ $(this).val() }/schedules`, 
                    function(jsonData) {  
                        let select = "<select class='form-control' id='courses-session' name='jadwal_id'>";
                        $.each(jsonData, function(i, jadwal) {
                            select += `<option value='${jadwal.id_jadwal}'>`
                            + `${jadwal.hari}, ${jadwal.jadwal_mulai.substring(0, 5)} - `
                            + `${jadwal.jadwal_selesai.substring(0, 5)}`
                            + "</option>";
                        });
                        select += "</select>";
                        $("#courses-session").html(select);
                    }
                );

                // Hide dan show foto mahasiswa
                $.getJSON(
                    `api/courses/${ $(this).val() }`, 
                    function(jsonData) {
                        const kursus = jsonData[0];
                        const containerFotoMahasiswa = $("#container-foto-mahasiswa");
                        const containerFotoBuktiPembayaran = $("#container-foto-bukti-pembayaran");

                        if (kursus.bukti_pembayaran === 1) {
                            containerFotoMahasiswa.removeClass("d-none");
                            containerFotoBuktiPembayaran.removeClass("mb-5").addClass("mb-4");
                        } else {
                            containerFotoMahasiswa.addClass("d-none");
                            containerFotoBuktiPembayaran.removeClass("mb-4").addClass("mb-5");
                        }
                    }
                );
            });
           
        });
    </script>
    @endpush
    
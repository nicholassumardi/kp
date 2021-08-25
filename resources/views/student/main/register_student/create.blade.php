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
                                        <option value="{{$nk->id_kursus}}">{{$nk->nama_kursus}}</option>
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

                            <div class="row mt-3 justify-content-center {{ $kursus_index_pertama->bukti_pembayaran === 1 ? 'mb-4' : 'mb-5' }}">
                                <div class="col-xl-10">
                                    <label for="form-control">Foto Bukti Pembayaran</label>
                                    <input class="form-control customicon" type="file" id="" name="path_foto_kuitansi">
                                    <small class="form-text text-muted">* Foto harus discan dan dalam keadaan landscape.</small>
                                </div>
                            </div>

                            <div class="row mt-3 mb-5 justify-content-center" id="container-foto-mahasiswa" data-bukti-pembayaran="{{ $kursus_index_pertama->bukti_pembayaran }}">
                                <div class="col-xl-10">
                                    <label for="form-control">Foto Mahasiswa</label>
                                    <input class="form-control customicon" type="file" id="" name="path_foto_mahasiswa">
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
                    "/courses/" + $(this).val() + "/schedules", 
                    function(jsonData) {
                        console.log(jsonData);   
                        let select = "<select class='form-control' id='courses-session'>";
                        $.each(jsonData, function(i, jadwal) {
                            select += "<option value='" 
                            + jadwal.kursus_id 
                            + "'>" 
                            + jadwal.hari 
                            + `, ${jadwal.jadwal_mulai.substring(0, 5)} - ${jadwal.jadwal_selesai.substring(0, 5)}</option>`;
                        });
                        select += "</select>";
                        $("#courses-session").html(select);
                    }
                );

                // Hide dan show foto mahasiswa
                $.getJSON(
                    "/courses/" + $(this).val() + "/bukti_pembayaran", 
                    function(jsonData) {
                        let kursus = jsonData[0];
                        if (kursus.bukti_pembayaran === 1) {
                            $("#container-foto-mahasiswa").show();
                        } else {
                            $("#container-foto-mahasiswa").hide();
                        }
                        
                    }
                );
            });

            // Hide dan show foto mahasiswa saat page diload
            if ($("#container-foto-mahasiswa").data("buktiPembayaran") === 0) {
                $("#container-foto-mahasiswa").hide();
            }
        });
    </script>
    @endpush
    
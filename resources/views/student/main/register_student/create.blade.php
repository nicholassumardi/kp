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

                {{-- Jika admin sudah membuat kursus --}}
                @if ($kursus_index_pertama !== null)

                <form action="{{ route('registerCourses.store') }}" method="POST" enctype="multipart/form-data"
                    id="form-register">
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
                                        @if ($nk->status === 1)
                                        <option value="{{$nk->id_kursus}}">{{$nk->nama_kursus}}</option>
                                        @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            {{-- <div class="row mt-3 mb-4 justify-content-center">
                                <div class="col-xl-10">
                                    <label for="session">Session</label>
                                    <select class="form-control bg-white" id="courses-session" name="jadwal_id">
                                        @foreach ($jadwal as $jdwl)
                                        <option value="{{$jdwl->id_jadwal}}">{{$jdwl->hari}},
                                            {{\Carbon\Carbon::createFromFormat('H:i:s',$jdwl->jadwal_mulai)->format('H:i')}}
                                            -
                                            {{\Carbon\Carbon::createFromFormat('H:i:s',$jdwl->jadwal_selesai)->format('H:i')}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="row mt-3 justify-content-center {{ $kursus_index_pertama !== 1 ? 'mb-4' : 'mb-4' }}"
                                id="container-foto-bukti-pembayaran">
                                <div class="col-xl-10">
                                    <label for="form-control">Foto Bukti Pembayaran (Kuitansi)</label>
                                    <input class="form-control customicon input-file" type="file"
                                        name="path_foto_kuitansi" required>
                                    <small class="form-text text-muted">
                                        * Foto harus discan dan dalam keadaan
                                        landscape.
                                        <br>
                                        * Size Maximum File 1 MB.
                                        <br>
                                        * Foto harus dalam format JPEG atau PNG.
                                    </small>
                                </div>
                            </div>

                            <div class="row mt-3 justify-content-center {{ $kursus_index_pertama !== 1 ? 'mb-4' : 'mb-4' }}"
                                id="container-foto-mahasiswa">
                                <div class="col-xl-10">
                                    <label for="form-control">Foto Mahasiswa</label>
                                    <input class="form-control customicon input-file" type="file"
                                        name="path_foto_mahasiswa" required>
                                    <small class="form-text text-muted">
                                        * Foto harus 3x4 dengan mengenakan Jas Alamamater dan Pakaian Formal.
                                        <br>
                                        * Foto harus dalam keadaan portrait.
                                        <br>
                                        * Size Maximum File 1 MB.
                                        <br>
                                        * Foto harus dalam format JPEG atau PNG.
                                    </small>
                                </div>
                            </div>

                            <div class="row mt-3 mb-5 justify-content-center {{ $kursus_index_pertama !== 1 ? 'd-none' : '' }}"
                                id="container-sertifikat">
                                <div class="col-xl-10">
                                    <label for="form-control">Foto Bukti Sertifikat English Course</label>
                                    <input class="form-control customicon input-file" type="file"
                                        name="path_foto_sertifikat" id="js-path-foto-sertifikat" {{
                                        $kursus_index_pertama ? 'required' : '' }}>
                                    <small class="form-text text-muted">
                                        * Foto harus discan dan dalam keadaan
                                        landscape.
                                        <br>
                                        * Size Maximum File 1 MB.
                                        <br>
                                        * Foto harus dalam format JPEG atau PNG.
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

                {{-- Jika admin belum membuat kursus --}}
                @else
                <div class="card-body">
                    <h3 class="text-center">Maaf, belum ada kursus yang terdaftar saat ini.</h3>
                </div>
                @endif


            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(function() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        });
        
        $("#courses-dropdown").on("change", async function() {
            // Disable dropdown session saat JSON masih diload.
            // $("#courses-session").attr("disabled", "disabled");
            
            // // Ubah dropdown schedules
            // await $.getJSON(
            //     `api/courses/${ $(this).val() }/schedules`, 
            //     function(jsonData) {  
            //         let select = "<select class='form-control' id='courses-session' name='jadwal_id'>";
            //         $.each(jsonData, function(i, jadwal) {
            //             select += `<option value='${jadwal.id_jadwal}'>`
            //             + `${jadwal.hari}, ${jadwal.jadwal_mulai.substring(0, 5)} - `
            //             + `${jadwal.jadwal_selesai.substring(0, 5)}`
            //             + "</option>";
            //         });
            //         select += "</select>";
            //         $("#courses-session").html(select);
            //     }
            // );

            // // Enable dropdown session saat JSON selesai diload.
            // $("#courses-session").removeAttr("disabled");

            // Hide dan show foto mahasiswa
            $.getJSON(
                `api/courses/${ $(this).val() }`, 
                function(jsonData) {
                    const kursus = jsonData[0];
                    const containerFotoBuktiPembayaran = $("#container-foto-bukti-pembayaran");
                    const containerFotoMahasiswa = $("#container-foto-mahasiswa");
                    const containerSertifikat = $("#container-sertifikat");
                    const jsPathFotoSertifikat = $("#js-path-foto-sertifikat");
                    
                    
                    if (kursus.sertifikat === 1) {
                        containerFotoBuktiPembayaran.removeClass("mb-5").addClass("mb-4");
                        containerFotoMahasiswa.removeClass("mb-5").addClass("mb-4");
                        containerSertifikat.removeClass("d-none");
                        jsPathFotoSertifikat.attr('required', 'required');
                    } else {
                        containerFotoBuktiPembayaran.removeClass("mb-4").addClass("mb-5");
                        containerFotoMahasiswa.removeClass("mb-4").addClass("mb-5");
                        containerSertifikat.addClass("d-none");
                        jsPathFotoSertifikat.removeAttr('required');                            
                    }
                }
            );
        });
        
        $("#form-register").on("change", ".input-file", function() {
            // Jika file dipilih (dalam artian tidak membatalkan input file)
            if (this.files[0] !== undefined) {
                const oneMegabyteToBytes = 1000000;
                const ukuranFileDalamMegabyte = this.files[0].size / oneMegabyteToBytes;
                
                // Jika ukuran file lebih besar dari 1 MB, reset kolom inputan
                // atau batalkan inputan dan beri peringatan alert.
                if (ukuranFileDalamMegabyte > 1) {
                    this.value = "";

                    const labelInputFile = $(this).prev().text().toLowerCase();
                    
                    swalWithBootstrapButtons.fire({
                        title: "Peringatan!",
                        text: `Size maximum file ${labelInputFile} adalah 1 MB. Silahkan upload file Anda kembali!`,
                        icon: "warning",
                        showCloseButton: true,
                    });
                }
            }
        });
    });
</script>
@endpush
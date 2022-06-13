@extends('public/layouts/app')
@section('path')
Dashboard
@endsection
@section('content')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0 d-flex justify-content-between">
                    <h3 class="mb-0">Dashboard</h3>
                    <a href="{{route('umum.index')}}" class="btn btn-outline-success btn-sm"><i
                            class="bi bi-arrow-left"></i> Back</a>
                </div>
                <form
                    action="{{route('umum.update',['id_umum' => $umum->id_umum, 'id_kursus' => $kursus->id_kursus])}}"
                    method="POST" enctype="multipart/form-data" id="form-edit">
                    @method('PATCH')
                    @csrf

                    <!-- Light table -->
                    <div class="table-responsive">
                        <div class="card-body">
                            <h3 class="mb-0">Please make sure all fields are filled in correctly.</h3>

                            <div class="row mt-3 mb-5 justify-content-center">
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

                            <div class="row mt-3 mb-5 justify-content-center">
                                <div class="col-xl-10">
                                    <label for="form-control">Foto Mahasiswa</label>
                                    <input class="form-control customicon input-file" type="file"
                                        name="path_foto_umum" required>
                                    <small class="form-text text-muted">
                                        * Foto harus 3x4 dengan background merah.
                                        <br>
                                        * Foto harus dalam keadaan portrait.
                                        <br>
                                        * Size Maximum File 1 MB.
                                        <br>
                                        * Foto harus dalam format JPEG atau PNG.
                                        <br>
                                    </small>
                                </div>
                            </div>

                            <div class="row mt-3 mb-5 justify-content-center {{ $kursus->sertifikat !== 1 ? 'd-none' : '' }}"
                                id="container-sertifikat">
                                <div class="col-xl-10">
                                    <label for="form-control">Foto Bukti Sertifikat English Course</label>
                                    <input class="form-control customicon input-file" type="file" name="path_foto_sertifikat" id="js-path-foto-sertifikat" {{ $kursus->sertifikat === 1 ? 'required' : '' }}>
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
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
              

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

        $("#form-edit").on("change", ".input-file", function() {
            // Jika file dipilih (dalam artian tidak membatalkan input file)
            if (this.files[0] !== undefined) {
                const oneMegabyteToBytes = 1000000;
                const ukuranFileDalamMegabyte = this.files[0].size / oneMegabyteToBytes;
                const labelInputFile = $(this).prev().text().toLowerCase();
               
                // Jika ukuran file lebih besar dari 1 MB, reset kolom inputan
                // atau batalkan inputan dan beri peringatan alert.
                if (ukuranFileDalamMegabyte > 1) {
                    this.value = "";
                    
                    swalWithBootstrapButtons.fire({
                        title: "Peringatan!",
                        text: `Size maximum ${labelInputFile} adalah 1 MB. Silahkan upload file Anda kembali!`,
                        icon: "warning",
                        showCloseButton: true,
                    });
                }
            }
        });
    });
</script>
@endpush

@extends('public/layouts/app')
@section('path')
Register Courses
@endsection
@section('content')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0 d-flex justify-content-between">
                    <h3 class="mb-0">Penerjemahan</h3>
                    <a href="{{route('penerjemahan-public.index')}}" class="btn btn-outline-success btn-sm"><i
                            class="bi bi-arrow-left"></i> Back</a>
                </div>

                <form action="{{ route('penerjemahan-public.updateIjazah', $ijazah->id_ijazah_umum) }}" method="POST"
                    enctype="multipart/form-data" id="form-ijazah">
                    @method('PATCH')
                    @csrf

                    <div class="row mt-3 mb-2 justify-content-center">
                        <div class="col-xl-10">
                            <label for="form-control">Email</label>
                            <input class="form-control customicon" type="email" name="email" value="{{$ijazah->email}}"
                                required>
                            <small class="form-text text-muted">
                                * Email yang bisa di hubungi.
                            </small>
                        </div>
                    </div>

                    <div class="row mt-3 mb-2 justify-content-center">
                        <div class="col-xl-10">
                            <label for="form-control">No. HP</label>
                            <input class="form-control customicon" type="number" name="no_hp" value="{{$ijazah->no_hp}}"
                                required>
                            <small class="form-text text-muted">
                                * No. HP yang bisa di hubungi.
                            </small>
                        </div>
                    </div>


                    <div class="row mt-3 mb-2 justify-content-center" id="div-bukti-pembayaran">
                        <div class="col-xl-10">
                            <label for="form-control">Foto Bukti Pembayaran</label>
                            <input class="form-control customicon input-file" type="file" name="path_foto_kuitansi" required>
                            <small class="form-text text-muted">
                                * Foto harus discan dan dalam keadaan
                                landscape.
                                <br>
                                * Size Maximum File 1 MB
                                <br>
                                * Foto harus dalam format JPEG atau PNG.
                            </small>
                        </div>
                    </div>


                    <div class="row mt-3 mb-5 justify-content-center" id="div-ijazah">
                        <div class="col-xl-10">
                            <label for="form-control">File Ijazah</label>
                            <input class="form-control customicon input-file" type="file" name="path_file_ijazah">
                            <small class="form-text text-muted">
                                * File harus dalam format PDF atau foto (JPEG atau PNG).
                                <br>
                                * Size Maximum File 1 MB
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
        
        $("#form-ijazah").on("change", ".input-file", function() {
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
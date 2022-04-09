@extends('public/layouts/app')
@section('path')

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

                <form
                    action="{{ route('penerjemahan-public.updateTranskripNilai', $transkrip_nilai->id_transkrip_nilai_umum) }}"
                    method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf


                    <div class="row mt-3 mb-2 justify-content-center">
                        <div class="col-xl-10">
                            <label for="form-control">Email</label>
                            <input class="form-control customicon" type="email" name="email"
                                value="{{$transkrip_nilai->email}}" required>
                            <small class="form-text text-muted">
                                * Email yang bisa di hubungi.
                            </small>
                        </div>
                    </div>

                    <div class="row mt-3 mb-2 justify-content-center">
                        <div class="col-xl-10">
                            <label for="form-control">No. HP</label>
                            <input class="form-control customicon" type="number" name="no_hp"
                                value="{{$transkrip_nilai->no_hp}}" required>
                            <small class="form-text text-muted">
                                * No. HP yang bisa di hubungi.
                            </small>
                        </div>
                    </div>


                    <div class="row mt-3 mb-2 justify-content-center" id="div-bukti-pembayaran">
                        <div class="col-xl-10">
                            <label for="form-control">Foto Bukti Pembayaran</label>
                            <input class="form-control customicon" type="file" name="path_foto_kuitansi" required>
                            <small class="form-text text-muted">
                                * Foto harus discan dan dalam keadaan
                                landscape.
                                <br>
                                * Foto harus dalam format JPEG atau PNG.
                            </small>
                        </div>
                    </div>


                    <div class="row mt-3 mb-5 justify-content-center" id="div-transkrip-nilai">
                        <div class="col-xl-10">
                            <label for="form-control">File Transkrip</label>
                            <input class="form-control customicon" type="file" name="path_file_transkrip_nilai">
                            <small class="form-text text-muted">
                                * File harus dalam format PDF atau foto (JPEG atau PNG).
                                <br>
                                * Size Maximum File 5MB
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
        
        $("input[name='path_file_transkrip_nilai']").on("change", function() {
            // Jika file dipilih (dalam artian tidak membatalkan input file)
            if (this.files[0] !== undefined) {
                const oneMegabyteToBytes = 1000000;
                const ukuranFileDalamMegabyte = this.files[0].size / oneMegabyteToBytes;
                
                // Jika ukuran file lebih besar dari 5 MB, reset kolom inputan
                // atau batalkan inputan dan beri peringatan alert.
                if (ukuranFileDalamMegabyte > 5) {
                    this.value = "";

                    swalWithBootstrapButtons.fire({
                        title: "Peringatan!",
                        text: "Size maximum file transkrip adalah 5 MB. Silahkan upload file Anda kembali!",
                        icon: "warning",
                        showCloseButton: true,
                    });
                }
            }
        });
    });
</script>
@endpush
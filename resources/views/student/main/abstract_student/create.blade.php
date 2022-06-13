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
                <div class="card-header border-0 d-flex justify-content-between">
                    <h3 class="mb-0">Penerjemahan</h3>
                    <a href="{{route('penerjemahan-student.index')}}" class="btn btn-outline-success btn-sm"><i
                            class="bi bi-arrow-left"></i> Back</a>
                </div>

                <form action="{{ route('penerjemahan-student.store') }}" method="POST" enctype="multipart/form-data" id="form-penerjemahan">
                    @csrf

                    <div class="row mt-3 mb-2 justify-content-center">
                        <div class="col-xl-10">
                            <label for="form-control">Layanan</label>

                            <select class="form-control" id="layanan-dropdown" name="layanan">
                                <option value="abstrak">Abstrak</option>
                                <option value="transkripnilai">Transkrip Nilai</option>
                                <option value="ijazah">Ijazah</option>
                                <option value="transkripnilai_ijazah">Transkrip Nilai dan Ijazah</option>
                                <option value="jurnal">Jurnal</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3 mb-2 justify-content-center">
                        <div class="col-xl-10">
                            <label for="form-control">Email</label>
                            <input class="form-control customicon" type="email" name="email" required>
                            <small class="form-text text-muted">
                                * Email yang bisa di hubungi.
                            </small>
                        </div>
                    </div>

                    <div class="row mt-3 mb-2 justify-content-center">
                        <div class="col-xl-10">
                            <label for="form-control">No. HP</label>
                            <input class="form-control customicon" type="number" name="no_hp" required>
                            <small class="form-text text-muted">
                                * No. HP yang bisa di hubungi.
                            </small>
                        </div>
                    </div>

                    <div class="row mt-3 mb-2 justify-content-center d-none" id="div-halaman-jurnal">
                        <div class="col-xl-10">
                            <label for="form-control">Jumlah Halaman</label>
                            <input class="form-control customicon" type="number" name="jumlah_halaman_jurnal">
                            <small class="form-text text-muted">
                                * Jumlah halaman jurnal.
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
                                * Size Maximum File 1 MB.
                                <br>
                                * Foto harus dalam format JPEG atau PNG.
                            </small>
                        </div>
                    </div>

                    <div class="row mt-3 mb-2 justify-content-center d-none" id="div-bukti-pembayaran-transkrip-nilai">
                        <div class="col-xl-10">
                            <label for="form-control">Foto Bukti Pembayaran Transkrip Nilai</label>
                            <input class="form-control customicon input-file" type="file"
                                name="path_foto_kuitansi_transkrip_nilai">
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

                    <div class="row mt-3 mb-2 justify-content-center d-none" id="div-bukti-pembayaran-ijazah">
                        <div class="col-xl-10">
                            <label for="form-control">Foto Bukti Pembayaran Ijazah</label>
                            <input class="form-control customicon input-file" type="file" name="path_foto_kuitansi_ijazah">
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

                    <div class="row mt-3 mb-5 justify-content-center" id="div-abstrak">
                        <div class="col-xl-10">
                            <label for="form-control">File Abstract</label>
                            <input class="form-control customicon input-file" type="file" name="path_file_abstrak_mahasiswa"
                                required>
                            <small class="form-text text-muted">
                                * File harus dalam format word (doc, docx).
                                <br>
                                * Size Maximum File 1 MB.
                                <br>
                                * Format file: Nama_NPM. Contoh: Muhammad Iqbal_06.2018.1.07777
                            </small>
                        </div>
                    </div>

                    <div class="row mt-3 mb-5 justify-content-center d-none" id="div-transkrip-nilai">
                        <div class="col-xl-10">
                            <label for="form-control">File Transkrip</label>
                            <input class="form-control customicon input-file" type="file" name="path_file_transkrip_nilai">
                            <small class="form-text text-muted">
                                * File harus dalam format PDF atau foto (JPEG atau PNG).
                                <br>
                                * Size Maximum File 1 MB.
                            </small>
                        </div>
                    </div>

                    <div class="row mt-3 mb-5 justify-content-center d-none" id="div-ijazah">
                        <div class="col-xl-10">
                            <label for="form-control">File Ijazah</label>
                            <input class="form-control customicon input-file" type="file" name="path_file_ijazah">
                            <small class="form-text text-muted">
                                * File harus dalam format PDF atau foto (JPEG atau PNG).
                                <br>
                                * Size Maximum File 1 MB.
                            </small>
                        </div>
                    </div>

                    <div class="row mt-3 mb-5 justify-content-center d-none" id="div-jurnal">
                        <div class="col-xl-10">
                            <label for="form-control">File Jurnal</label>
                            <input class="form-control customicon input-file" type="file" name="path_file_jurnal_mahasiswa">
                            <small class="form-text text-muted">
                                * File harus dalam format word (doc, docx).
                                <br>
                                * Size Maximum File 2 MB.
                                <br>
                                * Format file: Nama_NPM. Contoh: Muhammad Iqbal_06.2018.1.07777
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
        
        $("#form-penerjemahan").on("change", ".input-file", function() {
            // Jika file dipilih (dalam artian tidak membatalkan input file)
            if (this.files[0] !== undefined) {
                const oneMegabyteToBytes = 1000000;
                const ukuranFileDalamMegabyte = this.files[0].size / oneMegabyteToBytes;
                const labelInputFile = $(this).prev().text().toLowerCase();
                
                // Jika file adalah jurnal.
                if (labelInputFile.includes("jurnal")) {
                    // Jika ukuran file lebih besar dari 2 MB, reset kolom inputan
                    // atau batalkan inputan dan beri peringatan alert.
                    if (ukuranFileDalamMegabyte > 2) {
                        this.value = "";
                        
                        swalWithBootstrapButtons.fire({
                            title: "Peringatan!",
                            text: `Size maximum ${labelInputFile} adalah 2 MB. Silahkan upload file Anda kembali!`,
                            icon: "warning",
                            showCloseButton: true,
                        });
                    }
                } 
                // Jika file bukan jurnal.
                else {
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
            }
        });
        
        $("#layanan-dropdown").on("change", async function() {
            const layananDropdown = $(this);
            const divAbstrak = $("#div-abstrak");
            const divBuktiPembayaran = $("#div-bukti-pembayaran");
            const divTranskripNilai = $("#div-transkrip-nilai");
            const divIjazah = $("#div-ijazah");
            const divBuktiPembayaranTranskripNilai = $("#div-bukti-pembayaran-transkrip-nilai");
            const divBuktiPembayaranIjazah = $("#div-bukti-pembayaran-ijazah");
            const divJurnal = $("#div-jurnal");
            const divHalamanJurnal = $("#div-halaman-jurnal");

            if (layananDropdown.val() === "abstrak") {

                divAbstrak.removeClass("d-none");
                divAbstrak.find("input").attr("required", "required");
                
                
                
                divTranskripNilai.addClass("d-none");
                divTranskripNilai.find("input").removeAttr("required");
                divIjazah.addClass("d-none");
                divIjazah.find("input").removeAttr("required");
                divBuktiPembayaranTranskripNilai.addClass("d-none");
                divBuktiPembayaranTranskripNilai.find("input").removeAttr("required");
                divBuktiPembayaranIjazah.addClass("d-none");
                divBuktiPembayaranIjazah.find("input").removeAttr("required");
                divJurnal.addClass("d-none");
                divJurnal.find("input").removeAttr("required");
                divHalamanJurnal.addClass("d-none");
                divHalamanJurnal.find("input").removeAttr("required");

            } else if (layananDropdown.val() === "transkripnilai") {

                divTranskripNilai.removeClass("d-none");
                divTranskripNilai.removeClass("mb-3");
                divTranskripNilai.addClass("mb-5");
                divTranskripNilai.find("input").attr("required", "required");
                divBuktiPembayaran.removeClass("d-none");
                divBuktiPembayaran.find("input").attr("required", "required");
                
                
                divBuktiPembayaranTranskripNilai.addClass("d-none");
                divBuktiPembayaranTranskripNilai.find("input").removeAttr("required");
                divAbstrak.addClass("d-none");
                divAbstrak.find("input").removeAttr("required");
                divIjazah.addClass("d-none");
                divIjazah.find("input").removeAttr("required");
                divBuktiPembayaranIjazah.addClass("d-none");
                divBuktiPembayaranIjazah.find("input").removeAttr("required");
                divJurnal.addClass("d-none");
                divJurnal.find("input").removeAttr("required");
                divHalamanJurnal.addClass("d-none");
                divHalamanJurnal.find("input").removeAttr("required");

            } else if (layananDropdown.val() === "ijazah") {

                divIjazah.removeClass("d-none");
                divIjazah.find("input").attr("required", "required");
                divBuktiPembayaran.removeClass("d-none");
                divBuktiPembayaran.find("input").attr("required", "required");

                divBuktiPembayaranIjazah.addClass("d-none");
                divBuktiPembayaranIjazah.find("input").removeAttr("required");
                divAbstrak.addClass("d-none");
                divAbstrak.find("input").removeAttr("required");
                divTranskripNilai.addClass("d-none");
                divTranskripNilai.find("input").removeAttr("required");
                divBuktiPembayaranTranskripNilai.addClass("d-none");
                divBuktiPembayaranTranskripNilai.find("input").removeAttr("required");
                divJurnal.addClass("d-none");
                divJurnal.find("input").removeAttr("required");
                divHalamanJurnal.addClass("d-none");
                divHalamanJurnal.find("input").removeAttr("required");

            } else if (layananDropdown.val() === "transkripnilai_ijazah") {

                divTranskripNilai.removeClass("d-none");
                divTranskripNilai.removeClass("mb-5");
                divTranskripNilai.addClass("mb-2");
                divTranskripNilai.find("input").attr("required", "required");
                divIjazah.removeClass("d-none");
                divIjazah.find("input").attr("required", "required");
                divBuktiPembayaranTranskripNilai.removeClass("d-none");
                divBuktiPembayaranTranskripNilai.find("input").attr("required", "required");
                divBuktiPembayaranIjazah.removeClass("d-none");
                divBuktiPembayaranIjazah.find("input").attr("required", "required");

                divAbstrak.addClass("d-none");
                divAbstrak.find("input").removeAttr("required");
                divBuktiPembayaran.addClass("d-none");
                divBuktiPembayaran.find("input").removeAttr("required");
                divJurnal.addClass("d-none");
                divJurnal.find("input").removeAttr("required");
                divHalamanJurnal.addClass("d-none");
                divHalamanJurnal.find("input").removeAttr("required");
            }
             else if (layananDropdown.val() === "jurnal") {
               
                divJurnal.removeClass("d-none");
                divJurnal.find("input").attr("required", "required");
                divHalamanJurnal.removeClass("d-none");
                divHalamanJurnal.find("input").attr("required", "required");
                divBuktiPembayaran.removeClass("d-none");
                divBuktiPembayaran.find("input").attr("required", "required");
                
                divAbstrak.addClass("d-none");
                divAbstrak.find("input").removeAttr("required");
                divTranskripNilai.addClass("d-none");
                divTranskripNilai.find("input").removeAttr("required");
                divIjazah.addClass("d-none");
                divIjazah.find("input").removeAttr("required");
                divBuktiPembayaranTranskripNilai.addClass("d-none");
                divBuktiPembayaranTranskripNilai.find("input").removeAttr("required");
                divBuktiPembayaranIjazah.addClass("d-none");
                divBuktiPembayaranIjazah.find("input").removeAttr("required");

            }
        });
    });
</script>
@endpush
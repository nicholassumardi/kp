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

                <form action="{{ route('penerjemahan-public.updateJurnal', $jurnal->id_jurnal_umum) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf


                    <div class="row mt-3 mb-2 justify-content-center">
                        <div class="col-xl-10">
                            <label for="form-control">Email</label>
                            <input class="form-control customicon" type="email" name="email" value="{{$jurnal->email}}"
                                required>
                            <small class="form-text text-muted">
                                * Email yang bisa di hubungi.
                            </small>
                        </div>
                    </div>

                    <div class="row mt-3 mb-2 justify-content-center">
                        <div class="col-xl-10">
                            <label for="form-control">No. HP</label>
                            <input class="form-control customicon" type="number" name="no_hp" value="{{$jurnal->no_hp}}"
                                required>
                            <small class="form-text text-muted">
                                * No. HP yang bisa di hubungi.
                            </small>
                        </div>
                    </div>

                    <div class="row mt-3 mb-2 justify-content-center d-none" id="div-halaman-jurnal">
                        <div class="col-xl-10">
                            <label for="form-control">Jumlah Halaman</label>
                            <input class="form-control customicon" type="number" name="jumlah_halaman_jurnal"
                                value="{{$jurnal->jumlah_halaman_jurnal}}">
                            <small class="form-text text-muted">
                                * Jumlah halaman jurnal.
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


                    <div class="row mt-3 mb-5 justify-content-center d-none" id="div-jurnal">
                        <div class="col-xl-10">
                            <label for="form-control">File Jurnal</label>
                            <input class="form-control customicon" type="file" name="path_file_jurnal_umum">
                            <small class="form-text text-muted">
                                * File harus dalam format word (doc, docx).
                                <br>
                                * Size Maximum File 5MB
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
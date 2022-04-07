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
                    <h3 class="mb-0">Ijazah</h3>
                    <a href="{{route('penerjemahan-student.index')}}" class="btn btn-outline-success btn-sm"><i
                            class="bi bi-arrow-left"></i> Back</a>
                </div>

                <form action="{{route('penerjemahan-student.updateIjazah', $ijazah->id_ijazah) }}" method="POST"
                    enctype="multipart/form-data">
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
                            <input class="form-control customicon" type="file" name="path_foto_kuitansi" required>
                            <small class="form-text text-muted">
                                * Foto harus discan dan dalam keadaan
                                landscape.
                                <br>
                                * Foto harus dalam format JPEG atau PNG.
                            </small>
                        </div>
                    </div>


                    <div class="row mt-3 mb-5 justify-content-center d-none" id="div-ijazah">
                        <div class="col-xl-10">
                            <label for="form-control">File Ijazah</label>
                            <input class="form-control customicon" type="file" name="path_file_ijazah">
                            <small class="form-text text-muted">
                                * File harus dalam format PDF atau foto (JPEG atau PNG).
                                <br>
                                * Size Maximum File 5 MB.
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
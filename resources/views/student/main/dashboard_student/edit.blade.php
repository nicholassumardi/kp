@extends('student/layouts/app')
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
                    <a href="{{route('student.index')}}" class="btn btn-outline-success btn-sm"><i
                            class="bi bi-arrow-left"></i> Back</a>
                </div>
                <form
                    action="{{route('student.update',['id_mahasiswa' => $mahasiswa->id_mahasiswa, 'id_kursus' => $kursus->id_kursus])}}"
                    method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <!-- Light table -->
                    <div class="table-responsive">
                        <div class="card-body">
                            <h3 class="mb-0">Please make sure all fields are filled in correctly.</h3>

                            <div class="row mt-3 mb-5 justify-content-center">
                                <div class="col-xl-10">
                                    <label for="form-control">Foto Bukti Pembayaran (Kuitansi)</label>
                                    <input class="form-control customicon" type="file"
                                        name="path_foto_kuitansi" required>
                                    <small class="form-text text-muted">
                                        * Foto harus discan dan dalam keadaan
                                        landscape.
                                        <br>
                                        * Foto harus dalam format JPEG atau PNG.
                                    </small>
                                </div>
                            </div>

                            <div class="row mt-3 mb-5 justify-content-center">
                                <div class="col-xl-10">
                                    <label for="form-control">Foto Mahasiswa</label>
                                    <input class="form-control customicon" type="file"
                                        name="path_foto_mahasiswa" required>
                                    <small class="form-text text-muted">
                                        * Foto harus 3x4 dengan background merah.
                                        <br>
                                        * Foto harus dalam keadaan portrait.
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
                                    <input class="form-control customicon" type="file" name="path_foto_sertifikat" id="js-path-foto-sertifikat" {{ $kursus->sertifikat === 1 ? 'required' : '' }}>
                                    <small class="form-text text-muted">
                                        * Foto harus discan dan dalam keadaan
                                        landscape.
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

    @endsection

    @push('js')
        
    @endpush

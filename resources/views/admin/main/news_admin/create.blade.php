@extends('admin/layouts/app')
@section('path')
News
@endsection
@section('content')
<div class="container-fluid mt--6">
    <form action="{{route('addNews.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h3 class="mb-0">Add News</h3>
                    <a href="{{route('addNews.index')}}" class="btn btn-outline-success btn-sm"><i
                            class="bi bi-arrow-left"></i> Back</a>
                </div>
                <div class="card-body p-5">

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>News Title <span class="text-danger">*</span></h4>
                        </label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="judul_berita">
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>Date <span class="text-danger">*</span></h4>
                        </label>

                        <div class="col-sm-7">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control datepicker" placeholder="Select date" type="text"
                                    name="tanggal_berita">
                            </div>
                        </div>

                    </div>


                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>News Photo</h4>
                        </label>
                        <div class="col-sm-7">
                            <input class="form-control customicon" type="file" name="path_foto_berita">
                            <small class="form-text text-muted">
                                * File size max 2 MB.
                                <br>
                            </small>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>News Content <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <textarea name="isi_berita" id="summernote"></textarea>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Create</button>
                    </div>
                </div>

            </div>

    </form>
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
        
        $('#summernote').summernote({
            tabsize: 2,
            height: 350,
        });
            

        $('body').on('focus',".datepicker", function(){
            $(this).datepicker();
        });

        $("input[name='path_foto_berita']").on("change", function() {
            // Jika file dipilih (dalam artian tidak membatalkan input file)
            if (this.files[0] !== undefined) {
                const oneMegabyteToBytes = 1000000;
                const ukuranFileDalamMegabyte = this.files[0].size / oneMegabyteToBytes;
               
                // Jika ukuran file lebih besar dari 2 MB, reset kolom inputan
                // atau batalkan inputan dan beri peringatan alert.
                if (ukuranFileDalamMegabyte > 2) {
                    this.value = "";
                    
                    swalWithBootstrapButtons.fire({
                        title: "Peringatan!",
                        text: `Size maximum news photo adalah 2 MB. Silahkan upload file Anda kembali!`,
                        icon: "warning",
                        showCloseButton: true,
                    });
                }
            }
        });
    });
</script>

@endpush
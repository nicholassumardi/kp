@extends('admin/layouts/app')
@section('path')
News
@endsection
@section('content')
<div class="container-fluid mt--6">
    <form action="{{route('addNews.update', $data_berita->id_berita)}}" method="post" enctype="multipart/form-data">
        @csrf
        @METHOD('PATCH')
        <div class="card">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h3 class="mb-0">Edit News</h3>
                    <a href="{{route('addNews.index')}}" class="btn btn-outline-success btn-sm"><i
                            class="bi bi-arrow-left"></i> Back</a>
                </div>
                <div class="card-body p-5">

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>News Title <span class="text-danger">*</span></h4>
                        </label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="judul_berita"
                                value="{{ $data_berita->judul_berita }}">
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
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>News Content <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <textarea name="isi_berita" id="summernote" value="{{$data_berita->isi_berita}}"></textarea>
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
    $('#summernote').summernote('code', {!! json_encode($data_berita->isi_berita) !!});

    $('#summernote').summernote({
            tabsize: 2,
            height: 350,
        });
        

        $('body').on('focus',".datepicker", function(){
            $(this).datepicker();
         });
    


</script>

@endpush
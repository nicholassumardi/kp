@extends('admin/layouts/app')
@section('path')
Course
@endsection
@section('content')
<div class="container-fluid mt--6">
    <form action="{{route('addCourse.update', $dataKursus->id_kursus)}}" method="post">
        @method('PATCH')
        @csrf
        <div class="card">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h3 class="mb-0">Add Course</h3>
                    <a href="{{route('addCourse.index')}}" class="btn btn-outline-success btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
                </div>
            <div class="card-body p-5">
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                        <h4>Course
                            Name <span class="text-danger">*</span></h4>
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" required name="nama_kursus" placeholder="Course Name" value="{{$dataKursus->nama_kursus}}">
                    </div>

                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                        <h4>Course
                            Type</h4>
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" required name="tipe_kursus" placeholder="Course Type" value="{{$dataKursus->tipe_kursus}}">
                    </div>

                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                        <h4>Course Status <span class="text-danger">*</span></h4>
                    </label>
                    <div class="col-sm-7">
                        <select class="form-control" id="" name="status">
                            <option value="1" @if ($dataKursus->status == 1) {{ 'selected' }} @endif>Active</option>
                            <option value="0" @if ($dataKursus->status == 0) {{ 'selected' }} @endif>Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                        <h4>Need Proof of payment ? <span class="text-danger">*</span></h4>
                    </label>
                    <div class="col-sm-7">
                        <select class="form-control" id="" name="bukti_pembayaran">
                            <option value="1" @if ($dataKursus->bukti_pembayaran == 1) {{ 'selected' }} @endif>Yes</option>
                            <option value="0" @if ($dataKursus->bukti_pembayaran == 0) {{ 'selected' }} @endif>No</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
                </div>
            </div>

        </div>

    </form>
</div>
@endsection
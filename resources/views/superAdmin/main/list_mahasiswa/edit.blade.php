@extends('superAdmin/layouts/app')
@section('indicator')
Edit NPM Mahasiswa
@endsection
@section('content')
<div class="container-fluid mt--6">
    <form action="{{route('listAkunMahasiswa.updateNPM', $mahasiswa->id_mahasiswa)}}" method="post">
        @method('PATCH')
        @csrf
        <div class="card">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h3 class="mb-0">Edit NPM</h3>
                    <a href="{{route('listAkunMahasiswa.index')}}" class="btn btn-outline-success btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
                </div>
                <div class="card-body p-5">
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h3>Nama <span class="text-danger">*</span></h3>
                        </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" value="{{$mahasiswa->nama}}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h3>NPM : <span class="text-danger">*</span></h3>
                        </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" required name="npm" onkeypress="formatNPM(this)" value="{{$mahasiswa->npm}}">
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                    </div>
                </div>

            </div>

    </form>
</div>

@endsection
@push('js')
<script>
    $(function () {
    });
</script>
@endpush
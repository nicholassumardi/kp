@extends('admin/layouts/app')
@section('path')
Schedules
@endsection
@section('content')
<div class="container-fluid mt--6">
    <form action="{{route('schedules.update', $jadwal->id_jadwal)}}" method="post">
        @method('PATCH')
        @csrf
        <div class="card">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h3 class="mb-0">Update Schedules</h3>
                    <a href="{{route('schedules.index')}}" class="btn btn-outline-success btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
                </div>
                <div class="card-body p-5">
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>Course
                                Name <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" disabled value="{{$nama_kursus->nama_kursus}}">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>Day <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="" name="hari" required>
                                <option value="Monday" @if ($jadwal->hari === 'Monday') {{ 'selected' }} @endif>Monday</option>
                                <option value="Tuesday" @if ($jadwal->hari === 'Tuesday') {{ 'selected' }} @endif>Tuesday</option>
                                <option value="Wednesday" @if ($jadwal->hari === 'Wednesday') {{ 'selected' }} @endif>Wednesday</option>
                                <option value="Thursday" @if ($jadwal->hari === 'Thursday') {{ 'selected' }} @endif>Thursday</option>
                                <option value="Friday" @if ($jadwal->hari === 'Friday') {{ 'selected' }} @endif>Friday</option>
                                <option value="Saturday" @if ($jadwal->hari === 'Saturday') {{ 'selected' }} @endif>Saturday</option>
                                <option value="Sunday" @if ($jadwal->hari === 'Sunday') {{ 'selected' }} @endif>Sunday</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>Start Time <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <div class="md-form">
                                <input type="time" id="inputMDEx1" class="form-control" name="jadwal_mulai" value="{{$jadwal->jadwal_mulai}}" required>
                            </div>
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>End Time <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <div class="md-form">
                                <input type="time" id="" class="form-control" name="jadwal_selesai" value="{{$jadwal->jadwal_selesai}}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>Number of Participant <span class="text-danger">*</span></h4>
                        </label>
    
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="batas_partisipan">
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
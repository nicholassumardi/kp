@extends('admin/layouts/app')
@section('path')
Schedules
@endsection
@section('content')
<div class="container-fluid mt--6">
    <form action="{{route('schedules.store')}}" method="post">
        @csrf
        <div class="card">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h3 class="mb-0">Add Schedules</h3>
                    <a href="{{route('schedules.index')}}" class="btn btn-outline-success btn-sm"><i
                            class="bi bi-arrow-left"></i> Back</a>
                </div>
                <div class="card-body p-5">

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>Course
                                Name <span class="text-danger">*</span></h4>
                        </label>

                        <div class="col-sm-7">
                            <select class="form-control" id="" name="kursus_id" required>
                                @foreach ($kursus as $kr)
                                <option value="{{$kr->id_kursus}}">{{$kr->nama_kursus}} @if (isset($kr->tipe_kursus))
                                    {{ '- ' . $kr->tipe_kursus }} @endif </option>
                                @endforeach
                            </select>
                        </div>

                    </div>


                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>Day <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="" name="hari" required>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>Start Time <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <div class="md-form">
                                <input type="time" id="" class="form-control" name="jadwal_mulai" required>
                            </div>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label col-form-label-sm text-lg-end text-sm-start">
                            <h4>End Time <span class="text-danger">*</span></h4>
                        </label>
                        <div class="col-sm-7">
                            <div class="md-form">
                                <input type="time" id="" class="form-control" name="jadwal_selesai" required>
                            </div>
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
@push('js')
<script>
    $('#timepicker2').timepicker({
                minuteStep: 1,
                template: 'modal',
                appendWidgetTo: 'body',
                showSeconds: true,
                showMeridian: false,
                defaultTime: false
            });

</script>
@endpush
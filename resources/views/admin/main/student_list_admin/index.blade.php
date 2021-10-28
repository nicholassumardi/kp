@extends('admin/layouts/app')
@section('path')
Student List
@endsection
@section('content')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="d-flex justify-content-between card-header border-0">
                    <div>
                        <h2 class="mb-0">Student List</h2>
                    </div>
                    <div>
                        @php
                            $min_year = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $min_year)->year;
                            $max_year = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $max_year)->year;
                        @endphp

                        <select name="" id="sort-year">
                            @for ($i = $max_year; $i >= $min_year; $i--)
                                {
                                @if (strval($i) === strval($year_selected))
                                    <option value="{{ $i }}" selected>{{ $i }}</option>
                                @else
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Light table -->
                <div class="table-responsive">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">Name  </h3>
                            </div>
                            <div class="col">
                                <h3 class="mb-0">NPM </h3>
                            </div>
                        </div>
                        @foreach ($data_mahasiswa as $mahasiswa)    
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">{{ $mahasiswa->nama }} </h3>
                            </div>
                            <div class="col">
                                <h3 class="mb-0">{{ $mahasiswa->npm }}</h3>
                            </div>
                        </div>
                        @endforeach

                        {{-- <div class="row mt-5 justify-content-center">
                            <div class="col-xl-10">
                                <label for="form-control">Courses</label>

                                <select class="form-control" id="courses-dropdown" name="kursus_id">
                                    @foreach ($nama_kursus as $nk)
                                    <option value="{{$nk->id_kursus}}">{{$nk->nama_kursus}} @if(isset
                                        ($nk->tipe_kursus)) {{ '- ' . $nk->tipe_kursus }} @endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(function() {
        // Ubah dropdown year
        $("#sort-year").on("change", function() {
            const year = $(this).val();
            
            location.href = `/studentList/${ year }`;
        });
    });
</script>
@endpush
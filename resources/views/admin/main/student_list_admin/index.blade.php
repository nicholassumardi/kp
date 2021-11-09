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

                    {{-- Jika sudah ada mahasiswa yang mendaftar kursus --}}
                    @if ($detail_kursus_count > 0)                        
                    <div>
                        @php
                            $min_year = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $min_year)->year;
                            $max_year = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $max_year)->year;
                            $dropdownSudahTerpilih = [];
                        @endphp

                        <select class="form-control" name="" id="sort-year">
                            @for ($i = $max_year; $i >= $min_year; $i--)
                                @foreach ($data_kursus as $kursus)
                                    @foreach ($data_detail_kursus as $detail_kursus)
                                        @if (strval($i) === strval(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detail_kursus->created_at)->year) && strval($detail_kursus->kursus_id) === strval($kursus->id_kursus))
                                            @if ( ! in_array(strval($i . $detail_kursus->kursus_id), $dropdownSudahTerpilih))
                                                @php array_push($dropdownSudahTerpilih, strval($i . $detail_kursus->kursus_id)); @endphp
                                                @if (strval($i) === strval($year_selected) && strval($id_kursus_selected) === strval($kursus->id_kursus))
                                                    <option value="{{ $i }} {{ $kursus->id_kursus }}" selected>{{ $i }} - {{ $kursus->nama_kursus }}</option>
                                                @else
                                                    <option value="{{ $i }} {{ $kursus->id_kursus }}">{{ $i }} - {{ $kursus->nama_kursus }}</option>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach                                    
                                @endforeach
                            @endfor
                        </select>
                    </div>
                    @endif
                </div>

                {{-- Jika sudah ada mahasiswa yang mendaftar kursus --}}
                @if ($detail_kursus_count > 0)
                <!-- Light table -->
                <div class="table-responsive">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">Card Number  </h3>
                            </div>
                            <div class="col">
                                <h3 class="mb-0">Name  </h3>
                            </div>
                            <div class="col">
                                <h3 class="mb-0">NPM </h3>
                            </div>
                        </div>
                        
                        @foreach ($data_mahasiswa_terurut as $mahasiswa_terurut)   
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">{{ $mahasiswa_terurut['no_kartu_mahasiswa'] }} </h3>
                            </div>
                            <div class="col">
                                <h3 class="mb-0">{{ $mahasiswa_terurut['nama_mahasiswa'] }} </h3>
                            </div>
                            <div class="col">
                                <h3 class="mb-0">{{ $mahasiswa_terurut['npm_mahasiswa'] }}</h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Jika belum ada mahasiswa yang mendaftar kursus --}}
                @if ($detail_kursus_count === 0)
                    <div class="card-body">
                        <h3 class="text-center">Belum ada mahasiswa yang mendaftar kursus</h3>
                    </div>
                @endif
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
            const params = $(this).val();
            const year =  params.substring(0,4);
            const id_kursus = params.substring(5,6);
        
            location.href = `/studentList/${year}/${id_kursus}`;
        });
    });
</script>
@endpush
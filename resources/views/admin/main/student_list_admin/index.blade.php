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
                <div class="d-flex card-header border-0">
                    <div class="col-5">
                        <h2 class="mb-0">Student List</h2>
                    </div>

                    <div class="col-2">
                        <select class="form-control" id="tipeUser-dropdown">
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Umum">Umum</option>
                        </select>
                    </div>

                    <div class="col-2">

                    </div>
                    
                    <div class="parentMahasiswa col-3">
                        {{-- Jika sudah ada mahasiswa yang mendaftar kursus --}}
                        @if ($detail_kursus_count > 0)
                        <div>
                            @php
                            $min_year = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $min_year)->year;
                            $max_year = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $max_year)->year;
                            $dropdownSudahTerpilih = [];
                            @endphp

                            <select class="form-control" name="" id="sort-year-mahasiswa">
                                @for ($i = $max_year; $i >= $min_year; $i--)
                                @foreach ($data_kursus as $kursus)
                                @foreach ($data_detail_kursus as $detail_kursus)
                                @if (strval($i) === strval(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $detail_kursus->created_at)->year) && strval($detail_kursus->kursus_id) ===
                                strval($kursus->id_kursus))
                                @if ( ! in_array(strval($i . $detail_kursus->kursus_id), $dropdownSudahTerpilih))
                                @php array_push($dropdownSudahTerpilih, strval($i . $detail_kursus->kursus_id)); @endphp
                                @if (strval($i) === strval($year_selected) && strval($id_kursus_selected) ===
                                strval($kursus->id_kursus))
                                <option value="{{ $i }} {{ $kursus->id_kursus }}" selected>{{ $i }} - {{
                                    $kursus->nama_kursus }}</option>
                                @else
                                <option value="{{ $i }} {{ $kursus->id_kursus }}">{{ $i }} - {{ $kursus->nama_kursus }}
                                </option>
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

                    <div class="parentUmum d-none col-3">
                        {{-- Jika sudah ada umum yang mendaftar kursus --}}
                        @if ($detail_kursus_umum_count > 0)
                        <div>
                            @php
                            $min_year_umum = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $min_year_umum)->year;
                            $max_year_umum = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $max_year_umum)->year;
                            $dropdownSudahTerpilih = [];
                            @endphp

                            <select class="form-control" name="" id="sort-year-umum">
                                @for ($i = $max_year_umum; $i >= $min_year_umum; $i--)
                                @foreach ($data_kursus_umum as $kursus)
                                @foreach ($data_detail_kursus_umum as $detail_kursus_umum)
                                @if (strval($i) === strval(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $detail_kursus_umum->created_at)->year) && strval($detail_kursus_umum->kursus_id) ===
                                strval($kursus->id_kursus))
                                @if ( ! in_array(strval($i . $detail_kursus_umum->kursus_id), $dropdownSudahTerpilih))
                                @php array_push($dropdownSudahTerpilih, strval($i . $detail_kursus_umum->kursus_id)); @endphp
                                @if (strval($i) === strval($year_selected_umum) && strval($id_kursus_selected_umum) ===
                                strval($kursus->id_kursus))
                                <option value="{{ $i }} {{ $kursus->id_kursus }}" selected>{{ $i }} - {{
                                    $kursus->nama_kursus }}</option>
                                @else
                                <option value="{{ $i }} {{ $kursus->id_kursus }}">{{ $i }} - {{ $kursus->nama_kursus }}
                                </option>
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

                </div>

                <div class="parentMahasiswa">
                    {{-- Jika sudah ada mahasiswa yang mendaftar kursus --}}
                    @if ($detail_kursus_count > 0)
                    <!-- Light table -->
                    <div class="table-responsive">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col">
                                    <h3 class="mb-0">Card Number </h3>
                                </div>
                                <div class="col">
                                    <h3 class="mb-0">Name </h3>
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
                
                <div class="parentUmum d-none">
                    {{-- Jika sudah ada umum yang mendaftar kursus --}}
                    @if ($detail_kursus_umum_count > 0)
                    <!-- Light table -->
                    <div class="table-responsive">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col">
                                    <h3 class="mb-0">Card Number </h3>
                                </div>
                                <div class="col">
                                    <h3 class="mb-0">Name </h3>
                                </div>
                            </div>

                            @foreach ($data_umum_terurut as $umum_terurut)
                            <div class="row">
                                <div class="col">
                                    <h3 class="mb-0">{{ $umum_terurut['no_kartu_umum'] }} </h3>
                                </div>
                                <div class="col">
                                    <h3 class="mb-0">{{ $umum_terurut['nama_umum'] }} </h3>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Jika belum ada mahasiswa yang mendaftar kursus --}}
                    @if ($detail_kursus_umum_count === 0)
                    <div class="card-body">
                        <h3 class="text-center">Belum ada yang mendaftar kursus</h3>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(function() {
        // Ubah dropdown year mahasiswa
        $("#sort-year-mahasiswa").on("change", function() {
            const params = $(this).val();
            const year =  params.substring(0,4);
            const id_kursus = params.substring(5,6);
        
            location.href = `/studentList/${year}/${id_kursus}`;
        });

        // Ubah dropdown year umum
        $("#sort-year-umum").on("change", function() {
            const params = $(this).val();
            const year =  params.substring(0,4);
            const id_kursus = params.substring(5,6);
        
            location.href = `/studentList/${year}/${id_kursus}`;
        });

        // Tipe user dropdown
        $("#tipeUser-dropdown").on("change", async function() {
            const tipeUserDropdown = $(this);
            const parentMahasiswa = $(".parentMahasiswa");
            const parentUmum = $(".parentUmum");


            if (tipeUserDropdown.val() === "Mahasiswa") {
                parentMahasiswa.removeClass("d-none");
                parentUmum.addClass("d-none");
            } else if (tipeUserDropdown.val() === "Umum") {
                parentUmum.removeClass("d-none");
                parentMahasiswa.addClass("d-none");
            }
        }); 
    });
</script>
@endpush
@extends('student/layouts/app')
@section('path')
Penerjemahan
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">Penerjemahan</h3>
            <a href="{{route('penerjemahan-student.create')}}" class="btn btn-primary btn-sm">Kirim Penerjemahan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered invisible" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Jenis File</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">File Anda</th>
                            <th class="text-center">File Admin</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_abstract as $abstract)
                        <tr>
                            <td class="text-center">Abstrak</td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm {{ $abstract->status === 'unverified' ?'btn-danger' : ($abstract->status === 'pending' ? 'btn-warning' : 'btn-success') }} disabled">
                                    {{ $abstract->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($abstract->path_file_abstrak_mahasiswa) }}
                            </td>
                            <td class="text-center">{{ basename($abstract->path_file_abstrak_admin_word) }}</td>
                            <td class="d-flex justify-content-center">
                                @if ($abstract->path_file_abstrak_admin_word !== null)
                                <a href="{{ asset('storage/' . $abstract->path_file_abstrak_admin_word) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-download text-gray"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        @foreach ($data_transkrip_nilai as $transkrip_nilai)
                        <tr>
                            <td class="text-center">Transkrip Nilai</td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm {{ $transkrip_nilai->status === 'unchecked' ?'btn-danger' : 'btn-success' }} disabled">
                                    {{ $transkrip_nilai->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($transkrip_nilai->path_file_transkrip_nilai) }}
                            </td>
                            <td class="text-center"></td>
                            <td class="d-flex justify-content-center">
                            </td>
                        </tr>
                        @endforeach

                        @foreach ($data_ijazah as $ijazah)
                        <tr>
                            <td class="text-center">Ijazah</td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm {{ $ijazah->status === 'unchecked' ?'btn-danger' : 'btn-success' }} disabled">
                                    {{ $ijazah->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($ijazah->path_file_ijazah) }}
                            </td>
                            <td class="text-center"></td>
                            <td class="d-flex justify-content-center">
                            </td>
                        </tr>
                        @endforeach

                        @foreach ($data_jurnal as $jurnal)
                        <tr>
                            <td class="text-center">
                                Jurnal
                                <br>
                                <b>Jumlah Halaman: {{ $jurnal->jumlah_halaman_jurnal }}</b>
                            </td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm {{ $jurnal->status === 'unverified' ?'btn-danger' : ($jurnal->status === 'pending' ? 'btn-warning' : 'btn-success') }} disabled">
                                    {{ $jurnal->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($jurnal->path_file_jurnal_mahasiswa) }}
                            </td>
                            <td class="text-center">{{ basename($jurnal->path_file_jurnal_admin_word) }}</td>
                            <td class="d-flex justify-content-center">
                                @if ($jurnal->path_file_jurnal_admin_word !== null)
                                <a href="{{ asset('storage/' . $jurnal->path_file_jurnal_admin_word) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-download text-gray"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
@push('js')
<script>
    $(function () {
        // Tampilkan tabel setelah #dataTable telah terload sepenuhnya.
        $("#dataTable").removeClass("invisible");
    });
</script>
@endpush
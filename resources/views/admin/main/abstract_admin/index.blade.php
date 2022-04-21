@extends('admin/layouts/app')
@section('path')
Penerjemahan
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4 d-flex justify-content-evenly">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="col-9">
                <h3 class="mb-0">Penerjemahan</h3>
            </div>
            <div class="col">
                <select class="form-select" id="tipeUser-dropdown">
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Umum">Umum</option>
                </select>
            </div>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered invisible" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>File Type</th>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Student Phone Number</th>
                            <th>Proof of Payment</th>
                            <th>Status</th>
                            <th>File</th>
                            <th>Edit Status</th>
                            <th>Action</th>
                            <th>Print</th>
                            <th>Deactive</th>
                        </tr>
                    </thead>
                    <tbody id="div-mahasiswaParent">
                        @foreach ($data_abstract as $key => $abstract)
                        <tr>
                            <td class="text-center">{{ $abstract->created_at }}</td>
                            <td class="text-center">Abstract</td>
                            <td class="text-center">{{ $abstract->mahasiswa->nama }}</td>
                            <td class="text-center">{{ $abstract->email }}</td>
                            <td class="text-center">{{ $abstract->no_hp }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $abstract->path_foto_kuitansi) }}"
                                    class="custombuktipembayaran">
                            </td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm js-status {{ $abstract->status === 'unverified' ?'btn-danger' : ($abstract->status === 'pending' ? 'btn-warning' : ($abstract->status === 'rejected' ?'btn-danger': 'btn-success')) }} disabled">
                                    {{ $abstract->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($abstract->path_file_abstrak_mahasiswa) }}
                            </td>
                            <td class="text-center align-middle">

                                <button type="button" class="btn btn-sm btn-outline-secondary js-btn-abstrak-pending"
                                    data-id="{{ $abstract->id_abstrak }}">
                                    <i class="bi bi-hourglass-split text-yellow"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary js-btn-abstrak-verified"
                                    data-id="{{ $abstract->id_abstrak }}">
                                    <i class=" bi bi-check-square text-green"></i>
                                </button>
                                {{-- <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH') --}}
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{route('penerjemahan.sendKomentarAbstrak', $abstract->id_abstrak)}}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                    {{--
                                </form> --}}

                            </td>
                            <td class="align-middle text-center">
                                <a href="{{route('penerjemahan.downloadAbstrakMahasiswa', ['id_mahasiswa' => $abstract->mahasiswa_id, 'id_abstrak' => $abstract->id_abstrak])}}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-download text-gray"></i></a>

                                <a href="{{route('penerjemahan-admin.editPageAbstrak', ['id_penerjemahan' => $abstract->id_abstrak, 'id_mahasiswa' => $abstract->mahasiswa_id])}}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-pen-fill text-green"></i></a>
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('generate2.pdf', ['id_abstract_satu' => $abstract->id_abstrak, 'id_mahasiswa_satu' => $abstract->mahasiswa_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>

                            </td>
                            <td class="align-middle text-center">
                                <form action="{{route('penerjemahan.deactiveAbstrak',$abstract->id_abstrak)}}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-secondary  js-button-submit" type="button"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form>
                            </td>
                        </tr>

                        @endforeach

                        @foreach ($data_transkrip_nilai as $key => $transkrip_nilai)
                        <tr>
                            <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $transkrip_nilai->created_at)->year}}</td>
                            <td class="text-center">Transkrip Nilai</td>
                            <td class="text-center">{{ $transkrip_nilai->mahasiswa->nama }}</td>
                            <td class="text-center">{{ $transkrip_nilai->email }}</td>
                            <td class="text-center">{{ $transkrip_nilai->no_hp }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $transkrip_nilai->path_foto_kuitansi) }}"
                                    class="custombuktipembayaran">
                            </td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm js-status {{ $transkrip_nilai->status === 'unchecked' ? 'btn-danger' : ($transkrip_nilai->status === 'rejected' ? 'btn-danger': 'btn-success' ) }} disabled">
                                    {{ $transkrip_nilai->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($transkrip_nilai->path_file_transkrip_nilai) }}
                            </td>
                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-sm btn-outline-secondary js-btn-transkrip-checked"
                                    data-id="{{ $transkrip_nilai->id_transkrip_nilai}}">
                                    <i class=" bi bi-check-square text-green"></i>
                                </button>
                                {{-- <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH') --}}
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{ route('penerjemahan.sendKomentarTranskripNilai', $transkrip_nilai->id_transkrip_nilai)}}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                    {{--
                                </form> --}}


                            </td>
                            <td class="align-middle text-center">
                                <a href="{{route('penerjemahan.downloadTranskripMahasiswa', ['id_mahasiswa' => $transkrip_nilai->mahasiswa_id, 'id_transkrip_nilai' => $transkrip_nilai->id_transkrip_nilai])}}"
                                    class="btn btn-sm btn-outline-secondary js-btn-download-transkrip-nilai"
                                    data-id="{{ $transkrip_nilai->id_transkrip_nilai}}"><i
                                        class="bi bi-download text-gray"></i></a>


                                {{-- <form
                                    action="{{route('penerjemahan.deleteTranskripMahasiswa', ['id_mahasiswa'=> $transkrip_nilai->mahasiswa_id, 'id_transkrip_nilai' => $transkrip_nilai->id_transkrip_nilai])}}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="js-btn-delete btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form> --}}
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('generate3.pdf', ['id_transkrip_nilai_satu' => $transkrip_nilai->id_transkrip_nilai, 'id_mahasiswa_satu' => $transkrip_nilai->mahasiswa_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>

                            </td>
                            <td class="align-middle text-center">
                                <form
                                    action="{{route('penerjemahan.deactiveTranskripNilai',$transkrip_nilai->id_transkrip_nilai)}}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-secondary  js-button-submit" type="button"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form>
                            </td>
                        </tr>


                        @endforeach

                        @foreach ($data_ijazah as $key=> $ijazah)
                        <tr>
                            <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $ijazah->created_at)->year}}</td>
                            <td class="text-center">Ijazah</td>
                            <td class="text-center">{{ $ijazah->mahasiswa->nama }}</td>
                            <td class="text-center">{{ $ijazah->email }}</td>
                            <td class="text-center">{{ $ijazah->no_hp }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $ijazah->path_foto_kuitansi) }}"
                                    class="custombuktipembayaran">
                            </td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm js-status {{ $ijazah->status === 'unchecked' ?'btn-danger' : ($ijazah->status === 'rejected' ? 'btn-danger':'btn-success') }} disabled">
                                    {{ $ijazah->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($ijazah->path_file_ijazah) }}
                            </td>
                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-sm btn-outline-secondary js-btn-ijazah-checked"
                                    data-id="{{ $ijazah->id_ijazah}}">
                                    <i class=" bi bi-check-square text-green"></i>
                                </button>
                                {{-- <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH') --}}
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{ route('penerjemahan.sendKomentarIjazah', $ijazah->id_ijazah)}}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                    {{--
                                </form> --}}

                            </td>
                            <td class="align-middle text-center">
                                <a href="{{route('penerjemahan.downloadIjazahMahasiswa', ['id_mahasiswa' => $ijazah->mahasiswa_id, 'id_ijazah' => $ijazah->id_ijazah])}}"
                                    class="btn btn-sm btn-outline-secondary js-btn-download-ijazah"
                                    data-id="{{ $ijazah->id_ijazah}}"><i class="bi bi-download text-gray"></i></a>

                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('generate4.pdf', ['id_ijazah_satu' => $ijazah->id_ijazah, 'id_mahasiswa_satu' => $ijazah->mahasiswa_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>

                            </td>
                            <td class="align-middle text-center">
                                <form action="{{route('penerjemahan.deactiveIjazah',$ijazah->id_ijazah)}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-secondary  js-button-submit" type="button"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach



                        @foreach ($data_jurnal as $key=> $jurnal)
                        <tr>
                            <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $jurnal->created_at)->year}}</td>
                            <td class="text-center">
                                Jurnal
                                <br>
                                <b>Jumlah Halaman: {{ $jurnal->jumlah_halaman_jurnal }}</b>
                            </td>
                            <td class="text-center">{{ $jurnal->mahasiswa->nama }}</td>
                            <td class="text-center">{{ $jurnal->email }}</td>
                            <td class="text-center">{{ $jurnal->no_hp }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $jurnal->path_foto_kuitansi) }}"
                                    class="custombuktipembayaran">
                            </td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm js-status {{ $jurnal->status === 'unverified' ?'btn-danger' : ($jurnal->status === 'pending' ? 'btn-warning' : ($jurnal->status === 'rejected' ? 'btn-danger' : 'btn-success')) }} disabled">
                                    {{ $jurnal->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($jurnal->path_file_jurnal_mahasiswa) }}
                            </td>
                            <td class="text-center align-middle">

                                <button type="button" class="btn btn-sm btn-outline-secondary js-btn-jurnal-pending"
                                    data-id="{{ $jurnal->id_jurnal}}">
                                    <i class="bi bi-hourglass-split text-yellow"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary js-btn-jurnal-verified"
                                    data-id="{{ $jurnal->id_jurnal}}">
                                    <i class=" bi bi-check-square text-green"></i>
                                </button>
                                {{-- <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH') --}}
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{ route('penerjemahan.sendKomentarJurnal', $jurnal->id_jurnal)}}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                    {{--
                                </form> --}}

                            </td>
                            <td class="align-middle text-center">
                                <a href="{{route('penerjemahan.downloadJurnalMahasiswa', ['id_mahasiswa' => $jurnal->mahasiswa_id, 'id_jurnal' => $jurnal->id_jurnal])}}"
                                    class="btn btn-sm btn-outline-secondary js-btn-download-jurnal"
                                    data-id="{{ $jurnal->id_jurnal}}"><i class="bi bi-download text-gray"></i></a>

                                <a href="{{route('penerjemahan-admin.editPageJurnal', ['id_jurnal' => $jurnal->id_jurnal, 'id_mahasiswa' => $jurnal->mahasiswa_id])}}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-pen-fill text-green"></i></a>

                                {{-- <form
                                    action="{{route('penerjemahan.deleteJurnalMahasiswa', ['id_mahasiswa'=> $jurnal->mahasiswa_id, 'id_jurnal' => $jurnal->id_jurnal])}}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="js-btn-delete btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form> --}}
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('generate5.pdf', ['id_jurnal_satu' => $jurnal->id_jurnal, 'id_mahasiswa_satu' => $jurnal->mahasiswa_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>

                            </td>
                            <td class="align-middle text-center">
                                <form action="{{route('penerjemahan.deactiveJurnal',$jurnal->id_jurnal)}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-secondary  js-button-submit" type="button"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                    <tbody id="div-umumParent" class="d-none">
                        @foreach ($data_abstract_umum as $key => $abstract_umum)
                        <tr>
                            <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $abstract_umum->created_at)->year}}</td>
                            <td class="text-center">Abstract</td>
                            <td class="text-center">{{ $abstract_umum->umum->nama }}</td>
                            <td class="text-center">{{ $abstract_umum->email }}</td>
                            <td class="text-center">{{ $abstract_umum->no_hp }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $abstract_umum->path_foto_kuitansi) }}"
                                    class="custombuktipembayaran">
                            </td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm js-status {{ $abstract_umum->status === 'unverified' ?'btn-danger' : ($abstract_umum->status === 'pending' ? 'btn-warning' : ($abstract_umum->status === 'rejected' ?'btn-danger': 'btn-success')) }} disabled">
                                    {{ $abstract_umum->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($abstract_umum->path_file_abstrak_umum) }}
                            </td>
                            <td class="text-center align-middle">

                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary js-btn-abstrak-umum-pending"
                                    data-id="{{ $abstract_umum->id_abstrak_umum}}">
                                    <i class="bi bi-hourglass-split text-yellow"></i>
                                </button>
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary js-btn-abstrak-umum-verified"
                                    data-id="{{ $abstract_umum->id_abstrak_umum}}">
                                    <i class=" bi bi-check-square text-green"></i>
                                </button>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{ route('penerjemahan.sendKomentarAbstrakUmum',$abstract_umum->id_abstrak_umum)}}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="align-middle text-center">

                                <a href="{{route('penerjemahan.downloadAbstrakUmum', ['id_umum' => $abstract_umum->umum_id, 'id_abstrak_umum' => $abstract_umum->id_abstrak_umum])}}"
                                    class="btn btn-sm btn-outline-secondary js-btn-download-abstrak-umum"
                                    data-id="{{ $abstract_umum->id_abstrak_umum}}"><i
                                        class="bi bi-download text-gray"></i></a>



                                <a href="{{route('penerjemahan-admin.editPageAbstrakUmum', ['id_penerjemahan_umum' => $abstract_umum->id_abstrak_umum, 'id_umum' => $abstract_umum->umum_id])}}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-pen-fill text-green"></i></a>

                                {{-- <form
                                    action="{{route('penerjemahan.deleteAbstrakUmum', ['id_umum'=> $abstract_umum->umum_id, 'id_abstrak_umum' => $abstract_umum->id_abstrak_umum])}}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="js-btn-delete btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form> --}}
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('generateUmum2.pdf', ['id_abstract_umum' => $abstract_umum->id_abstrak_umum, 'id_umum_satu' => $abstract_umum->umum_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>

                            </td>
                            <td class="align-middle text-center">
                                <form
                                    action="{{route('penerjemahan.deactiveAbstrakUmum',$abstract_umum->id_abstrak_umum)}}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-secondary  js-button-submit" type="button"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form>
                            </td>
                        </tr>

                        @endforeach

                        @foreach ($data_transkrip_nilai_umum as $key => $transkrip_nilai_umum)
                        <tr>
                            <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $transkrip_nilai_umum->created_at)->year}}</td>
                            <td class="text-center">Transkrip Nilai</td>
                            <td class="text-center">{{ $transkrip_nilai_umum->umum->nama }}</td>
                            <td class="text-center">{{ $transkrip_nilai_umum->email }}</td>
                            <td class="text-center">{{ $transkrip_nilai_umum->no_hp }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $transkrip_nilai_umum->path_foto_kuitansi) }}"
                                    class="custombuktipembayaran">
                            </td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm js-status {{ $transkrip_nilai_umum->status === 'unchecked' ? 'btn-danger' : ($transkrip_nilai_umum->status === 'rejected' ? 'btn-danger' : 'btn-success' ) }} disabled">
                                    {{ $transkrip_nilai_umum->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($transkrip_nilai_umum->path_file_transkrip_nilai) }}
                            </td>
                            <td class="text-center align-middle">
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary js-btn-transkrip-umum-checked"
                                    data-id="{{ $transkrip_nilai_umum->id_transkrip_nilai_umum}}">
                                    <i class=" bi bi-check-square text-green"></i>
                                </button>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{ route('penerjemahan.sendKomentarTranskripNilaiUmum', $transkrip_nilai_umum->id_transkrip_nilai_umum)}}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{route('penerjemahan.downloadTranskripUmum', ['id_umum' => $transkrip_nilai_umum->umum_id, 'id_transkrip_nilai_umum' => $transkrip_nilai_umum->id_transkrip_nilai_umum])}}"
                                    class="btn btn-sm btn-outline-secondary js-btn-download-transkrip-nilai-umum"
                                    data-id="{{ $transkrip_nilai_umum->id_transkrip_nilai_umum}}"><i
                                        class="bi bi-download text-gray"></i></a>


                                {{-- <form
                                    action="{{route('penerjemahan.deleteTranskripUmum', ['id_umum'=> $transkrip_nilai_umum->umum_id, 'id_transkrip_nilai_umum' => $transkrip_nilai_umum->id_transkrip_nilai_umum])}}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="js-btn-delete btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form> --}}
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('generateUmum3.pdf', ['id_transkrip_nilai_umum' => $transkrip_nilai_umum->id_transkrip_nilai_umum, 'id_umum_satu' => $transkrip_nilai_umum->umum_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>

                            </td>
                            <td class="align-middle text-center">
                                <form
                                    action="{{route('penerjemahan.deactiveTranskripNilaiUmum',$transkrip_nilai_umum->id_transkrip_nilai_umum)}}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-secondary  js-button-submit" type="button"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form>
                            </td>
                        </tr>


                        @endforeach

                        @foreach ($data_ijazah_umum as $key=> $ijazah_umum)
                        <tr>
                            <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $ijazah_umum->created_at)->year}}</td>
                            <td class="text-center">Ijazah</td>
                            <td class="text-center">{{ $ijazah_umum->umum->nama }}</td>
                            <td class="text-center">{{ $ijazah_umum->email }}</td>
                            <td class="text-center">{{ $ijazah_umum->no_hp }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $ijazah_umum->path_foto_kuitansi) }}"
                                    class="custombuktipembayaran">
                            </td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm js-status {{ $ijazah_umum->status === 'unchecked' ? 'btn-danger' : ($ijazah_umum->status === 'rejected' ? 'btn-danger' : 'btn-success' ) }} disabled">
                                    {{ $ijazah_umum->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($ijazah_umum->path_file_ijazah) }}
                            </td>
                            <td class="text-center align-middle">
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary js-btn-ijazah-umum-checked"
                                    data-id="{{ $ijazah_umum->id_ijazah_umum}}">
                                    <i class=" bi bi-check-square text-green"></i>
                                </button>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{ route('penerjemahan.sendKomentarIjazahUmum', $ijazah_umum->id_ijazah_umum)}}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{route('penerjemahan.downloadIjazahUmum', ['id_umum' => $ijazah_umum->umum_id, 'id_ijazah_umum' => $ijazah_umum->id_ijazah_umum])}}"
                                    class="btn btn-sm btn-outline-secondary js-btn-download-ijazah-umum"
                                    data-id="{{ $ijazah_umum->id_ijazah_umum}}"><i
                                        class="bi bi-download text-gray"></i></a>


                                {{-- <form
                                    action="{{route('penerjemahan.deleteIjazahUmum', ['id_umum'=> $ijazah_umum->umum_id, 'id_ijazah_umum' => $ijazah_umum->id_ijazah_umum])}}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="js-btn-delete btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form> --}}
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('generateUmum4.pdf', ['id_ijazah_umum' => $ijazah_umum->id_ijazah_umum, 'id_umum_satu' => $ijazah_umum->umum_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>

                            </td>
                            <td class="align-middle text-center">
                                <form action="{{route('penerjemahan.deactiveIjazahUmum',$ijazah_umum->id_ijazah_umum)}}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-secondary  js-button-submit" type="button"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach



                        @foreach ($data_jurnal_umum as $key=> $jurnal_umum)
                        <tr>
                            <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $jurnal_umum->created_at)->year}}</td>
                            <td class="text-center">
                                Jurnal
                                <br>
                                <b>Jumlah Halaman: {{ $jurnal_umum->jumlah_halaman_jurnal }}</b>
                            </td>
                            <td class="text-center">{{ $jurnal_umum->umum->nama }}</td>
                            <td class="text-center">{{ $jurnal_umum->email }}</td>
                            <td class="text-center">{{ $jurnal_umum->no_hp }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $jurnal_umum->path_foto_kuitansi) }}"
                                    class="custombuktipembayaran">
                            </td>
                            <td class="text-center">
                                <li
                                    class="btn btn-sm js-status {{ $jurnal_umum->status === 'unverified' ?'btn-danger' : ($jurnal_umum->status === 'pending' ? 'btn-warning' : ($jurnal_umum->status === 'rejected' ? 'btn-danger' : 'btn-success')) }} disabled">
                                    {{ $jurnal_umum->status }}
                                </li>
                            </td>
                            <td class="text-center">
                                {{ basename($jurnal_umum->path_file_jurnal_umum) }}
                            </td>
                            <td class="text-center align-middle">

                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary js-btn-jurnal-umum-pending"
                                    data-id="{{ $jurnal_umum->id_jurnal_umum}}">
                                    <i class="bi bi-hourglass-split text-yellow"></i>
                                </button>
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary js-btn-jurnal-umum-verified"
                                    data-id="{{ $jurnal_umum->id_jurnal_umum}}">
                                    <i class=" bi bi-check-square text-green"></i>
                                </button>
                                {{-- <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH') --}}
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                        data-toggle="modal" data-target="#modal-komentar"
                                        data-action="{{ route('penerjemahan.sendKomentarJurnalUmum', $jurnal_umum->id_jurnal_umum)}}">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </button>
                                    {{--
                                </form> --}}
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{route('penerjemahan.downloadJurnalUmum', ['id_umum' => $jurnal_umum->umum_id, 'id_jurnal_umum' => $jurnal_umum->id_jurnal_umum])}}"
                                    class="btn btn-sm btn-outline-secondary js-btn-download-jurnal-umum"
                                    data-id="{{ $jurnal_umum->id_jurnal_umum}}"><i
                                        class="bi bi-download text-gray"></i></a>

                                <a href="{{route('penerjemahan-admin.editPageJurnalUmum', ['id_jurnal_umum' => $jurnal_umum->id_jurnal_umum, 'id_umum' => $jurnal_umum->umum_id])}}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-pen-fill text-green"></i></a>

                                {{-- <form
                                    action="{{route('penerjemahan.deleteJurnalUmum', ['id_umum'=> $jurnal_umum->umum_id, 'id_jurnal_umum' => $jurnal_umum->id_jurnal_umum])}}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="js-btn-delete btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form> --}}
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('generateUmum5.pdf', ['id_jurnal_umum' => $jurnal_umum->id_jurnal_umum, 'id_umum_satu' => $jurnal_umum->umum_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a>

                            </td>
                            <td class="align-middle text-center">
                                <form action="{{route('penerjemahan.deactiveJurnalUmum',$jurnal_umum->id_jurnal_umum)}}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-secondary  js-button-submit" type="button"><i
                                            class="bi bi-trash2-fill text-red"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-komentar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-send" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group text-start">
                            <label for="message-text" class="col-form-label text-start"><b>Message:</b></label>
                            <textarea class="form-control width:500px;" id="message-text" name="komentar"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-send">Send</button>
                    </div>
                </form>
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

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        });

        // Button Deactive
        $("#dataTable").on("click", ".js-button-submit", function () {
            swalWithBootstrapButtons.fire({
                title: "Deactive File?",
                text: "Are you sure want to make change? File will not shown after deactive",
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent().submit();
                }
            });
        });
 

        // JS Umum
        // Button Pending abstrak umum
        $("#dataTable").on("click", ".js-btn-abstrak-umum-pending", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "abstrakUmum"
            };

            $.post(
                "api/abstrak-jurnal-change-status", 
                postData,
                function(jsonData) {
                    const abstrak = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-warning")
                        .text(abstrak.status);
                }
            ); 
        });
        
         // Button verified abstrak umum
         $("#dataTable").on("click", ".js-btn-abstrak-umum-verified", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "abstrakUmum"
            };

            $.post(
                "api/abstrak-jurnal-verified", 
                postData,
                function(jsonData) {
                    const abstrak = jsonData;
                    
                    jsStatus
                        .removeClass("btn-warning")
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(abstrak.status);
                }
            ); 
        });

         // Button pending jurnal umum
        $("#dataTable").on("click", ".js-btn-jurnal-umum-pending", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "jurnalUmum"
            };
            
            $.post(
                "api/abstrak-jurnal-change-status", 
                postData,
                function(jsonData) {
                    const jurnal = jsonData;
                
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-warning")
                        .text(jurnal.status);
                }
            ); 
        });
            // Button verified jurnal umum
            $("#dataTable").on("click", ".js-btn-jurnal-umum-verified", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "jurnalUmum"
            };

            $.post(
                "api/abstrak-jurnal-verified", 
                postData,
                function(jsonData) {
                    const jurnal = jsonData;
                    
                    jsStatus
                        .removeClass("btn-warning")
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(jurnal.status);
                }
            ); 
        });


        // Button checked transkrip nilai umum
        $("#dataTable").on("click", ".js-btn-transkrip-umum-checked", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "transkrip_nilai_umum"
            };

            $.post(
                "api/transkrip-ijazah-change-status", 
                postData,
                function(jsonData) {
                    const transkripNilai = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(transkripNilai.status);
                }
            ); 
        });

        // Button checked ijazah umum
        $("#dataTable").on("click", ".js-btn-ijazah-umum-checked", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "ijazah_umum"
            };

            $.post(
                "api/transkrip-ijazah-change-status", 
                postData,
                function(jsonData) {
                    const ijazah = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(ijazah.status);
                }
            ); 
        });



          // JS Mahasiswa
        // Button Pending abstrak
        $("#dataTable").on("click", ".js-btn-abstrak-pending", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "abstrak"
            };

            $.post(
                "api/abstrak-jurnal-change-status", 
                postData,
                function(jsonData) {
                    const abstrak = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-warning")
                        .text(abstrak.status);
                }
            ); 
        });
        // Button verified abstrak
        $("#dataTable").on("click", ".js-btn-abstrak-verified", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "abstrak"
            };
     
            $.post(
                "api/abstrak-jurnal-verified", 
                postData,
                function(jsonData) {
                    const abstrak = jsonData;
                    jsStatus
                        .removeClass("btn-warning")
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(abstrak.status);
                }
            ); 
        });
        // Button jurnal pending
        $("#dataTable").on("click", ".js-btn-jurnal-pending", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "jurnal"
            };
            
            $.post(
                "api/abstrak-jurnal-change-status", 
                postData,
                function(jsonData) {
                    const jurnal = jsonData;
                
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-warning")
                        .text(jurnal.status);
                }
            ); 
        });
          // Button jurnal verified
        $("#dataTable").on("click", ".js-btn-jurnal-verified", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "jurnal"
            };

            $.post(
                "api/abstrak-jurnal-verified", 
                postData,
                function(jsonData) {
                    const jurnal = jsonData;
                    
                    jsStatus
                        .removeClass("btn-warning")
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(jurnal.status);
                }
            ); 
        });

        // Button transkrip nilai check
        $("#dataTable").on("click", ".js-btn-transkrip-checked", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "transkrip_nilai"
            };

            $.post(
                "api/transkrip-ijazah-change-status", 
                postData,
                function(jsonData) {
                    const transkripNilai = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(transkripNilai.status);
                }
            ); 
        });

        // Button ijazah checked
        $("#dataTable").on("click", ".js-btn-ijazah-checked", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { 
                id: $(this).data("id"),
                layanan: "ijazah"
            };

            $.post(
                "api/transkrip-ijazah-change-status", 
                postData,
                function(jsonData) {
                    const ijazah = jsonData;
                    
                    jsStatus
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .text(ijazah.status);
                }
            ); 
        });

        $("#dataTable").removeClass("invisible");
        

        // Tampilkan tabel setelah #dataTable telah terload sepenuhnya.


        $("#tipeUser-dropdown").on("change", async function() {
            const tipeUserDropdown = $(this);
            const divMahasiswa = $("#div-mahasiswaParent");
            const divUmum = $("#div-umumParent");


            if (tipeUserDropdown.val() === "Mahasiswa") {
                divMahasiswa.removeClass("d-none");
                divUmum.addClass("d-none");
            } else if (tipeUserDropdown.val() === "Umum") {
                divUmum.removeClass("d-none");
                divMahasiswa.addClass("d-none");
            }
        });

        // Button kirim komentar
        $("#dataTable").on("click", ".btn-komentar", function () {
            $("#form-send").attr("action", $(this).data("action")); 
        });

        $("#modal-komentar").on("hidden.bs.modal", function () {
            $("#form-send").attr("action", ""); 
            $("#message-text").val(""); 
        });
    });
</script>
@endpush
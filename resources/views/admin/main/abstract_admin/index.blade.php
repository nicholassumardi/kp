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

                            <th>File Type</th>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Student Phone Number</th>
                            <th>Proof of Payment</th>
                            <th>Status</th>
                            <th>File</th>
                            <th>Action</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody id="div-mahasiswaParent">
                            @foreach ($data_abstract as $key => $abstract)
                            <tr>
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
                                        class="btn btn-sm js-status {{ $abstract->status === 'unverified' ?'btn-danger' : ($abstract->status === 'pending' ? 'btn-warning' : 'btn-success') }} disabled">
                                        {{ $abstract->status }}
                                    </li>
                                </td>
                                <td class="text-center">
                                    {{ basename($abstract->path_file_abstrak_mahasiswa) }}
                                </td>
                                <td class="">
                                    {{-- <form
                                        action="{{route('abstract-admin.changeStatus', ['id_abstrak' => $abstract->id_abstrak, 'id_mahasiswa' => $abstract->mahasiswa_id])}}"
                                        method="POST">
                                        @method('PATCH')
                                        @csrf --}}

                                        <a href="{{ asset('storage/' . $abstract->path_file_abstrak_mahasiswa) }}"
                                            class="btn btn-sm btn-outline-secondary js-btn-download-abstrak"
                                            data-id="{{ $abstract->id_abstrak }}"><i
                                                class="bi bi-download text-gray"></i></a>



                                        <a href="{{route('penerjemahan-admin.editPageAbstrak', ['id_penerjemahan' => $abstract->id_abstrak, 'id_mahasiswa' => $abstract->mahasiswa_id])}}"
                                            class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-pen-fill text-green"></i></a>

                                        <form action="" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary"><i
                                                    class="bi bi-trash2-fill text-red"></i></button>
                                        </form>
                                </td>

                                {{-- Jika data berada pada index genap dan data selanjutnya masih ada. --}}
                                @if (($key % 2 === 0) && ($key + 1 !== $abstrak_count))
                                <td class="align-middle" rowspan="2">
                                    <a href="{{ route('generate2.pdf', ['id_abstract' => $abstract->id_abstrak, 'id_mahasiswa_satu' => $abstract->mahasiswa_id, 'id_mahasiswa_dua' => $abstract->get($key + 1)->mahasiswa_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>


                                </td>
                                {{-- Jika data berada pada index genap dan data selanjutnya kosong. --}}
                                @elseif (($key % 2 === 0) && ($key + 1 === $abstrak_count))
                                <td class="align-middle">
                                    <a href="{{ route('generate2.pdf', ['id_abstract' => $abstract->id_abstrak, 'id_mahasiswa_satu' => $abstract->mahasiswa_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>

                                </td>
                                {{-- Jika data berada pada index ganjil. --}}
                                @else
                                <td class="d-none"></td>
                                @endif
                            </tr>

                            @endforeach

                            @foreach ($data_transkrip_nilai as $key => $transkrip_nilai)
                            <tr>
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
                                        class="btn btn-sm js-status {{ $transkrip_nilai->status === 'unchecked' ?'btn-danger' : 'btn-success' }} disabled">
                                        {{ $transkrip_nilai->status }}
                                    </li>
                                </td>
                                <td class="text-center">
                                    {{ basename($transkrip_nilai->path_file_transkrip_nilai) }}
                                </td>
                                <td class="">
                                    {{-- <a href="{{ asset('storage/' . $transkrip_nilai->path_file_transkrip_nilai) }}"
                                        class="btn btn-sm btn-outline-secondary js-btn-download-transkrip-nilai"
                                        data-id="{{ $transkrip_nilai->id_transkrip_nilai}}"><i
                                            class="bi bi-download text-gray"></i></a> --}}


                                    <form action="" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-trash2-fill text-red"></i></button>
                                    </form>
                                </td>

                                {{-- Jika data berada pada index genap dan data selanjutnya masih ada. --}}
                                @if (($key % 2 === 0) && ($key + 1 !== $transkrip_nilai_count))
                                <td class="align-middle" rowspan="2">
                                    <a href="{{ route('generate3.pdf', ['id_transkrip_nilai' => $transkrip_nilai->id_transkrip_nilai, 'id_mahasiswa_satu' => $transkrip_nilai->mahasiswa_id, 'id_mahasiswa_dua' =>  $transkrip_nilai->get($key + 1)->mahasiswa_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>


                                </td>
                                {{-- Jika data berada pada index genap dan data selanjutnya kosong. --}}
                                @elseif (($key % 2 === 0) && ($key + 1 === $transkrip_nilai_count))
                                <td class="align-middle">
                                    <a href="{{ route('generate3.pdf', ['id_transkrip_nilai' => $transkrip_nilai->id_transkrip_nilai, 'id_mahasiswa_satu' => $transkrip_nilai->mahasiswa_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>

                                </td>
                                {{-- Jika data berada pada index ganjil. --}}
                                @else
                                <td class="d-none"></td>
                                @endif
                            </tr>


                            @endforeach

                            @foreach ($data_ijazah as $key=> $ijazah)
                            <tr>
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
                                        class="btn btn-sm js-status {{ $ijazah->status === 'unchecked' ?'btn-danger' : 'btn-success' }} disabled">
                                        {{ $ijazah->status }}
                                    </li>
                                </td>
                                <td class="text-center">
                                    {{ basename($ijazah->path_file_ijazah) }}
                                </td>
                                <td class="">
                                    <a href="{{ asset('storage/' . $ijazah->path_file_ijazah) }}"
                                        class="btn btn-sm btn-outline-secondary js-btn-download-ijazah"
                                        data-id="{{ $ijazah->id_ijazah}}"><i class="bi bi-download text-gray"></i></a>


                                    <form action="" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-trash2-fill text-red"></i></button>
                                    </form>
                                </td>

                                {{-- Jika data berada pada index genap dan data selanjutnya masih ada. --}}
                                @if (($key % 2 === 0) && ($key + 1 !== $ijazah_count))
                                <td class="align-middle" rowspan="2">
                                    <a href="{{ route('generate4.pdf', ['id_ijazah' => $ijazah->id_ijazah, 'id_mahasiswa_satu' => $ijazah->mahasiswa_id, 'id_mahasiswa_dua' => $ijazah->get($key + 1)->mahasiswa_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>


                                </td>
                                {{-- Jika data berada pada index genap dan data selanjutnya kosong. --}}
                                @elseif (($key % 2 === 0) && ($key + 1 === $ijazah_count))
                                <td class="align-middle">
                                    <a href="{{ route('generate4.pdf', ['id_jurnal' => $ijazah->id_ijazah, 'id_mahasiswa_satu' => $ijazah->mahasiswa_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>

                                </td>
                                {{-- Jika data berada pada index ganjil. --}}
                                @else
                                <td class="d-none"></td>
                                @endif
                            </tr>
                            @endforeach



                            @foreach ($data_jurnal as $key=> $jurnal)
                            <tr>
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
                                        class="btn btn-sm js-status {{ $jurnal->status === 'unverified' ?'btn-danger' : ($jurnal->status === 'pending' ? 'btn-warning' : 'btn-success') }} disabled">
                                        {{ $jurnal->status }}
                                    </li>
                                </td>
                                <td class="text-center">
                                    {{ basename($jurnal->path_file_jurnal_mahasiswa) }}
                                </td>
                                <td class="">
                                    <a href="{{ asset('storage/' . $jurnal->path_file_jurnal_mahasiswa) }}"
                                        class="btn btn-sm btn-outline-secondary js-btn-download-jurnal"
                                        data-id="{{ $jurnal->id_jurnal}}"><i class="bi bi-download text-gray"></i></a>

                                    <a href="{{route('penerjemahan-admin.editPageJurnal', ['id_jurnal' => $jurnal->id_jurnal, 'id_mahasiswa' => $jurnal->mahasiswa_id])}}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-pen-fill text-green"></i></a>

                                    <form action="" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-trash2-fill text-red"></i></button>
                                    </form>
                                </td>

                                {{-- Jika data berada pada index genap dan data selanjutnya masih ada. --}}
                                @if (($key % 2 === 0) && ($key + 1 !== $jurnal_count))
                                <td class="align-middle" rowspan="2">
                                    <a
                                        href="{{ route('generate5.pdf', ['id_jurnal' => $jurnal->id_jurnal, 'id_mahasiswa_satu' => $jurnal->mahasiswa_id, 'id_mahasiswa_dua' => $jurnal->get($key + 1)->mahasiswa_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>


                                </td>
                                {{-- Jika data berada pada index genap dan data selanjutnya kosong. --}}
                                @elseif (($key % 2 === 0) && ($key + 1 === $jurnal_count))
                                <td class="align-middle">
                                    <a
                                        href="{{ route('generate5.pdf', ['id_jurnal' => $jurnal->id_jurnal, 'id_mahasiswa_satu' => $jurnal->mahasiswa_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>

                                </td>
                                {{-- Jika data berada pada index ganjil. --}}
                                @else
                                <td class="d-none"></td>
                                @endif
                            </tr>
                            @endforeach
                        
                    </tbody>

                    <tbody id="div-umumParent" class="d-none">
                            @foreach ($data_abstract_umum as $key => $abstract_umum)
                            <tr>
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
                                        class="btn btn-sm js-status {{ $abstract_umum->status === 'unverified' ?'btn-danger' : ($abstract_umum->status === 'pending' ? 'btn-warning' : 'btn-success') }} disabled">
                                        {{ $abstract_umum->status }}
                                    </li>
                                </td>
                                <td class="text-center">
                                    {{ basename($abstract_umum->path_file_abstrak_umum) }}
                                </td>
                                <td class="">
                                    {{-- <form
                                        action="{{route('abstract_umum-admin.changeStatus', ['id_abstrak' => $abstract_umum->id_abstrak, 'id_umum' => $abstract_umum->umum_id])}}"
                                        method="POST">
                                        @method('PATCH')
                                        @csrf --}}

                                        <a href="{{ asset('storage/' . $abstract_umum->path_file_abstrak_umum) }}"
                                            class="btn btn-sm btn-outline-secondary js-btn-download-abstrak-umum"
                                            data-id="{{ $abstract_umum->id_abstrak_umum}}"><i
                                                class="bi bi-download text-gray"></i></a>



                                        <a href="{{route('penerjemahan-admin.editPageAbstrakUmum', ['id_penerjemahan_umum' => $abstract_umum->id_abstrak_umum, 'id_umum' => $abstract_umum->umum_id])}}"
                                            class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-pen-fill text-green"></i></a>

                                        <form action="" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary"><i
                                                    class="bi bi-trash2-fill text-red"></i></button>
                                        </form>
                                </td>

                                {{-- Jika data berada pada index genap dan data selanjutnya masih ada. --}}
                                @if (($key % 2 === 0) && ($key + 1 !== $abstrak_umum_count))
                                <td class="align-middle" rowspan="2">
                                    <a href="{{ route('generateUmum2.pdf', ['id_abstract_umum' => $abstract_umum->id_abstrak_umum, 'id_umum_satu' => $abstract->umum_id, 'id_umum_dua' => $abstract->get($key + 1)->umum_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>


                                </td>
                                {{-- Jika data berada pada index genap dan data selanjutnya kosong. --}}
                                @elseif (($key % 2 === 0) && ($key + 1 === $abstrak_umum_count))
                                <td class="align-middle">
                                    <a href="{{ route('generateUmum2.pdf', ['id_abstract_umum' => $abstract_umum->id_abstrak_umum, 'id_umum_satu' => $abstract_umum->umum_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>

                                </td>
                                {{-- Jika data berada pada index ganjil. --}}
                                @else
                                <td class="d-none"></td>
                                @endif
                            </tr>

                            @endforeach

                            @foreach ($data_transkrip_nilai_umum as $key => $transkrip_nilai_umum)
                            <tr>
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
                                        class="btn btn-sm js-status {{ $transkrip_nilai_umum->status === 'unchecked' ?'btn-danger' : 'btn-success' }} disabled">
                                        {{ $transkrip_nilai_umum->status }}
                                    </li>
                                </td>
                                <td class="text-center">
                                    {{ basename($transkrip_nilai_umum->path_file_transkrip_nilai) }}
                                </td>
                                <td class="">
                                    <a href="{{ asset('storage/' . $transkrip_nilai_umum->path_file_transkrip_nilai) }}"
                                        class="btn btn-sm btn-outline-secondary js-btn-download-transkrip-nilai-umum"
                                        data-id="{{ $transkrip_nilai_umum->id_transkrip_nilai_umum}}"><i
                                            class="bi bi-download text-gray"></i></a>


                                    <form action="" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-trash2-fill text-red"></i></button>
                                    </form>
                                </td>

                                {{-- Jika data berada pada index genap dan data selanjutnya masih ada. --}}
                                @if (($key % 2 === 0) && ($key + 1 !== $transkrip_nilai_umum_count))
                                <td class="align-middle" rowspan="2">
                                    <a href="{{ route('generateUmum3.pdf', ['id_transkrip_nilai_umum' => $transkrip_nilai_umum->id_transkrip_nilai_umum, 'id_umum_satu' => $transkrip_nilai_umum->umum_id, 'id_umum_dua' =>  $transkrip_nilai_umum->get($key + 1)->umum_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>


                                </td>
                                {{-- Jika data berada pada index genap dan data selanjutnya kosong. --}}
                                @elseif (($key % 2 === 0) && ($key + 1 === $transkrip_nilai_umum_count))
                                <td class="align-middle">
                                    <a href="{{ route('generateUmum3.pdf', ['id_transkrip_nilai_umum' => $transkrip_nilai_umum->id_transkrip_nilai_umum, 'id_umum_satu' => $transkrip_nilai_umum->umum_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>

                                </td>
                                {{-- Jika data berada pada index ganjil. --}}
                                @else
                                <td class="d-none"></td>
                                @endif
                            </tr>


                            @endforeach

                            @foreach ($data_ijazah_umum as $key=> $ijazah_umum)
                            <tr>
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
                                        class="btn btn-sm js-status {{ $ijazah_umum->status === 'unchecked' ?'btn-danger' : 'btn-success' }} disabled">
                                        {{ $ijazah_umum->status }}
                                    </li>
                                </td>
                                <td class="text-center">
                                    {{ basename($ijazah_umum->path_file_ijazah) }}
                                </td>
                                <td class="">
                                    <a href="{{ asset('storage/' . $ijazah_umum->path_file_ijazah_umum) }}"
                                        class="btn btn-sm btn-outline-secondary js-btn-download-ijazah-umum"
                                        data-id="{{ $ijazah_umum->id_ijazah_umum}}"><i class="bi bi-download text-gray"></i></a>


                                    <form action="" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-trash2-fill text-red"></i></button>
                                    </form>
                                </td>

                                {{-- Jika data berada pada index genap dan data selanjutnya masih ada. --}}
                                @if (($key % 2 === 0) && ($key + 1 !== $ijazah_umum_count))
                                <td class="align-middle" rowspan="2">
                                    <a href="{{ route('generateUmum4.pdf', ['id_ijazah_umum' => $ijazah_umum->id_ijazah_umum, 'id_umum_satu' => $ijazah_umum->umum_id, 'id_umum_dua' => $ijazah_umum->get($key + 1)->umum_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>


                                </td>
                                {{-- Jika data berada pada index genap dan data selanjutnya kosong. --}}
                                @elseif (($key % 2 === 0) && ($key + 1 === $ijazah_umum_count))
                                <td class="align-middle">
                                    <a href="{{ route('generateUmum4.pdf', ['id_ijazah_umum' => $ijazah_umum->id_ijazah_umum, 'id_umum_satu' => $ijazah_umum->umum_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>

                                </td>
                                {{-- Jika data berada pada index ganjil. --}}
                                @else
                                <td class="d-none"></td>
                                @endif
                            </tr>
                            @endforeach



                            @foreach ($data_jurnal_umum as $key=> $jurnal_umum)
                            <tr>
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
                                        class="btn btn-sm js-status {{ $jurnal_umum->status === 'unverified' ?'btn-danger' : ($jurnal_umum->status === 'pending' ? 'btn-warning' : 'btn-success') }} disabled">
                                        {{ $jurnal_umum->status }}
                                    </li>
                                </td>
                                <td class="text-center">
                                    {{ basename($jurnal_umum->path_file_jurnal_umum) }}
                                </td>
                                <td class="">
                                    <a href="{{ asset('storage/' . $jurnal_umum->path_file_jurnal_umum) }}"
                                        class="btn btn-sm btn-outline-secondary js-btn-download-jurnal-umum"
                                        data-id="{{ $jurnal_umum->id_jurnal_umum}}"><i class="bi bi-download text-gray"></i></a>

                                    <a href="{{route('penerjemahan-admin.editPageJurnalUmum', ['id_jurnal_umum' => $jurnal_umum->id_jurnal_umum, 'id_umum' => $jurnal_umum->umum_id])}}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-pen-fill text-green"></i></a>

                                    <form action="" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-trash2-fill text-red"></i></button>
                                    </form>
                                </td>

                                {{-- Jika data berada pada index genap dan data selanjutnya masih ada. --}}
                                @if (($key % 2 === 0) && ($key + 1 !== $jurnal_umum_count))
                                <td class="align-middle" rowspan="2">
                                    <a
                                        href="{{ route('generateUmum5.pdf', ['id_jurnal_umum' => $jurnal_umum->id_jurnal_umum, 'id_umum_satu' => $jurnal_umum->umum_id, 'id_umum_dua' => $jurnal_umum->get($key + 1)->umum_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>


                                </td>
                                {{-- Jika data berada pada index genap dan data selanjutnya kosong. --}}
                                @elseif (($key % 2 === 0) && ($key + 1 === $jurnal_umum_count))
                                <td class="align-middle">
                                    <a
                                        href="{{ route('generateUmum5.pdf', ['id_jurnal_umum' => $jurnal_umum->id_jurnal_umum, 'id_umum_satu' => $jurnal_umum->umum_id]) }}"
                                        class="btn btn-sm btn-outline-secondary"><i
                                            class="bi bi-printer-fill text-indigo"></i></a>

                                </td>
                                {{-- Jika data berada pada index ganjil. --}}
                                @else
                                <td class="d-none"></td>
                                @endif
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
        // JS MAHASISWA
        // Button download abstrak
        $("#dataTable").on("click", ".js-btn-download-abstrak-umum", function () {
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

        $("#dataTable").on("click", ".js-btn-download-jurnal-umum", function () {
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


        // Button download transkrip nilai
        $("#dataTable").on("click", ".js-btn-download-transkrip-nilai-umum", function () {
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

        // Button download ijazah
        $("#dataTable").on("click", ".js-btn-download-ijazah-umum", function () {
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



          // JS UMUM/ PUBLIC
        // Button download abstrak
        $("#dataTable").on("click", ".js-btn-download-abstrak", function () {
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

        $("#dataTable").on("click", ".js-btn-download-jurnal", function () {
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


        // Button download transkrip nilai
        $("#dataTable").on("click", ".js-btn-download-transkrip-nilai", function () {
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

        // Button download ijazah
        $("#dataTable").on("click", ".js-btn-download-ijazah", function () {
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

        

        // Tampilkan tabel setelah #dataTable telah terload sepenuhnya.
        $("#dataTable").removeClass("invisible");

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
    });
</script>
@endpush

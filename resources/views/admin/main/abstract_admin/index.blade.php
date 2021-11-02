@extends('admin/layouts/app')
@section('path')
Penerjemahan
@endsection
@section('content')
<div class="container-fluid mt--6">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h3 class="mb-0">Penerjemahan</h3>
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
                    <tbody>
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



                                    <a href="{{route('penerjemahan-admin.editPage', ['id_penerjemahan' => $abstract->id_abstrak, 'id_mahasiswa' => $abstract->mahasiswa_id])}}"
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
                                {{-- <a href="{{ route('generate2.pdf', ['id_abstrak' => $abstract->id_abstrak, 'id_mahasiswa_satu' => $abstract->mahasiswa_id, 'id_mahasiswa_dua' => $abstract->get($key + 1)->mahasiswa_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a> --}}
                             

                            </td>
                            {{-- Jika data berada pada index genap dan data selanjutnya kosong. --}}
                            @elseif (($key % 2 === 0) && ($key + 1 === $abstrak_count))
                            <td class="align-middle">
                                {{-- <a href="{{ route('generate2.pdf', ['id_abstrak' => $abstract->id_abstrak, 'id_mahasiswa_satu' => $abstract->mahasiswa_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a> --}}
                        
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
                                {{-- <a href="{{ route('generate3.pdf', ['id_transkrip_nilai' => $transkrip_nilai->id_transkrip_nilai, 'id_mahasiswa_satu' => $transkrip_nilai->mahasiswa_id, 'id_mahasiswa_dua' =>  $transkrip_nilai->get($key + 1)->mahasiswa_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a> --}}
                               

                            </td>
                            {{-- Jika data berada pada index genap dan data selanjutnya kosong. --}}
                            @elseif (($key % 2 === 0) && ($key + 1 === $transkrip_nilai_count))
                            <td class="align-middle">
                                {{-- <a href="{{ route('generate3.pdf', ['id_transkrip_nilai' => $transkrip_nilai->id_transkrip_nilai, 'id_mahasiswa_satu' => $transkrip_nilai->mahasiswa_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a> --}}
                             
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
                                {{-- <a href="{{ route('generate4.pdf', ['id_ijazah' => $ijazah->id_ijazah, 'id_mahasiswa_satu' => $ijazah->mahasiswa_id, 'id_mahasiswa_dua' => $ijazah->get($key + 1)->mahasiswa_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a> --}}


                            </td>
                            {{-- Jika data berada pada index genap dan data selanjutnya kosong. --}}
                            @elseif (($key % 2 === 0) && ($key + 1 === $ijazah_count))
                            <td class="align-middle">
                                {{-- <a href="{{ route('generate4.pdf', ['id_kursus' => $ijazah->id_ijazah, 'id_mahasiswa_satu' => $ijazah->mahasiswa_id]) }}"
                                    class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-printer-fill text-indigo"></i></a> --}}
                    
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
        // Button download abstrak
        $("#dataTable").on("click", ".js-btn-download-abstrak", function () {
            const jsStatus = $(this).closest("tr").find(".js-status");
            const postData = { id: $(this).data("id") };

            $.post(
                "api/abstrak-change-status", 
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
    });
</script>
@endpush
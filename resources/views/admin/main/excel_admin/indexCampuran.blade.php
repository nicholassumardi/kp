<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>NPM</th>
            <th>No Kartu</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kursus->mahasiswa as $key => $mahasiswa)
        <tr>
            <td>{{ $mahasiswa->nama }}</td>
            <td>{{ $mahasiswa->npm }}</td>
            <td>{{ $mahasiswa->pivot->no_kartu_mahasiswa }}</td>
        </tr>
        @endforeach
        @foreach($kursus->umum as $key => $umum)
        <tr>
            <td>{{ $umum->nama }}</td>
            <td>-</td>
            <td>{{ $umum->pivot->no_kartu_umum }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
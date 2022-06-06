<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>NPM</th>
            <th>No Kartu Mahasiswa</th>
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
    </tbody>
</table>
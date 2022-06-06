<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>No Kartu Umum</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kursus->umum as $key => $umum)
        <tr>
            <td>{{ $umum->nama }}</td>
            <td>{{ $umum->pivot->no_kartu_umum }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<table>
    <thead>
        <tr style="text-align: center; font-weight: 600;">
            <th>No</th>
            <th>Nama Alat</th>
            <th>Merek</th>
            <th>Tipe</th>
            <th>No. Seri</th>
            <th>Ruang</th>
            <th>Hasil</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($alats as $alat)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $alat->devNames->name ?? '' }}</td>
                <td>{{ $alat->brand ?? '' }}</td>
                <td>{{ $alat->type ?? '' }}</td>
                <td>{{ $alat->serial_number ?? '' }}</td>
                <td>{{ $alat->location ?? '' }}</td>
                <td>{{ $alat->result ?? '' }}</td>
                <td>{{ $alat->note ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

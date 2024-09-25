<table>
    <thead>
        <tr style="text-align: center; font-weight: 600;">
            <th>No</th>
            <th>Nama Customer</th>
            <th>Nomor Telepon</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($cust as $customer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $customer->name ?? '' }}</td>
                <td>{{ $customer->phone_number ?? '' }}</td>
                <td>{{ $customer->address ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

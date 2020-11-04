<html>

<head>
    <title></title>
</head>

<body>
    <h1> Report Penjualan</h1>
    <hr />
    <table style="width:100%" border="1">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama produk</th>
                <th>jumlah </th>
                <th>harga</th>
                <th>tanggal</th>
                <th>Agen</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $row)
            <tr>
                <td>{{$loop->iteration }}</td>
                <td>{{$row ->produk->nama_produk}}</td>
                <td>{{$row ->jumlah}}</td>
                <td>@rupiah($row->harga)</td>
                <td>{{$row ->transaksi->tgl_penjualan}}</td>
                <td>{{$row ->transaksi->agen->nama_toko}}</td>
            </tr>
            @endforeach
</body>

</html>
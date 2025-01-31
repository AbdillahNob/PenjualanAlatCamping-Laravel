<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan BENTALA OUTDOOR</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>

    <h2>Laporan Penjualan BENTALA OUTDOOR</h2>
    <p><strong>Periode:</strong> {{ date('d-m-Y', strtotime($startDate)) }} - {{ date('d-m-Y', strtotime($endDate)) }}
    </p>
    <p><strong>Total Produk Terjual:</strong> {{ $totalProdukTerjual }}</p>
    <p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->user->namaLengkap }}</td>
                <td>{{ $data->produk->namaProduk }}</td>
                <td>{{ $data->jumlahPesanan }}</td>
                <td>Rp {{ number_format($data->totalPembayaran, 0, ',', '.') }}</td>
                <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
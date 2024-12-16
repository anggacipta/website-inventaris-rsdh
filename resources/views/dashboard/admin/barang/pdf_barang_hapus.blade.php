<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Dihapus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .w-half {
            width: 50%;
            font-size: 10px;
        }
        .w-half-right {
            width: 50%;
            text-align: right;
            font-size: 10px;
        }
        .borderless-table {
            border: none;
            margin-bottom: 40px;
        }
        .borderless-table th,
        .borderless-table td {
            border: none;
        }
        table {
            max-width: 100%;
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
            max-width: 150px; /* Adjust as needed */
        }
        th {
            background-color: #f2f2f2;
        }
        .grey-color {
            color: #a89d9d;
        }
    </style>
</head>
<body>
<!-- Header Blade dengan Flexbox -->
<table class="borderless-table">
    <tr>
        <td class="w-half">
            <img src="{{ public_path('assets/images/logos/LOGO_RS.png') }}" alt="Logo RS" width="80" height="80">
        </td>
        <td class="w-half-right">
            <h1>Laporan Barang Dihapus</h1>
            <h3>RS Dian Husada <br>
                <span class="grey-color">Layananku, Pengabdianku</span>
            </h3>
        </td>
    </tr>
</table>

<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Kode Barang</th>
        <th>No Seri</th>
        <th>Distributor</th>
        <th>No AKL/AKD</th>
        <th>Tanggal Pengadaan</th>
        <th>Tahun Pengadaan</th>
        <th>Harga</th>
        <th>Sumber Pengadaan</th>
        <th>Unit Kerja</th>
        <th>Jenis Barang</th>
        <th>Merk Barang</th>
        <th>Kondisi Barang</th>
        <th>Keterangan</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($barangs as $barang)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $barang->nama_barang }}</td>
            <td>{{ $barang->kode_barang }}</td>
            <td>{{ $barang->no_seri }}</td>
            <td>{{ $barang->distributors->nama_distributor ?? 'Tidak ada distributor resmi' }}</td>
            <td>{{ $barang->no_akl_akd }}</td>
            <td>{{ $barang->tahun_pengadaan }}</td>
            <td>{{ $barang->tahun }}</td>
            <td>{{ 'Rp' . number_format($barang->harga, 0, ',', '.') }}</td>
            <td>{{ $barang->sumberPengadaan->sumber_pengadaan }}</td>
            <td>{{ $barang->unitKerja->unit_kerja }}</td>
            <td>{{ $barang->jenisBarang->jenis_barang }}</td>
            <td>{{ $barang->merkBarang->merk_barang }}</td>
            <td>{{ $barang->kondisiBarang->kondisi_barang }}</td>
            <td>{{ $barang->keterangan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<!-- Footer Blade -->
<table class="borderless-table">
    <tr>
        <td class="w-half">
            <h3>Email: <span class="grey-color">rsdianhusada@gmail.com</span></h3>
            <h3>Phone: <span class="grey-color">0321-327771</span></h3>
            <h3>Website: <span class="grey-color">www.rsdianhusada.co.id</span></h3>
        </td>
        <td class="w-half-right">
            <p>Generated: {{ now()->setTimezone('Asia/Jakarta')->format('d F Y H:i') }}</p>
        </td>
    </tr>
</table>
</body>
</html>

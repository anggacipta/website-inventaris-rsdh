<!DOCTYPE html>
<html>
<head>
    <title>Laporan Log Maintenance</title>
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
            <h1>Laporan Log Maintenance</h1>
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
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Unit Kerja</th>
        <th>Jenis Barang</th>
        <th>Alasan Rusak</th>
        <th>Kondisi Barang</th>
        <th>Tanggal Pengajuan</th>
        <th>Tanggal Pengajuan Vendor</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($maintenances as $maint)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $maint->barang->kode_barang }}</td>
            <td>{{ $maint->barang->nama_barang }}</td>
            <td>{{ $maint->barang->unitKerja->unit_kerja }}</td>
            <td>{{ $maint->barang->jenisBarang->jenis_barang }}</td>
            <td>{{ $maint->alasan_rusak }}</td>
            <td>{{ $maint->kondisi_barang }}</td>
            <td>{{ \Carbon\Carbon::parse($maint->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
            <td>{{ \Carbon\Carbon::parse($maint->tanggal_maintenance_lanjutan)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
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

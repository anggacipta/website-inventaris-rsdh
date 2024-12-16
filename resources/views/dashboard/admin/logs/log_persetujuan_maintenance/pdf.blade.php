<!DOCTYPE html>
<html>
<head>
    <title>Laporan Log Persetujuan Maintenance</title>
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
            <h1>Laporan Log Persetujuan Maintenance</h1>
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
        <th>Persetujuan Staff Ahli</th>
        <th>Persetujuan Direktur</th>
        <th>Dibuat Pada</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($logs as $log)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $log->id_barang }}</td>
            <td>{{ $log->nama_barang }}</td>
            <td>{{ $log->unit_kerja }}</td>
            <td>
                @if($log->persetujuan_staff_ahli == '1')
                    <span class="badge bg-success">Disetujui</span>
                @elseif($log->persetujuan_staff_ahli == '0')
                    <span class="badge bg-danger">Tidak Disetujui</span>
                @else
                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                @endif
            </td>
            <td>
                @if($log->persetujuan_direktur == '1')
                    <span class="badge bg-success">Disetujui</span>
                @elseif($log->persetujuan_direktur == '0')
                    <span class="badge bg-danger">Tidak Disetujui</span>
                @else
                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}</td>
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

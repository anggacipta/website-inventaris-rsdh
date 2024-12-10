<!DOCTYPE html>
<html>
<head>
    <title>Barang Sticker</title>
    <style>
        .sticker {
            border: 1px solid #00923f;
            font-size: 14pt;
            margin-bottom: 10px;
        }
        .sticker img {
            display: block;
            margin: 0 auto;
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            margin-top: 20px;
        }
        .margin-top {
            margin-top: 100px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="no-print">
    <a href="{{ route('barang.index') }}" class="btn btn-outline-primary">Kembali ke Barang</a>
</div>
<div class="button-container no-print">
    <button class="btn btn-outline-success" onclick="window.print()">Print Label</button>
</div>
<div class="container">
    @foreach($barangs as $index => $barang)
        <div class="sticker mb-3 {{ $index % 4 == 0 ? 'margin-top' : '' }}">
            <img src="{{ asset('assets/images/logos/logo_rs_3.png') }}" style="width: 12cm; height: 2.5cm; object-fit: fill" alt="">
            <table class="table-borderless">
                <tr>
                    <td class="ps-2"><strong>Nama Barang</strong></td>
                    <td><strong>:</strong></td>
                    <td class="ps-2">{{ $barang->nama_barang }}</td>
                </tr>
                <tr>
                    <td class="ps-2"><strong>Kode Barang</strong></td>
                    <td><strong>:</strong></td>
                    <td class="ps-2">{{ $barang->kode_barang }}</td>
                </tr>
                <tr>
                    <td class="ps-2"><strong>Unit Kerja</strong></td>
                    <td><strong>:</strong></td>
                    <td class="ps-2">{{ $barang->unitKerja->unit_kerja }}</td>
                </tr>
            </table>
        </div>
    @endforeach
</div>
</body>
</html>

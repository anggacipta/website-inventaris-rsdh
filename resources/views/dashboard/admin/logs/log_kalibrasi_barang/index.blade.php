@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-4">Data Log Kalibrasi Barang</h4>
            </div>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Unit Kerja</th>
                    <th>Tanggal Kalibrasi Sebelumnya</th>
                    <th>No sertifikat</th>
                    <th>Ditambahkan pada</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <th scope="row">{{ $log->kode_barang }}</th>
                        <td>{{ $log->nama_barang }}</td>
                        <td>{{ $log->unit_kerja }}</td>
                        <td>{{ \Carbon\Carbon::parse($log->tanggal_kalibrasi)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}</td>
                        <td>{{ $log->no_sertifikat }}</td>
                        <td>{{ \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

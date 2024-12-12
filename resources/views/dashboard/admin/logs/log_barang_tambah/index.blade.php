@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-4">Data Log Barang Ditambahkan</h4>
            </div>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>No Akl Akd</th>
                    <th>No Seri</th>
                    <th>Harga</th>
                    <th>Tahun pengadaan</th>
                    <th>Ditambahkan pada</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <th scope="row">{{ $log->kode_barang }}</th>
                        <td>{{ $log->nama_barang }}</td>
                        <td>{{ $log->no_akl_akd }}</td>
                        <td>{{ $log->keterangan }}</td>
                        <td>Rp{{ number_format($log->harga) }}</td>
                        <td>{{ $log->tahun_pengadaan }}</td>
                        <td>{{ \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

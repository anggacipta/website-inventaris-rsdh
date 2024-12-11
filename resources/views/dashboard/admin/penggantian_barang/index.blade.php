@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-4">Data Barang Digantikan</h4>
            </div>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Alasan Rusak</th>
                    <th>Alasan Digantikan</th>
                    <th>Biaya Maintenance / Vendor</th>
                    <th>Catatan</th>
                    <th>Kondisi Barang</th>
                    <th>Digantikan Oleh</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($maintenances as $maint)
                    <tr>
                        <th scope="row">{{ $maint->barang->kode_barang }}</th>
                        <td>{{ $maint->barang->nama_barang }}</td>
                        <td>{{ $maint->alasan_rusak }}</td>
                        <td>{{ $maint?->alasan_diganti }}</td>
                        <td>Rp{{ number_format($maint->harga) }}</td>
                        <td>{{ $maint->catatan }}</td>
                        <td>{{ $maint->kondisiBarang->kondisi_barang }}</td>
                        <td>{{ $maint?->penggantianBarang->nama_barang }}:  {{ $maint?->penggantianBarang->kode_barang }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

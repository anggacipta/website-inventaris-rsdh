@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="clearfix"></div> <!-- for spacing -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Alasan rusak</th>
                    <th>Biaya Maintenance</th>
                    <th>Catatan</th>
                    <th>Kondisi Barang</th>
                    <th>Tanggal Pengajuan Maintenance</th>
                    <th>Tanggal Pengajuan Vendor</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($maintenances as $maint)
                    <tr>
                        <th scope="row">{{ $maint->barang->id }}</th>
                        <td>{{ $maint->barang->nama_barang }}</td>
                        <td>{{ $maint->alasan_rusak }}</td>
                        <td>{{ 'Rp' . number_format($maint->harga, 2, ',', '.') }}</td>
                        <td>{{ $maint->catatan }}</td>
                        <td>{{ $maint->kondisiBarang->kondisi_barang }}</td>
                        <td>{{ \Carbon\Carbon::parse($maint->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($maint->updated_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('maintenance.diperbaiki.lanjutan', $maint->id) }}" class="btn btn-info">Berhasil Diperbaiki</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

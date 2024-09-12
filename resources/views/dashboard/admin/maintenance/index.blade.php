@extends('dashboard.admin.layouts.main')
@section('content')
    @include('dashboard.admin.layouts.navbar')
    <div class="container-fluid">
        <div class="card-body">
            <div class="clearfix"></div>
            <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Unit Kerja</th>
                    <th>Alasan rusak</th>
                    <th>Kondisi Barang</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($maintenances as $maint)
                    <tr>
                        <th scope="row">{{ $maint->barang->id }}</th>
                        <td>{{ $maint->barang->nama_barang }}</td>
                        <td>{{ $maint->barang->unitKerja->unit_kerja }}</td>
                        <td>{{ $maint->alasan_rusak }}</td>
                        <td>{{ $maint->kondisiBarang->kondisi_barang }}</td>
                        <td>{{ \Carbon\Carbon::parse($maint->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                        <td>
                            @can('maintenance.lanjut')
                            <a href="{{ route('maintenance.lanjutan', $maint->id) }}" class="btn btn-warning">Maintenance Lanjutan</a>
                            @endcan
                            @can('maintenance.rusak')
                            <a href="{{ route('maintenance.rusak', $maint->id) }}" class="btn btn-danger">Rusak</a>
                            @endcan
                            @can('maintenance.diperbaiki')
                            <a href="{{ route('maintenance.diperbaiki', $maint->id) }}" class="btn btn-info my-2">Berhasil Diperbaiki</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

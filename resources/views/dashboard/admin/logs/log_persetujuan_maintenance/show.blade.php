<!-- File: resources/views/dashboard/admin/logs/log_persetujuan_maintenance/show.blade.php -->

@extends('dashboard.admin.layouts.main')
@section('content')
    @include('dashboard.admin.layouts.navbar')
    <div class="container-fluid">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Detail Persetujuan Maintenance</h5>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID Barang</th>
                            <td>{{ $persetujuan->id_barang }}</td>
                        </tr>
                        <tr>
                            <th>Nama Barang</th>
                            <td>{{ $persetujuan->nama_barang }}</td>
                        </tr>
                        <tr>
                            <th>Unit Kerja</th>
                            <td>{{ $persetujuan->unit_kerja }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengajuan Maintenance</th>
                            <td>{{ \Carbon\Carbon::parse($persetujuan->tanggal_maintenance)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Maintenance Lanjutan</th>
                            <td>{{ \Carbon\Carbon::parse($persetujuan->tanggal_maintenance_lanjutan)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Biaya Pengajuan Vendor</th>
                            <td>Rp{{ number_format($persetujuan->harga_vendor) }}</td>
                        </tr>
                        <tr>
                            <th>Persetujuan Staff Ahli</th>
                            <td>
                                @if($persetujuan->persetujuan_staff_ahli == '1')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($persetujuan->persetujuan_staff_ahli == '0')
                                    <span class="badge bg-danger">Tidak Disetujui</span>
                                @else
                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Persetujuan Direktur</th>
                            <td>
                                @if($persetujuan->persetujuan_direktur == '1')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($persetujuan->persetujuan_direktur == '0')
                                    <span class="badge bg-danger">Tidak Disetujui</span>
                                @else
                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Catatan Staff Ahli</th>
                            <td>{{ $persetujuan->catatan_staff }}</td>
                        </tr>
                        <tr>
                            <th>Catatan Direktur</th>
                            <td>{{ $persetujuan->catatan_direktur }}</td>
                    </table>
                    <a href="{{ route('log.persetujuan.maintenance') }}" class="btn btn-primary">Kembali ke persetujuan</a>
                </div>
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

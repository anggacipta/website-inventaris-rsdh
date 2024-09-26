@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="clearfix"></div> <!-- for spacing -->
            <div class="table-responsive">
                <table id="" class="table table-bordered table-striped">
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
                        <th>Persetujuan Staff Ahli</th>
                        <th>Persetujuan Direktur</th>
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
                                @if ($maint->persetujuan_staff_ahli == '')
                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                @elseif($maint->persetujuan_staff_ahli == 0)
                                    <span class="badge bg-danger">Tidak Disetujui</span>
                                @else
                                    <span class="badge bg-success">Disetujui</span>
                                @endif
                            </td>
                            <td>
                                @if ($maint->persetujuan_direktur == '' || $maint->persetujuan_staff_ahli == '')
                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                @elseif($maint->persetujuan_staff_ahli == 0 || $maint->persetujuan_direktur == 0)
                                    <span class="badge bg-danger">Tidak Disetujui</span>
                                @else
                                    <span class="badge bg-success">Disetujui</span>
                                @endif
                            </td>
                            <td>
                                @if($maint->persetujuan_staff_ahli == '')
                                    @can('staff.ahli.persetujuan')
                                    <a href="{{ route('setuju.staff', $maint->id) }}" class="btn btn-success mb-2">Setujui</a>
                                    <a href="{{ route('tidak.setuju.staff', $maint->id) }}" class="btn btn-danger">Tidak Setuju</a>
                                    @endcan
                                @elseif($maint->persetujuan_direktur == '' && $maint->persetujuan_staff_ahli == 1)
                                    @can('direktur.persetujuan')
                                    <a href="{{ route('setuju.direktur', $maint->id) }}" class="btn btn-success mb-2">Setujui</a>
                                    <a href="{{ route('tidak.setuju.direktur', $maint->id) }}" class="btn btn-danger">Tidak Setuju</a>
                                    @endcan
                                @elseif($maint->persetujuan_direktur == 1 && $maint->persetujuan_staff_ahli == 1)
                                    @can('maintenance.diperbaiki')
                                    <a href="{{ route('maintenance.diperbaiki.lanjutan', $maint->id) }}" class="btn btn-info">Berhasil Diperbaiki</a>
                                    @endcan
                                @else

                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

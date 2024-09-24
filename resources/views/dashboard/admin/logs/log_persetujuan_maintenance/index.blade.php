<!-- File: resources/views/dashboard/admin/logs/log_persetujuan_maintenance/index.blade.php -->

@extends('dashboard.admin.layouts.main')
@section('content')
    @include('dashboard.admin.layouts.navbar')
    <div class="container-fluid">
        <div class="card-body">
            <div class="clearfix"></div> <!-- for spacing -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Unit Kerja</th>
                    <th>Persetujuan Staff Ahli</th>
                    <th>Persetujuan Direktur</th>
                    <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($persetujuans as $tuju)
                    <tr>
                        <th scope="row">{{ $tuju->id_barang }}</th>
                        <td>{{ $tuju->nama_barang }}</td>
                        <td>{{ $tuju->unit_kerja }}</td>
                        <td>
                            @if($tuju->persetujuan_staff_ahli == '1')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($tuju->persetujuan_staff_ahli == '0')
                                <span class="badge bg-danger">Tidak Disetujui</span>
                            @else
                                <span class="badge bg-warning">Menunggu Persetujuan</span>
                            @endif
                        </td>
                        <td>
                            @if($tuju->persetujuan_direktur == '1')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($tuju->persetujuan_direktur == '0')
                                <span class="badge bg-danger">Tidak Disetujui</span>
                            @else
                                <span class="badge bg-warning">Menunggu Persetujuan</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('log.persetujuan.maintenance.show', $tuju->id) }}" class="btn btn-info">Detail</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

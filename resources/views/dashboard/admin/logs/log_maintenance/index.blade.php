@extends('dashboard.admin.layouts.main')
@section('content')
    @include('dashboard.admin.layouts.navbar')
    <div class="container-fluid">
        <div class="card-body">
            <form action="{{ route('log.maintenance') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select name="unit_kerja" class="form-control js-example-basic-single">
                            <option value="">Pilih Unit Kerja</option>
                            @foreach($unitKerjas as $unitKerja)
                                <option value="{{ $unitKerja->unit_kerja }}" {{ request('unit_kerja') == $unitKerja->unit_kerja ? 'selected' : '' }}>{{ $unitKerja->unit_kerja }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="jenis_barang" class="form-control js-example-basic-single">
                            <option value="">Pilih Jenis Barang</option>
                            @foreach($jenisBarangs as $jenisBarang)
                                <option value="{{ $jenisBarang->jenis_barang }}" {{ request('jenis_barang') == $jenisBarang->jenis_barang ? 'selected' : '' }}>{{ $jenisBarang->jenis_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="nama_barang" class="form-control" placeholder="Cari Nama Barang" value="{{ request('nama_barang') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table id="" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Unit Kerja</th>
                        <th>Jenis Barang</th>
                        <th>Alasan rusak</th>
                        <th>Kondisi Barang</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Pengajuan Vendor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($maintenances as $maint)
                        <tr>
                            <th scope="row">{{ $maint->barang->id }}</th>
                            <td>{{ $maint->barang->nama_barang }}</td>
                            <td>{{ $maint->barang->unitKerja->unit_kerja }}</td>
                            <td>{{ $maint->barang->jenisBarang->jenis_barang }}</td>
                            <td>{{ $maint->alasan_rusak }}</td>
                            <td>{{ $maint->kondisiBarang->kondisi_barang }}</td>
                            <td>{{ \Carbon\Carbon::parse($maint->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($maint->tanggal_maintenance_lanjutan)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $maintenances->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

@extends('dashboard.admin.layouts.main')
@section('content')
    @include('dashboard.admin.layouts.navbar')
    <div class="container-fluid">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-4">Data Log Maintenance</h4>
            </div>
            <form action="{{ route('log.maintenance') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-12 mb-2">
                        <input type="text" name="search" placeholder="Cari nama, distributor atau kode barang" value="{{ request('search') }}" class="form-control">
                    </div>
                    <div class="col-md-12 mb-2">
                        <select name="unit_kerja" class="form-select js-example-basic-single">
                            <option value="">Pilih Unit Kerja</option>
                            @foreach($unitKerjas as $unitKerja)
                                <option value="{{ $unitKerja->unit_kerja }}" {{ request('unit_kerja') == $unitKerja->unit_kerja ? 'selected' : '' }}>{{ $unitKerja->unit_kerja }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-2">
                        <select name="jenis_barang" class="form-select js-example-basic-single">
                            <option value="">Pilih Jenis Barang</option>
                            @foreach($jenisBarangs as $jenisBarang)
                                <option value="{{ $jenisBarang->jenis_barang }}" {{ request('jenis_barang') == $jenisBarang->jenis_barang ? 'selected' : '' }}>{{ $jenisBarang->jenis_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-2">
                        <select name="bulan" class="form-select">
                            <option value="">Pilih Bulan</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-12 mb-2">
                        <select name="tahun" class="form-select">
                            <option value="">Pilih Tahun</option>
                            @for($i = now()->year; $i >= now()->year - 5; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table id="" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Kode Barang</th>
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
                            <th scope="row">{{ $maint->barang->kode_barang }}</th>
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
            <div class="mt-4" style="max-width: 600px;">
                <form action="{{ route('log.maintenance.pdf') }}" method="GET" class="d-inline" id="export-form">
                    <div class="row">
                        <div class="col-3">
                            <select name="format_export" class="form-select me-2 js-example-basic-single">
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="unit_kerja" class="form-select me-2 js-example-basic-single">
                                <option value="">Pilih Unit Kerja</option>
                                @foreach($unitKerjas as $unitKerja)
                                    <option value="{{ $unitKerja->unit_kerja }}">{{ $unitKerja->unit_kerja }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="tahun" class="form-select js-example-basic-single">
                                <option value="" class="">Pilih Tahun</option>
                                @for($i = now()->year; $i >= now()->year - 10; $i--)
                                    <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary" id="export-btn">
                                Export
                                <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

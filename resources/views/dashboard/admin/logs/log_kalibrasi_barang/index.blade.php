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
            <form action="{{ route('log.kalibrasi.barang') }}" method="GET">
                <div class="row mb-3">
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
        <div class="mt-4" style="max-width: 600px;">
            <form action="{{ route('log.kalibrasi.barang.pdf') }}" method="GET" class="d-inline" id="export-form">
                <div class="row">
                    <div class="col-3">
                        <select name="format_export" class="form-select me-2 js-example-basic-single">
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="bulan" class="form-select me-2 js-example-basic-single">
                            <option value="">Pilih Bulan</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="tahun" class="form-select js-example-basic-single">
                            <option value="" class="">Pilih Tahun</option>
                            @for($i = now()->year; $i >= now()->year - 5; $i--)
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
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

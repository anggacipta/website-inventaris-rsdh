@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-4">Data Log Barang Dihapus</h4>
            </div>
            <form action="{{ route('log.barang') }}" method="GET">
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
            <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Unit Kerja</th>
                    <th>Alasan Dihapus</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <th scope="row">{{ $log->id_barang }}</th>
                        <td>{{ $log->nama_barang }}</td>
                        <td>{{ $log->unit_kerja }}</td>
                        <td>{{ $log->keterangan }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $logs->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <div class="mt-4" style="max-width: 600px;">
            <form action="{{ route('log.barang.dihapus.pdf') }}" method="GET" class="d-inline" id="export-form">
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

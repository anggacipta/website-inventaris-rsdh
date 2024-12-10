@extends('dashboard.admin.layouts.main')
@section('content')
    @include('dashboard.admin.layouts.navbar')
    <div class="container-fluid">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-4">Data Maintenance Diperbaiki</h4>
                <form method="GET" action="{{ route('maintenance.diperbaiki.index') }}">
                    <div class="d-flex">
                        <select name="bulan" class="form-select me-2">
                            <option value="">Pilih Bulan</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                        <select name="tahun" class="form-select me-2">
                            <option value="">Pilih Tahun</option>
                            @for ($i = 2020; $i <= \Carbon\Carbon::now()->year; $i++)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
            <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Alasan rusak</th>
                    <th>Biaya Maintenance</th>
                    <th>Catatan</th>
                    <th>Durasi Pengerjaan</th>
                    <th>Diperbaiki oleh</th>
                    <th>Disetujui oleh</th>
                    <th>Kondisi Barang</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($maintenances as $maint)
                    <tr>
                        <th scope="row">{{ $maint->barang->kode_barang }}</th>
                        <td>{{ $maint->barang->nama_barang }}</td>
                        <td>{{ $maint->alasan_rusak }}</td>
                        <td>{{ 'Rp' . number_format($maint->harga, 2, ',', '.') }}</td>
                        <td>{{ $maint->catatan }}</td>
                        <td>
                            @php
                                $created = \Carbon\Carbon::parse($maint->created_at)->timezone('Asia/Jakarta');
                                $updated = \Carbon\Carbon::parse($maint->updated_at)->timezone('Asia/Jakarta');
                                $diff = $created->diff($updated);
                                $diffString = '';
                                if ($diff->d > 0) {
                                    $diffString .= $diff->d . ' hari ';
                                }
                                if ($diff->h > 0) {
                                    $diffString .= $diff->h . ' jam ';
                                }
                                if ($diff->i > 0) {
                                    $diffString .= $diff->i . ' menit';
                                }
                                if ($diff->d == 0 && $diff->h == 0 && $diff->i == 0) {
                                    $diffString = 'kurang dari 1 menit';
                                }
                            @endphp
                            {{ $diffString }}
                        </td>
                        <td>{{ $maint->diperbaiki }}</td>
                        <td>{{ $maint->disetujui }}</td>
                        <td>{{ $maint->kondisiBarang->kondisi_barang }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $maintenances->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

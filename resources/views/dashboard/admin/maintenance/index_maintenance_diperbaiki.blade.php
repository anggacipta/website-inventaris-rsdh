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
                    <th>Durasi Pengerjaan</th>
                    <th>Diperbaiki oleh</th>
                    <th>Disetujui oleh</th>
                    <th>Kondisi Barang</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($maintenances as $maint)
                    <tr>
                        <th scope="row">{{ $maint->barang_id }}</th>
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
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

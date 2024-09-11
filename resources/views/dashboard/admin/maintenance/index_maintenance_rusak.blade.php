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
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Alasan rusak</th>
                    <th>Biaya</th>
                    <th>Catatan</th>
                    <th>Kondisi Barang</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($maintenances as $maint)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $maint->barang->id }}</td>
                        <td>{{ $maint->alasan_rusak }}</td>
                        <td>{{ $maint->harga }}</td>
                        <td>{{ $maint->catatan }}</td>
                        <td>{{ $maint->kondisiBarang->kondisi_barang }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

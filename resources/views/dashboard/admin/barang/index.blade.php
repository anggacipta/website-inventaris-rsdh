@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-4">Data Barang</h4>
                <div>
                    <a href="{{ route('print.sticker.all') }}" class="btn text-light" style="background-color: darkgreen">Print All Label</a>
                    @can('create.barang')
                    <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
                    @endcan
                </div>
            </div>
            <div class="table-responsive">
                <table id="" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Distributor</th>
                        <th>No AKL/AKD</th>
                        <th>Tahun Pengadaan</th>
                        <th>Harga</th>
                        <th>Sumber Pengadaan</th>
                        <th>Unit Kerja</th>
                        <th>Jenis Barang</th>
                        <th>Merk Barang</th>
                        <th>Kondisi Barang</th>
                        <th>Keterangan</th>
                        <th>Print Label</th>
                        <th>Maintenance</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($barangs as $barang)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->distributor }}</td>
                            <td>{{ $barang->no_akl_akd }}</td>
                            <td>{{ $barang->tahun_pengadaan }}</td>
                            <td>{{ 'Rp' . number_format($barang->harga, 2, ',', '.') }}</td>
                            <td>{{ $barang->sumberPengadaan->sumber_pengadaan }}</td>
                            <td>{{ $barang->unitKerja->unit_kerja }}</td>
                            <td>{{ $barang->jenisBarang->jenis_barang }}</td>
                            <td>{{ $barang->merkBarang->merk_barang }}</td>
                            <td>{{ $barang->kondisiBarang->kondisi_barang }}</td>
                            <td>{{ $barang->keterangan }}</td>
                            <td><a href="{{ route('print.sticker', $barang->id) }}" class="btn text-light" style="background-color: deepskyblue">Print</a></td>
                            <td>
                                @if($barang->kondisiBarang->kondisi_barang == 'Maintenance' || $barang->kondisiBarang->kondisi_barang == 'Maintenance Lanjutan')
                                    <span class="btn btn-info">Sedang Maintenance</span>
                                @else
                                    <a href="{{ route('maintenance.create', $barang->id) }}" class="btn btn-success">Maintenance</a>
                                @endif
                            </td>
                            <td>
                                @can('update.barang')
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning">Edit</a>
                                @endcan
                                @can('delete.barang')
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $barangs->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
    <script>
        $('#bs-example-modal-md').on('show.bs.modal', function(event) {
            const id = $(event.relatedTarget).data('id');
            $(this).find('#barangId').val(id);
        });
    </script>
@endsection

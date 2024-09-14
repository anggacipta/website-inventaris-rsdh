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
                        <th>Gambar Barang</th>
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
                            <td><img src="{{  asset('images/' . $barang->photo)}}" width="100" height="100" alt=""></td>
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
                                @elseif($barang->kondisiBarang->kondisi_barang == 'Rusak')
                                    <span class="btn btn-danger">Barang telah rusak</span>
                                @else
                                    <a href="{{ route('maintenance.create', $barang->id) }}" class="btn btn-success">Maintenance</a>
                                @endif
                            </td>
                            <td class="">
                                @can('update.barang')
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning mb-2">Edit</a>
                                @endcan
                                @can('delete.barang')
                                <a href="{{ route('create.log.barang', $barang->id) }}" class="btn btn-danger">Hapus</a>
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
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Kamu dapat mengembalikan data ini nantinya",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <script>
        $('#bs-example-modal-md').on('show.bs.modal', function(event) {
            const id = $(event.relatedTarget).data('id');
            $(this).find('#barangId').val(id);
        });
    </script>
@endsection

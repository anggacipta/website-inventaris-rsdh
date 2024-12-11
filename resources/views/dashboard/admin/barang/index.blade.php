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
                <form action="{{ route('barang.index') }}" method="GET">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text" name="search" placeholder="Cari nama, distributor atau kode barang" value="{{ request('search') }}" class="form-control">
                        </div>
                        @if(auth()->user()->role->name == 'iprs' || auth()->user()->role->name == 'server')
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
                        @endif
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <table id="" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar Barang</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>No Seri</th>
                        <th>Distributor</th>
                        <th>No AKL/AKD</th>
                        <th>Tanggal Pengadaan</th>
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
                            @if($barang->photo == 'no_image.png')
                                <td><img src="{{asset('images/no_image/no_image.png')}}" width="100" height="100" alt=""></td>
                            @else
                                <td><img src="{{asset('images/' . $barang->photo)}}" width="100" height="100" alt=""></td>
                            @endif
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->no_seri }}</td>
                            <td>{{ $barang->distributors->nama_distributor ?? 'Tidak ada distributor resmi' }}</td>
                            <td>{{ $barang->no_akl_akd }}</td>
                            <td>{{ $barang->tahun_pengadaan }}</td>
                            <td>{{ $barang->tahun }}</td>
                            <td>{{ 'Rp' . number_format($barang->harga, 0, ',', '.') }}</td>
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
                                @elseif($barang->kondisiBarang->kondisi_barang == 'Digantikan')
                                    <span class="btn" style="background-color: #3cea3f; color: white">Barang telah digantikan</span>
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

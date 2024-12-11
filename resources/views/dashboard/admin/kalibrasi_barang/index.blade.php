@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-4">Data Barang Kalibrasi</h4>
            </div>
            <div class="table-responsive">
                <form action="{{ route('kalibrasi.barang.index') }}" method="GET">
                    <div class="row mb-3">
                        <div class="col-12 mb-2">
                            <input type="text" name="search" placeholder="Cari nama, distributor atau kode barang" value="{{ request('search') }}" class="form-control">
                        </div>
                        @if(auth()->user()->role->name == 'iprs' || auth()->user()->role->name == 'server')
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
                        @endif
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
                                @for($i = now()->year; $i <= now()->year + 5; $i++)
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
                        <th>No</th>
                        <th>Gambar Barang</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>No Seri</th>
                        <th>Distributor</th>
                        <th>Tahun Pengadaan</th>
                        <th>Unit Kerja</th>
                        <th>Jenis Barang</th>
                        <th>Merk Barang</th>
                        <th>Tanggal Kalibrasi</th>
                        <th>No. Sertifikat Kalibrasi</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($barangs as $barang)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                @if($barang->photo == 'no_image.png' || $barang->photo == '')
                                    <img src="{{ asset('images/no_image/no_image.png') }}" width="100" height="100" alt="">
                                @else
                                    <img src="{{ asset('images/' . $barang->photo) }}" width="100" height="100" alt="">
                                @endif
                            </td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->no_seri }}</td>
                            <td>{{ $barang->distributors->nama_distributor ?? 'Tidak ada distributor resmi' }}</td>
                            <td>{{ $barang->tahun }}</td>
                            <td>{{ $barang->unitKerja->unit_kerja }}</td>
                            <td>{{ $barang->jenisBarang->jenis_barang }}</td>
                            <td>{{ $barang->merkBarang->merk_barang }}</td>
                            <td>{{ $barang->formatted_tanggal_kalibrasi ?? 'Tidak ada tanggal Kalibrasi' }}</td>
                            <td>{{ $barang->no_sertifikat }}</td>
                            <td>
                                <a href="{{ route('kalibrasi.barang.edit', $barang->id) }}" class="btn btn-primary mb-2">Sudah Kalibrasi</a>
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

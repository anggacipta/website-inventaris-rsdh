@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-4">Data Barang Dihapus</h4>
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
                            <td class="">
                                <form action="{{ route('barang.restore', $barang->id) }}" method="post" class="d-inline restore-form">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn btn-success mb-2">Pulihkan data ini</button>
                                </form>
                                <form action="{{ route('barang.forceDelete', $barang->id) }}" method="post" class="d-inline force-delete-form">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Hapus data permanen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $barangs->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @if(auth()->user()->role->name == 'iprs' || auth()->user()->role->name == 'server')
                <div class="mt-4" style="max-width: 600px;">
                    <form action="{{ route('barang.dihapus.pdf') }}" method="GET" class="d-inline" id="export-form">
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
            @endif
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.restore-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Data ini sudah dihapus, kamu ingin mengembalikan data ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, pulihkan!'
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
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.force-delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Data ini akan benar benar dihapus, kamu tidak akan bisa mengembalikan data ini lagi!",
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

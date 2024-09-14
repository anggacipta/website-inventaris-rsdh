@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Data Barang Dihapus</h5>
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('hapus.barang', $barang->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                        <h5 class="">{{ $barang->nama_barang }}</h5>
                                        <input type="hidden" name="nama_barang" class="form-control" id="nama_barang"
                                               aria-describedby="emailHelp" value="{{ $barang->nama_barang }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Unit Kerja</label>
                                        <h5 class="">{{ $barang->unitKerja->unit_kerja }}</h5>
                                        <input type="hidden" name="unit_kerja" class="form-control" id="unit_kerja"
                                               aria-describedby="emailHelp" value="{{ $barang->unitKerja->unit_kerja }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Mengapa barang harus dihapus?</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>
@endsection

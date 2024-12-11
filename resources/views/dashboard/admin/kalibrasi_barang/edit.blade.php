@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Data Barang Kalibrasi</h5>
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
                        <form action="{{ route('kalibrasi.barang.update', $barang->id) }}" method="post">
                            @csrf
                            @method('PUT')
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
                                        <label for="exampleInputEmail1" class="form-label">Kode Barang</label>
                                        <h5 class="">{{ $barang->kode_barang }}</h5>
                                        <input type="hidden" name="kode_barang" class="form-control" id="nama_barang"
                                               aria-describedby="emailHelp" value="{{ $barang->kode_barang }}">
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
                            {{--      Form for Update Kalibrasi       --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_kalibrasi" class="form-label">Tanggal Kalibrasi Selanjutnya</label>
                                        <input type="date" class="form-control" name="tanggal_kalibrasi" id="tanggal_kalibrasi" value="{{ $barang->tanggal_kalibrasi }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_sertifikat" class="form-label">No Sertifikat</label>
                                        <input type="text" class="form-control" name="no_sertifikat" id="no_sertifikat">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Kalibrasi</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>
@endsection

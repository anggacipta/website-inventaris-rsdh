@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Persetujuan staff ahli</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('store.setuju.staff', $maintenance->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                        <p>{{ $maintenance->barang->nama_barang }}</p>
                                        <input type="hidden" name="nama_barang" class="form-control" id="nama" value="{{$maintenance->barang->nama_barang}}" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Kode Barang</label>
                                        <p>{{ $maintenance->barang->kode_barang }}</p>
                                        <input type="hidden" name="kode_barang" class="form-control" id="nama" value="{{$maintenance->barang->kode_barang}}" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Unit Kerja</label>
                                        <p>{{ $maintenance->barang->unitKerja->unit_kerja }}</p>
                                        <input type="hidden" name="unit_kerja" class="form-control" id="nama" value="{{$maintenance->barang->unitKerja->unit_kerja}}" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal Pengajuan Vendor</label>
                                        <p>{{  \Carbon\Carbon::parse($maintenance->tanggal_maintenance_lanjutan)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
                                        <input type="hidden" name="tanggal_maintenance_lanjutan" class="form-control" id="nama" value="{{$maintenance->tanggal_maintenance_lanjutan}}" aria-describedby="emailHelp">
                                        <input type="hidden" name="tanggal_maintenance" class="form-control" id="nama" value="{{$maintenance->created_at}}" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Alasan kerusakan</label>
                                        <p>{{ $maintenance->alasan_rusak }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Alasan pengajuan vendor</label>
                                        <p>{{ $maintenance->catatan }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Biaya pengajuan Vendor</label>
                                        <p>Rp{{ number_format($maintenance->harga) }}</p>
                                        <input type="hidden" name="harga_vendor" class="form-control" id="nama" value="{{$maintenance->harga}}" aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="catatan_staff" class="form-label">Mengapa disetujui?</label>
                                <textarea class="form-control" id="catatan_staff" name="catatan_staff_ahli" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
@endsection

@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Jenis Barang</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('jenis-barang.update', $jenis_barang->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jenis Barang</label>
                                <input type="text" name="jenis_barang" class="form-control" id="nama" value="{{$jenis_barang->jenis_barang}}" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kode Barang(jangan gunakan angka)</label>
                                <input type="text" name="kode_barang" class="form-control" id="nama" aria-describedby="emailHelp" value="{{ $jenis_barang->kode_barang }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
@endsection

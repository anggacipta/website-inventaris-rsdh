@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Unit Kerja</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('unit-kerja.update', $unit->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Unit Kerja</label>
                                <input type="text" name="unit_kerja" class="form-control" id="nama" value="{{$unit->unit_kerja}}" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control" id="nama" value="{{ $unit->kode_barang }}" aria-describedby="emailHelp">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
@endsection

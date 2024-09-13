@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Maintenance Barang</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('maintenance.store') }}" method="post">
                            @csrf
                            <input type="hidden" id="barangId" name="barang_id" value="{{ $barang->id }}">
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Kenapa bisa rusak</label>
                                <textarea class="form-control" name="alasan_rusak" id="keterangan" required rows="6"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="kondisi_barang" class="form-label">Kondisi barang</label>
                                <select name="kondisi_barang_id" class="form-control" id="kondisi_barang">
                                    <option value="{{ $kondisiBarang->id }}">{{ $kondisiBarang->kondisi_barang }}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
@endsection

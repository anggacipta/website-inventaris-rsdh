@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Maintenance Lanjutan Barang</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('maintenance.lanjutan.update', $maintenance->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="barangId" name="barang_id" value="{{ $maintenance->barang_id }}">
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Catatan</label>
                                <textarea class="form-control" name="catatan" id="keterangan" rows="6" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="biaya" class="form-label">Biaya Maintenance</label>
                                <input type="number" name="harga" class="form-control" id="biaya" required aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="kondisi_barang" class="form-label">Kondisi barang</label>
                                <select name="kondisi_barang_id" class="form-control" id="kondisi_barang">
                                    <option value="{{ $kondisiBarang->id }}">{{ $kondisiBarang->kondisi_barang }}</option>
                                </select>
                            </div>
                           <div class="mb-3">
                               <label for="vendor" class="form-label">Vendor</label>
                               <select class="form-control js-example-basic-single" name="vendor_id"
                                       id="vendor">
                                   <option>Pilih Vendor</option>
                                   @foreach ($vendors as $vendor)
                                       <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}
                                       </option>
                                   @endforeach
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

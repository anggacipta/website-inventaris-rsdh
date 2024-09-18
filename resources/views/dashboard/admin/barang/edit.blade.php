@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Barang</h5>
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
                        <form action="{{ route('barang.update', $barang->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                        <input type="text" name="nama_barang" class="form-control" id="nama_barang"
                                               aria-describedby="emailHelp" value="{{ $barang->nama_barang }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Unit Kerja</label>
                                        <select class="form-control js-example-basic-single" name="unit_kerja_id" id="unit_kerja">
                                            <option>Pilih unit kerja</option>
                                            @foreach ($unit_kerjas as $unitKerja)
                                                <option value="{{ $unitKerja->id }}" {{ $barang->unitKerja->id == $unitKerja->id ? 'selected' : '' }}>{{ $unitKerja->unit_kerja }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="distributor" class="form-label">Distributor</label>
                                        <input type="text" name="distributor" class="form-control" id="distributor"
                                               aria-describedby="emailHelp" value="{{ $barang->distributor }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jenis_barang" class="form-label">Jenis Barang</label>
                                        <select class="form-control js-example-basic-single" name="jenis_barang_id"
                                                id="jenis_barang">
                                            <option>Pilih Jenis Barang</option>
                                            @foreach ($jenis_barangs as $jenisBarang)
                                                <option value="{{ $jenisBarang->id }}" {{ $barang->jenisBarang->id == $jenisBarang->id ? 'selected' : '' }}>{{ $jenisBarang->jenis_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_akl_akd" class="form-label">No AKL/AKD</label>
                                        <input type="text" name="no_akl_akd" class="form-control" id="no_akl_akd"
                                               aria-describedby="emailHelp" value="{{ $barang->no_akl_akd }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Merk Barang</label>
                                        <select class="form-control js-example-basic-single" name="merk_barang_id" id="merk_barang">
                                            <option>Pilih Merk Barang</option>
                                            @foreach ($merk_barangs as $merkBarang)
                                                <option value="{{ $merkBarang->id }}" {{ $barang->merkBarang->id == $merkBarang->id ? 'selected' : '' }} >{{ $merkBarang->merk_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tahun Pengadaan</label>
                                        <input type="text" name="tahun_pengadaan" class="form-control" id="tahun_pengadaan"
                                               aria-describedby="emailHelp" <input type="text" name="tahun_pengadaan" value="{{ date('m/d/Y', strtotime($barang->tahun_pengadaan)) }}">
                                    </div>
                                </div>
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label for="kondisi_barang" class="form-label">Kondisi Barang</label>--}}
{{--                                        <select class="form-control js-example-basic-single" name="kondisi_barang_id"--}}
{{--                                                id="kondisi_barang">--}}
{{--                                            <option>Pilih Kondisi Barang</option>--}}
{{--                                            @foreach ($kondisi_barangs as $kondisiBarang)--}}
{{--                                                <option value="{{ $kondisiBarang->id }}" {{ $barang->kondisiBarang->id == $kondisiBarang->id ? 'selected' : '' }}>{{ $kondisiBarang->kondisi_barang }}--}}
{{--                                                </option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sumber_pengadaan" class="form-label">Sumber Pengadaan</label>
                                        <select class="form-control js-example-basic-single" name="sumber_pengadaan_id"
                                                id="sumber_pengadaan">
                                            <option>Pilih Sumber Pengadaan</option>
                                            @foreach ($sumber_pengadaans as $sumberPengadaan)
                                                <option value="{{ $sumberPengadaan->id }}" {{ $barang->sumberPengadaan->id == $sumberPengadaan->id ? 'selected' : '' }} >{{ $sumberPengadaan->sumber_pengadaan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga Barang</label>
                                        <input type="number" name="harga" class="form-control" id="harga"
                                               aria-describedby="emailHelp" value="{{ $barang->harga }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{ $barang->keterangan }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Foto Barang</label>
                                <input type="file" name="photo" class="form-control" id="photo">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control" id="kode_barang" value="{{ $barang->kode_barang }}" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("form").submit(function(e) {
                var namaBarang = $("input[name='nama_barang']").val();
                var unitKerjaId = $("select[name='unit_kerja_id']").val();
                var jenisBarangId = $("select[name='jenis_barang_id']").val();
                var merkBarangId = $("select[name='merk_barang_id']").val();
                var tahunPengadaan = $("input[name='tahun_pengadaan']").val();
                // var kondisiBarangId = $("select[name='kondisi_barang_id']").val();
                var harga = $("input[name='harga']").val();
                var sumberPengadaanId = $("select[name='sumber_pengadaan_id']").val();

                if (!namaBarang) {
                    alert('Nama Barang harus diisi!');
                    e.preventDefault();
                } else if (!unitKerjaId || unitKerjaId === 'Pilih unit kerja') {
                    alert('Unit Kerja harus diisi!');
                    e.preventDefault();
                } else if (!jenisBarangId || jenisBarangId === 'Pilih Jenis Barang') {
                    alert('Jenis Barang harus diisi!');
                    e.preventDefault();
                } else if (!merkBarangId || merkBarangId === 'Pilih Merk Barang') {
                    alert('Merk Barang harus diisi!');
                    e.preventDefault();
                } else if (!tahunPengadaan) {
                    alert('Tahun Pengadaan harus diisi!');
                    e.preventDefault();
                }
                // else if (!kondisiBarangId || kondisiBarangId === 'Pilih Kondisi Barang') {
                //     alert('Kondisi Barang harus diisi!');
                //     e.preventDefault();
                // }
                else if (!harga) {
                    alert('Harga harus diisi!');
                    e.preventDefault();
                } else if (!sumberPengadaanId || sumberPengadaanId === 'Pilih Sumber Pengadaan') {
                    alert('Sumber Pengadaan harus diisi!');
                    e.preventDefault();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("select[name='unit_kerja_id']").on('change', function() {
                var unitKerjaId = $(this).val();
                if (unitKerjaId) {
                    $.ajax({
                        url: "{{ url('/barang/count/') }}/" + unitKerjaId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data && data.count !== undefined) {
                                var kodeBarang = 'BRG' + String(data.count).padStart(3, '0');
                                $("input[name='kode_barang']").val(kodeBarang);
                            } else {
                                alert('Error: Invalid data received');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error: ' + textStatus + ' - ' + errorThrown);
                        }
                    });
                } else {
                    alert('Please select a valid Unit Kerja ID');
                }
            });
        });
    </script>
@endsection

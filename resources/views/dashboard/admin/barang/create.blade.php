@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Data Barang</h5>
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
                        <form id="barangForm" action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                        <input type="text" name="nama_barang" class="form-control" id="nama_barang"
                                               aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Unit Kerja</label>
                                        <select class="form-control js-example-basic-single" name="unit_kerja_id" id="unit_kerja">
                                            <option>Pilih unit kerja</option>
                                            @foreach ($unit_kerjas as $unitKerja)
                                                <option value="{{ $unitKerja->id }}">{{ $unitKerja->unit_kerja }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="distributor" class="form-label">Distributor</label>
                                        <input type="text" name="distributor" class="form-control" id="distributor"
                                               aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jenis_barang" class="form-label">Jenis Barang</label>
                                        <select class="form-control js-example-basic-single" name="jenis_barang_id"
                                                id="jenis_barang">
                                            <option>Pilih Jenis Barang</option>
                                            @foreach ($jenis_barangs as $jenisBarang)
                                                <option value="{{ $jenisBarang->id }}">{{ $jenisBarang->jenis_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_akl_akd" class="form-label">No AKL/AKD</label>
                                        <input type="text" name="no_akl_akd" class="form-control" id="no_akl_akd"
                                               aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Merk Barang</label>
                                        <select class="form-control js-example-basic-single" name="merk_barang_id" id="merk_barang">
                                            <option>Pilih Merk Barang</option>
                                            @foreach ($merk_barangs as $merkBarang)
                                                <option value="{{ $merkBarang->id }}">{{ $merkBarang->merk_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tahun Pengadaan</label>
                                        <input type="text" name="tahun_pengadaan" class="form-control" id="tahun_pengadaan"
                                               aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kondisi_barang" class="form-label">Kondisi Barang</label>
                                        <select class="form-control js-example-basic-single" name="kondisi_barang_id"
                                                id="kondisi_barang">
                                            <option>Pilih Kondisi Barang</option>
                                            @foreach ($kondisi_barangs as $kondisiBarang)
                                                <option value="{{ $kondisiBarang->id }}">{{ $kondisiBarang->kondisi_barang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formatted_harga" class="form-label">Harga</label>
                                        <input type="text" id="formatted_harga" class="form-control" placeholder="Masukkan harga">
                                        <input type="hidden" name="harga" id="harga">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sumber_pengadaan" class="form-label">Sumber Pengadaan</label>
                                        <select class="form-control js-example-basic-single" name="sumber_pengadaan_id"
                                                id="sumber_pengadaan">
                                            <option>Pilih Sumber Pengadaan</option>
                                            @foreach ($sumber_pengadaans as $sumberPengadaan)
                                                <option value="{{ $sumberPengadaan->id }}">{{ $sumberPengadaan->sumber_pengadaan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tahun_pengadaan" class="form-label">Tahun Pengadaan</label>
                                        <select name="tahun_pengadaan_kode" class="form-control" id="tahun_pengadaan">
                                            @for ($year = date('Y'); $year >= 2000; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Foto Barang</label>
                                <input type="file" name="photo" class="form-control" id="photo">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control" id="kode_barang" value="" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                showCancelButton: true,
                confirmButtonText: "Tambah barang lagi!",
                cancelButtonText: "Kembali ke Tabel Barang"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Do nothing, stay on the same page
                } else {
                    window.location.href = "{{ route('barang.index') }}";
                }
            });
        </script>
    @endif


    <script>
        $(document).ready(function() {
            function formatNumberWithCommas(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            $('#formatted_harga').on('input', function() {
                var rawValue = $(this).val().replace(/[^0-9]/g, '');
                $('#harga').val(rawValue);
                $(this).val(formatNumberWithCommas(rawValue));
            });

            $("#barangForm").submit(function(e) {
                var namaBarang = $("input[name='nama_barang']").val();
                var unitKerjaId = $("select[name='unit_kerja_id']").val();
                var jenisBarangId = $("select[name='jenis_barang_id']").val();
                var merkBarangId = $("select[name='merk_barang_id']").val();
                var tahunPengadaan = $("input[name='tahun_pengadaan']").val();
                var kondisiBarangId = $("select[name='kondisi_barang_id']").val();
                var harga = $("input[name='harga']").val();
                var sumberPengadaanId = $("select[name='sumber_pengadaan_id']").val();
                var photo = $("input[name='photo']").val();

                if (!namaBarang) {
                    alert('Nama barang tidak boleh kosong');
                    e.preventDefault();
                } else if (!unitKerjaId || unitKerjaId === 'Pilih unit kerja') {
                    alert('Unit kerja tidak boleh kosong');
                    e.preventDefault();
                } else if (!jenisBarangId || jenisBarangId === 'Pilih Jenis Barang') {
                    alert('Jenis barang tidak boleh kosong');
                    e.preventDefault();
                } else if (!merkBarangId || merkBarangId === 'Pilih Merk Barang') {
                    alert('Merk barang tidak boleh kosong');
                    e.preventDefault();
                } else if (!tahunPengadaan) {
                    alert('Tahun pengadaan tidak boleh kosong');
                    e.preventDefault();
                } else if (!kondisiBarangId || kondisiBarangId === 'Pilih Kondisi Barang') {
                    alert('Kondisi barang tidak boleh kosong');
                    e.preventDefault();
                } else if (!harga) {
                    alert('Harga tidak boleh kosong');
                    e.preventDefault();
                } else if (!sumberPengadaanId || sumberPengadaanId === 'Pilih Sumber Pengadaan') {
                    alert('Sumber pengadaan tidak boleh kosong');
                    e.preventDefault();
                } else if (!photo) {
                    alert('Photo tidak boleh kosong');
                    e.preventDefault();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            function fetchKodeBarang() {
                var unitKerjaId = $("select[name='unit_kerja_id']").val();
                var jenisBarangId = $("select[name='jenis_barang_id']").val();
                var tahunPengadaanKode = $("select[name='tahun_pengadaan_kode']").val();
                if (unitKerjaId && jenisBarangId) {
                    $.ajax({
                        url: "{{ url('/barang/kode-barang/') }}/" + unitKerjaId + "/" + jenisBarangId + "/" + tahunPengadaanKode,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data && data.kode_barang !== undefined) {
                                $("input[name='kode_barang']").val(data.kode_barang);
                            }
                            // else {
                            //     alert('Error: ' + data.error);
                            // }
                        },
                        // error: function(jqXHR, textStatus, errorThrown) {
                        //     alert('Error: ' + textStatus + ' - ' + errorThrown);
                        // }
                    });
                }
            }

            $("select[name='unit_kerja_id'], select[name='jenis_barang_id'], select[name='tahun_pengadaan_kode']").on('change', fetchKodeBarang);
        });
    </script>
@endsection

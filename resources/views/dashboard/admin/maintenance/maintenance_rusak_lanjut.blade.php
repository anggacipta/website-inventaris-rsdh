@extends('dashboard.admin.layouts.main')
<style>
    .spinner {
        border: 4px solid rgba(0, 0, 0, 0.1);
        width: 24px;
        height: 24px;
        border-left-color: #7983ff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        display: none;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Barang Rusak</h5>
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
                        <form id="maintenanceForm" action="{{ route('maintenance.rusak.update.lanjutan', $maintenance->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="barangId" name="barang_id" value="{{ $maintenance->barang_id }}">
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Catatan</label>
                                <textarea class="form-control" name="catatan" id="keterangan" rows="6" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="biaya" class="form-label">Biaya Maintenance / Vendor(dapat diubah apabila ada pergantian harga)</label>
                                <input type="text" id="formatted_harga" class="form-control" required value="{{ $maintenance->harga }}">
                                <input type="hidden" name="harga" id="harga" value="{{ $maintenance->harga }}">
                            </div>
                            <div class="mb-3">
                                <label for="kondisi_barang" class="form-label">Kondisi barang</label>
                                <select name="kondisi_barang_id" class="form-select" id="kondisi_barang">
                                    <option value="{{ $kondisiBarang->id }}">{{ $kondisiBarang->kondisi_barang }}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <div class="spinner" id="spinner"></div>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>

        <script>
            // Add this JavaScript to your blade template or a separate JS file
            document.getElementById('maintenanceForm').addEventListener('submit', function() {
                document.getElementById('spinner').style.display = 'inline-block';
                this.querySelector('button[type="submit"]').disabled = true;
            });
        </script>

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
            });
        </script>
@endsection

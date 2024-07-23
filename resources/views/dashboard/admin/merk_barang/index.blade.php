@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div>
                <!-- ------------------------------------------ -->
                <!-- Medium -->
                <!-- ------------------------------------------ -->
                <button class="btn me-1 mb-4 bg-primary text-white px-4 fs-4 " style="float: right" data-bs-toggle="modal" data-bs-target="#bs-example-modal-md">
                    Tambah Data
                </button>
                <!-- sample modal content -->
                <div id="bs-example-modal-md" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center">
                                <h4 class="modal-title" id="myModalLabel">
                                    Tambah Data
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('merk-barang.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Merk Barang</label>
                                        <input type="text" name="merk_barang" class="form-control" id="nama" aria-describedby="emailHelp">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-danger-subtle text-danger  waves-effect" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
            <div class="clearfix"></div> <!-- for spacing -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Merk Barang</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($merks as $merk)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $merk->merk_barang }}</td>
                        <td>
                            <a href="{{ route('merk-barang.edit', $merk->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('merk-barang.destroy', $merk->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

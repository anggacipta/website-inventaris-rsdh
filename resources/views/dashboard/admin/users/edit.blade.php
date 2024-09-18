@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Users</h5>
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
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="number" name="phone" class="form-control" id="phone" value="{{ $user->phone }}">
                            </div>

                            <div class="mb-3">
                                <label for="unit_kerja_id" class="form-label">Unit Kerja</label>
                                <select class="form-control js-example-basic-single" name="unit_kerja_id" id="unit_kerja_id">
                                    <option value="">Pilih Unit Kerja</option>
                                    @foreach ($unitKerjas as $unitKerja)
                                        <option value="{{ $unitKerja->id }}" {{ $user->unitKerja->id == $unitKerja->id ? 'selected' : '' }}>{{ $unitKerja->unit_kerja }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('unit_kerja_id'))
                                    <div class="error">{{ $errors->first('unit_kerja_id') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="role_id" class="form-label">Roles</label>
                                <select class="form-control js-example-basic-single" name="role_id" id="role_id">
                                    <option value="">Pilih Roles</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                    <div class="error">{{ $errors->first('role_id') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password (kosongkan saja apabila tidak ingin mengganti password):</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                            </div>

                            <button type="submit" class="btn btn-primary">Edit User</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>
@endsection


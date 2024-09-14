@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Data Users</h5>
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
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama:</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username(untuk masuk website):</label>
                                    <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                                    @if ($errors->has('username'))
                                        <div class="error">{{ $errors->first('username') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password(minimal 8 karakter):</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password:</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Roles</label>
                                    <select class="form-control js-example-basic-single" name="role_id" id="role_id">
                                        <option value="">Pilih Roles</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role_id'))
                                        <div class="error">{{ $errors->first('role_id') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="unit_kerja_id" class="form-label">Unit Kerja</label>
                                    <select class="form-control js-example-basic-single" name="unit_kerja_id" id="unit_kerja_id">
                                        <option value="">Pilih Unit Kerja</option>
                                        @foreach ($unitKerjas as $unit)
                                            <option value="{{ $unit->id }}" {{ old('unit_kerja_id') == $unit->id ? 'selected' : '' }}>{{ $unit->unit_kerja }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('unit_kerja_id'))
                                        <div class="error">{{ $errors->first('unit_kerja_id') }}</div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Create User</button>
                            </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>
@endsection

@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <h2>User Details</h2>
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>{{ $user->password }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $user->role->name }}</td>
                </tr>
                <tr>
                    <th>Unit Kerja</th>
                    <td>{{ $user->unitKerja->unit_kerja }}</td>
                </tr>
            </table>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Back to Users List</a>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection

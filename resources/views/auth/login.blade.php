<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Add CSS and JS as needed -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/LOGO_RS.png') }}" />

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('assets/toastr-js/build/toastr.min.css') }}">

    {{--  Bootstrap  --}}
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
</head>
<body>
<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="{{ asset('assets/images/logos/LOGO_RS.png') }}" width="100" height="100" alt="">
                        </a>
                        <p class="text-center">Website Inventaris</p>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="username">
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                            </div>
                            <button type="submit" class="btn btn-success w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>

{{-- Toastr --}}
<script type="text/javascript" src="{{ asset('assets/toastr-js/build/toastr.min.js') }}"></script>
<script>
    @if (session('success'))
    toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
    toastr.error("{{ session('error') }}");
    @endif

    @if (session('info'))
    toastr.info("{{ session('info') }}");
    @endif

    @if (session('warning'))
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
</html>

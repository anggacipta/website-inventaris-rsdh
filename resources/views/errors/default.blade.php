<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error tidak ditemukan</title>

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />

</head>
<body>
<div id="main-wrapper">
    <div class="position-relative overflow-hidden min-vh-100 w-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-lg-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/errors/default_error.webp') }}" alt="modernize-img" class="img-fluid" width="500" height="300">
                        <h1 class="fw-semibold mb-7 fs-9">Error tidak ditemukan!!!</h1>
                        <h4 class="fw-semibold mb-7">Silahkan kembali ke halaman sebelumnya</h4>
                        <a class="btn btn-primary" href="{{ route('login') }}" role="button">Halaman Sebelumnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

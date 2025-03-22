<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - SB Admin 2</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('asset') }}/dist/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('asset') }}/dist/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                        </div>
                        @if (session('success'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Logout Berhasil!',
                                        text: '{{ session('success') }}',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                });
                            </script>
                        @endif

                        <form class="user" action="{{ route('login') }}" method="POST">
                            @csrf

                            <!-- Alert umum di atas form -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Input Username -->
                            <div class="form-group">
                                <input type="text"
                                    class="form-control form-control-user @error('user_nama') is-invalid @enderror"
                                    id="user_nama" name="user_nama" placeholder="Enter Username"
                                    value="{{ old('user_nama') }}">
                                @error('user_nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Input Password -->
                            <div class="form-group">
                                <input type="password"
                                    class="form-control form-control-user @error('user_pass') is-invalid @enderror"
                                    id="user_pass" name="user_pass" placeholder="Enter Password">
                                @error('user_pass')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button class="btn btn-primary btn-user btn-block mt-3" type="submit">Login</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('asset') }}/dist/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ asset('asset') }}/dist/js/sb-admin-2.min.js"></script>
    <!-- CSS SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- JavaScript SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Logout Berhasil.',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
</body>

</html>

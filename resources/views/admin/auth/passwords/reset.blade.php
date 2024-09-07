<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('AdminAsset/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAsset/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('AdminAsset/assets/modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('AdminAsset/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAsset/assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>>
<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header"><h4>Admin Reset Password</h4></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ url('admin/reset-password/' . $token) . '?email=' . urlencode($email) }}">Reset Password</a>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
     <!-- General JS Scripts -->
     <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
     <script src="{{ asset('assets/modules/popper.js') }}"></script>
     <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
     <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
     <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
     <script src="{{ asset('assets/js/stisla.js') }}"></script>

     <!-- JS Libraies -->

     <!-- Page Specific JS File -->

     <!-- Template JS File -->
     <script src="{{ asset('assets/js/scripts.js') }}"></script>
     <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>

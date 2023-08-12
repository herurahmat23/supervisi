<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI ATAN - Login</title>

    <link rel="shortcut icon" href="<?= base_url('assets/') ?>dist/img/siatan_logo.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
            background: url('<?php echo base_url() ?>/assets/dist/img/bg.jpg');
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            width: 100%;
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;

        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-lightblue">
            <div class="card-header text-center">
                <img src="<?= base_url('assets/') ?>dist/img/siatan_logo.png" alt="SI ATAN  Logo" class="brand-image elevation-0  " style="opacity: .8" width="100">
                <a class="h1"><b>SI ATAN</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="" id="form-login" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username / NIK">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
        });
        $(document).ready(function() {
            $(document).on('submit', '#form-login', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?= site_url('Login/login') ?>',
                    type: 'POST',
                    data: new FormData(this),
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.status == "fail") {
                            Toast.fire({
                                icon: 'error',
                                title: data.message
                            });
                        } else {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            window.location.href = '<?php echo base_url("Dashboard"); ?>';
                        }
                    }

                });
            });
        });
    </script>

    <?php if ($this->session->flashdata('need_login')) { ?>
        <script type="text/javascript">
            $(function() {
                swal.fire({
                    title: 'Perhatian',
                    text: 'Anda Harus Login Terlebih Dahulu!',
                    icon: 'warning',
                    confirmButtonClass: 'btn btn-primary',
                });
            });
        </script>
    <?php } ?>
</body>

</html>
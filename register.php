<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kantor Urusan Agama Kec. Banjarmasin Timur | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="assets/dist/img/Logo-KUA.png" type="image/x-icon">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">
    <!-- sweetalert -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2/sweetalert2.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="#">
                <b>SIA</b> Kantor Urusan Agama <br>
                Kec. Banjarmasin Timur
            </a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            <div class="form-group has-feedback">
                <input id="txt_nik" type="text" class="form-control" placeholder="N.I.K" maxlength="16">
                <span class="fa fa-id-card form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="txt_nama" type="text" class="form-control" placeholder="Full name">
                <span class="fa fa-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="txt_email" type="email" class="form-control" placeholder="Email">
                <span class="fa fa-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="txt_pwd" type="password" class="form-control" placeholder="Password">
                <span class="fa fa-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="txt_alamat" type="text" class="form-control" placeholder="Alamat Lengkap">
                <span class="fa fa-home form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="txt_job" type="text" class="form-control" placeholder="Pekerjaan">
                <span class="fa fa-briefcase form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button id="btn_submit" type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>

            <div class="social-auth-links text-center">

            </div>

            <a href="index" class="text-center">Sudah Punya Akun? Silahkan Masuk</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery 3 -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- sweetalert -->
    <script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $("#btn_submit").click(function() {
                var nama = $("#txt_nama").val().trim();
                var password = $("#txt_pwd").val().trim();
                var email = $("#txt_email").val().trim();
                var alamat = $("#txt_alamat").val().trim();
                var job = $("#txt_job").val().trim();
                var nik = $("#txt_nik").val().trim();
                if (nama != "" && password != "") {
                    $.ajax({
                        url: 'scripts/registrasi.php',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            nama: nama,
                            email: email,
                            nik: nik,
                            job: job,
                            alamat: alamat,
                            password: password
                        },
                        success: function(response) {
                            if (response.info == 1) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Yee! ' + response.messages
                                })
                                setTimeout(function() {
                                    window.location.href = 'dashboard';
                                }, 1500);
                            } else if (response.info == 0) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Noo! ' + response.messages
                                })
                            }
                        }
                    });
                } else {
                    Toast.fire({
                        icon: 'warning',
                        title: ' Form Tidak Boleh Kosong'
                    })
                }
            });
        });
    </script>
</body>

</html>
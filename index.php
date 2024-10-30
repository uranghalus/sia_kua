<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kantor Urusan Agama Kec. Banjarmasin Timur | Log in</title>
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
    <!-- sweetalert -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2/sweetalert2.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- pppp -->

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="">
                <b>SIA</b> Kantor Urusan Agama <br>
                Kec. Banjarmasin Timur
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <div class="form-group has-feedback">
                <input id="txt_username" type="text" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="txt_pwd" type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4 offset-xs-8">
                    <button id="btn_submit" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
            <a href="register" class="text-center">Registrasi Untuk Masuk</a>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
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
                var username = $("#txt_username").val().trim();
                var password = $("#txt_pwd").val().trim();
                if (username != "" && password != "") {
                    $.ajax({
                        url: 'scripts/cek-login.php',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            username: username,
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
    <!-- Bootstrap 3.3.7 -->
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="assets/plugins/iCheck/icheck.min.js"></script>
</body>

</html>
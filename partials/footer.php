<!-- REQUIRED JS SCRIPTS -->
<?php if ($file != "XCRUD") { ?>
    <!-- jQuery 3 -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<?php } ?>

<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- bootstrap datepicker -->
<!-- <script src="assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<!-- DataTables -->
<script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- sweetalert -->
<script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('.data-inbox').load("scripts/data-inbox.php");
        $('.data-outbox').load("scripts/data-outbox.php");
        var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });
        $("#btn_kirim").click(function() {
            var penerima = $("#penerima").val();
            var judul = $("#judul").val();
            var pesan = $("#pesan").val();
            if (judul != '' && pesan != '') {
                $.ajax({
                    url: "scripts/kirim-pesan.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        penerima: penerima,
                        judul: judul,
                        pesan: pesan,
                    },
                    success: function(response) {
                        if (response.info == 1) {
                            Toast.fire({
                                icon: "success",
                                title: "Yee! " + response.messages,
                            });
                            setTimeout(function() {
                                window.location.href = "dashboard?pages=pesan-keluar";
                            }, 1500);
                        } else if (response.info == 0) {
                            Toast.fire({
                                icon: "error",
                                title: "Noo! " + response.messages,
                            });
                        }
                    },
                });
            } else {
                Toast.fire({
                    icon: "warning",
                    title: " Form Tidak Boleh Kosong",
                });
            }
        });
    });
    $(function() {
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
        $("#pesan").wysihtml5();
    })
    //Date picker
    $('#tgl-mulai').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    })
    //Date picker
    $('#tgl-selesai').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    })
</script>
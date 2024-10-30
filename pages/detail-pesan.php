<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_pesan 
        INNER JOIN user_detail ON user_detail.nik=tbl_pesan.id_penerima
        WHERE tbl_pesan.id_k='$id' AND
        tbl_pesan.jenis='KELUAR' 
        ORDER BY id_k DESC";
$query = $connectdb->query($sql);
$data = $query->fetch_assoc();
?>
<div class="row">
    <!-- Main Header -->
    <?php include 'partials/sidebar-konsultasi.php' ?>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Baca Pesan</h3>

                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="mailbox-read-info">
                    <h3><?= $data['judul_pesan'] ?></h3>
                    <h5>To: <?= $data['nama'] ?>
                        <span class="mailbox-read-time pull-right"><?= $data['tgl_pesan'] ?></span>
                    </h5>
                </div>
                <!-- /.mailbox-read-info -->
                <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                            <i class="fa fa-trash-o"></i></button>
                    </div>
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                        <i class="fa fa-print"></i></button>
                </div>
                <!-- /.mailbox-controls -->
                <div class="mailbox-read-message">
                    <?= $data['pesan'] ?>
                </div>
                <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
            <div class="box-footer">
                <div class="pull-right">
                    <!-- <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button> -->
                    <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
                </div>
                <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                <!-- <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button> -->
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>
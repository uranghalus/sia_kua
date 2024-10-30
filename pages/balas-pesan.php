<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_pesan 
        INNER JOIN user_detail ON user_detail.nik=tbl_pesan.nama_pengirim
        WHERE tbl_pesan.id_k='$id'
        ORDER BY id_k DESC";
$query = $connectdb->query($sql);
$data = $query->fetch_assoc();
?>
<div class="row">
    <?php include 'partials/sidebar-konsultasi.php' ?>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Balas Pesan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <input type="hidden" id="penerima" name="penerima" value="<?= $data['nama_pengirim'] ?>">
                <div class="form-group">
                    <input class="form-control" value="<?= $data['nama'] ?>" readonly>
                </div>
                <div class="form-group">
                    <input class="form-control" id="judul" name="judul" value="Re: <?= $data['judul_pesan'] ?>" readonly>
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="pesan" name="pesan" style="height: 300px">

                    </textarea>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" id="btn_kirim" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                </div>
                <button type="reset" id="btn_batal" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>
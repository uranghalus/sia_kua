<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';



?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $page ?></h3>

            </div>
            <div class="box-body">
                <form method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Dari Tanggal:</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" name="t_a" class="form-control pull-right" id="datepicker">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sampai Tanggal:</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" name="t_b" class="form-control pull-right" id="datepicker2">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" name="tampilkan" class="btn btn-primary btn-block" value="Lihat">
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<?php if (isset($_POST["tampilkan"])) : ?>
    <?php
    $tanggala = date('Y-m-d', strtotime($_POST["t_a"]));
    $tanggalb = date('Y-m-d', strtotime($_POST["t_b"]));
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="col-xs-11">
                        <h3 class="box-title">Rekap Laporan</h3>
                    </div>
                    <div class="col-xs-1">
                        <a href="scripts/lap-daftar-nikah?ta=<?= $tanggala ?>&tb=<?= $tanggalb ?>" class="btn btn-default"><i class="fa fa-print"></i> Cetak</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><b>No.</b></th>
                                        <th><b>Nama Calon Suami</b></th>
                                        <th><b>NIK Suami</b></th>
                                        <th><b>Nama Calon Istri</b></th>
                                        <th><b>NIK Istri</b></th>
                                        <th><b>Id Pendaftaran</b></th>
                                        <th><b>Tanggal Pendaftaran</b></th>
                                        <th><b>Tanggal Nikah</b></th>
                                        <th><b>Status</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    $sql = "SELECT * FROM tbl_daftar_nikah WHERE tanggal_daftar BETWEEN '$tanggala' and '$tanggalb'";
                                    $query = mysqli_query($connectdb, $sql);
                                    ?>
                                    <?php if ($query) : ?>
                                        <?php while ($data = $query->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data['nama_calsu'] ?></td>
                                                <td><?php echo $data['nik_calsu'] ?></td>
                                                <td><?php echo $data['nama_calis'] ?></td>
                                                <td><?php echo $data['nik_calis'] ?></td>
                                                <td><?php echo $data['id_daftar'] ?></td>
                                                <td><?php echo $data['tanggal_daftar'] ?></td>
                                                <td><?php echo $data['tanggal_nikah_m'] ?></td>
                                                <td><?php echo $data['status'] ?></td>
                                            </tr>
                                        <?php $no++;
                                        endwhile ?>
                                    <?php else : $msg = mysqli_error_list($connectdb);
                                        echo json_encode($msg); ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
<?php endif ?>
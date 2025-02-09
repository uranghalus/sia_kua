<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan Jadwal Pernikahan</h3>
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
                                <input type="date" name="t_a" class="form-control pull-right">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sampai Tanggal:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" name="t_b" class="form-control pull-right">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" name="tampilkan" class="btn btn-primary btn-block" value="Lihat">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_POST["tampilkan"])) : ?>
    <?php
    // Ambil tanggal dari input form
    $tanggala = date('Y-m-d', strtotime($_POST["t_a"]));
    $tanggalb = date('Y-m-d', strtotime($_POST["t_b"]));

    // Query data dari database
    $sql = "
        SELECT 
            jd.id_jadwal AS no,
            dn.id_daftar AS id_pendaftaran,
            CONCAT(dn.nama_calsu, ' & ', dn.nama_calis) AS nama_catin,
            jd.tgl_nikah AS tanggal_nikah,
            jd.tempat_nikah AS tempat_nikah,
            ph.nama_penghulu AS penghulu
        FROM 
            tbl_jadwal jd
        JOIN 
            tbl_daftar_nikah dn ON jd.id_daftar_nikah = dn.id_daftar
        JOIN 
            tbl_penghulu ph ON jd.id_penghulu = ph.Nip
        WHERE 
            jd.tgl_nikah BETWEEN '$tanggala' AND '$tanggalb'
        ORDER BY 
            jd.tgl_nikah ASC
    ";
    $query = mysqli_query($connectdb, $sql);
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="col-xs-11">
                        <h3 class="box-title">Rekap Laporan Jadwal Nikah</h3>
                    </div>
                    <div class="col-xs-1">
                        <a href="scripts/lap-jadwal?ta=<?= $tanggala ?>&tb=<?= $tanggalb ?>" class="btn btn-default"><i class="fa fa-print"></i> Cetak</a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><b>No.</b></th>
                                <th><b>Id Pendaftaran</b></th>
                                <th><b>Nama Catin</b></th>
                                <th><b>Tanggal Nikah</b></th>
                                <th><b>Tempat Nikah</b></th>
                                <th><b>Penghulu</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($query && mysqli_num_rows($query) > 0) : ?>
                                <?php $no = 1; ?>
                                <?php while ($data = $query->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['id_pendaftaran'] ?></td>
                                        <td><?= $data['nama_catin'] ?></td>
                                        <td><?= $data['tanggal_nikah'] ?></td>
                                        <td><?= $data['tempat_nikah'] ?></td>
                                        <td><?= $data['penghulu'] ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
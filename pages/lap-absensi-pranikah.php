<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan Absensi Pranikah</h3>
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
                                <input type="date" name="t_a" class="form-control pull-right" required>
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
                                <input type="date" name="t_b" class="form-control pull-right" required>
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

    // Query data absensi pranikah
    $sql = "
        SELECT 
            ps.id_peserta AS no,
            dn.nama_calsu AS nama_suami,
            dn.nama_calis AS nama_istri,
            sb.nama_sesi AS nama_sesi,
            sb.tanggal AS tanggal_sesi,
            ps.status_kehadiran AS status_kehadiran,
            ps.sertifikat AS sertifikat
        FROM 
            peserta_sesi ps
        JOIN 
            peserta_bimbingan pb ON ps.id_peserta = pb.id_peserta
        JOIN 
            sesi_bimbingan sb ON ps.id_sesi = sb.id_sesi
        JOIN 
            tbl_daftar_nikah dn ON pb.id_daftar = dn.id_daftar
        WHERE 
            sb.tanggal BETWEEN '$tanggala' AND '$tanggalb'
        ORDER BY 
            sb.tanggal ASC
    ";
    $query = mysqli_query($connectdb, $sql);
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="col-xs-11">
                        <h3 class="box-title">Rekap Laporan Absensi Pranikah</h3>
                    </div>
                    <div class="col-xs-1">
                        <a href="scripts/lap-absensi?ta=<?= $tanggala ?>&tb=<?= $tanggalb ?>" class="btn btn-default"><i class="fa fa-print"></i> Cetak</a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><b>No.</b></th>
                                <th><b>Nama Suami</b></th>
                                <th><b>Nama Istri</b></th>
                                <th><b>Nama Sesi</b></th>
                                <th><b>Tanggal Sesi</b></th>
                                <th><b>Status Kehadiran</b></th>
                                <th><b>Sertifikat</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($query && mysqli_num_rows($query) > 0) : ?>
                                <?php $no = 1; ?>
                                <?php while ($data = $query->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['nama_suami'] ?></td>
                                        <td><?= $data['nama_istri'] ?></td>
                                        <td><?= $data['nama_sesi'] ?></td>
                                        <td><?= $data['tanggal_sesi'] ?></td>
                                        <td><?= $data['status_kehadiran'] ?></td>
                                        <td><?= $data['sertifikat'] ? 'Ya' : 'Tidak' ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
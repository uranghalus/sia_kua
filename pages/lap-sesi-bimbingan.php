<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan Sesi dan Materi Bimbingan</h3>
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

    // Query data sesi dan materi bimbingan
    $sql = "
        SELECT 
            sb.nama_sesi AS sesi,
            sb.tanggal AS tanggal_sesi,
            sb.waktu AS waktu_sesi,
            sb.lokasi AS lokasi,
            mb.judul_materi AS materi,
            mb.deskripsi AS deskripsi
        FROM 
            sesi_bimbingan sb
        LEFT JOIN 
            materi_bimbingan mb ON sb.id_sesi = mb.id_sesi
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
                        <h3 class="box-title">Rekap Laporan Sesi dan Materi Bimbingan</h3>
                    </div>
                    <div class="col-xs-1">
                        <a href="scripts/lap-bimbingan?ta=<?= $tanggala ?>&tb=<?= $tanggalb ?>" class="btn btn-default"><i class="fa fa-print"></i> Cetak</a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Sesi</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Lokasi</th>
                                <th>Materi</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($query && mysqli_num_rows($query) > 0) : ?>
                                <?php $no = 1; ?>
                                <?php while ($data = $query->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($data['sesi']); ?></td>
                                        <td><?= htmlspecialchars($data['tanggal_sesi']); ?></td>
                                        <td><?= htmlspecialchars($data['waktu_sesi']); ?></td>
                                        <td><?= htmlspecialchars($data['lokasi']); ?></td>
                                        <td><?= htmlspecialchars($data['materi']); ?></td>
                                        <td><?= htmlspecialchars($data['deskripsi']); ?></td>
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
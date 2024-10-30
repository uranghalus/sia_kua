<?php
define('BASEPATH', true);
if (!session_id()) @session_start();
include "../config/connection.php";
$nik = $_SESSION['user-data']['nik'];
$no = 1;
$sql = "SELECT * FROM tbl_pesan 
        INNER JOIN user_detail ON user_detail.nik=tbl_pesan.id_penerima
        WHERE tbl_pesan.nama_pengirim='$nik' AND
        tbl_pesan.jenis='KELUAR' 
        ORDER BY id_k DESC";
$query = $connectdb->query($sql);
$count = $query->num_rows;
?>
<table class="table table-hover table-striped">
    <tbody>
        <?php if ($count > 0) : ?>
            <?php while ($data = $query->fetch_array()) : ?>
                <tr>
                    <td class="mailbox-name"><a href="dashboard?pages=detail-pesan-keluar&id=<?= $data['id_k'] ?>"><?= $data['nama'] ?></a></td>
                    <td class="mailbox-subject"><b><?= $data['judul_pesan'] ?></b> - <?= substr($data['pesan'], 0, 7) . '...'  ?>
                    </td>
                    <td class="mailbox-date"><?= $data['tgl_pesan'] ?></td>
                </tr>
            <?php endwhile ?>
        <?php else : ?>
            <tr>
                <td colspan='4'>Tidak ada data pesan masuk</td>
            </tr>
        <?php endif ?>

    </tbody>
</table>
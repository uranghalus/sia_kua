<?php
define('BASEPATH', true);
include "../config/connection.php"; // Sesuaikan dengan lokasi file koneksi
include "../config/fungsi.php"; // Fungsi tambahan (jika diperlukan)

// Load library mPDF
require '../vendor/autoload.php';

use Mpdf\Mpdf;

// Query data dari database
$sql = "
    SELECT 
        mb.judul_materi,
        mb.deskripsi AS deskripsi_materi,
        sb.nama_sesi,
        sb.tanggal,
        sb.waktu,
        sb.lokasi,
        ps.status_kehadiran,
        ps.sertifikat,
        tb.nama_calsu,
        tb.nama_calis,
        tb.tanggal_nikah_m
    FROM materi_bimbingan mb
    INNER JOIN sesi_bimbingan sb ON mb.id_sesi = sb.id_sesi
    INNER JOIN peserta_sesi ps ON sb.id_sesi = ps.id_sesi
    INNER JOIN peserta_bimbingan pb ON ps.id_peserta = pb.id_peserta
    INNER JOIN tbl_daftar_nikah tb ON pb.id_daftar = tb.id_daftar
";
$query = $connectdb->query($sql);

// Nama dokumen PDF
$nama_dokumen = 'Rekap Laporan Bimbingan ' . date('Y-m-d');

// Inisialisasi MPDF
$mpdf = new Mpdf();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan Bimbingan</title>
    <style>
        @page {
            margin: 2cm;
        }

        body {
            font-family: sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
        }

        .header h1 {
            margin: 0;
            font-size: 16pt;
        }

        .header p {
            margin: 0;
            font-size: 10pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <table width="100%" style="font-family: sans-serif; border-bottom: 1px solid #000;">
        <tr>
            <td width="30%"><img src="../assets/dist/img/Logo-KUA.png" width="128" alt=""></td>
            <td width="70%" style="text-align: center;">
                <span style="font-weight: bold; font-size: 14pt;">
                    KEMENTERIAN AGAMA REPUBLIK INDONESIA
                </span>
                <br>
                <span style="font-weight: bold; font-size: 14pt;">
                    KANTOR URUSAN AGAMA
                </span>
                <br>
                <p>
                    Alamat: Jl. Pramuka Ray Melati Indah 8 No.1, RT.10, Sungai Lulut, Kec. Banjarmasin Timur Kota Banjarmasin
                </p>
            </td>
        </tr>
    </table>

    <h3 style="text-align: center;">Rekap Laporan Bimbingan</h3>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul Materi</th>
                <th>Sesi</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Status Kehadiran</th>
                <th>Sertifikat</th>
                <th>Calon Suami</th>
                <th>Calon Istri</th>
                <th>Tanggal Nikah</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($data = $query->fetch_assoc()) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($data['judul_materi']); ?></td>
                    <td><?= htmlspecialchars($data['nama_sesi']); ?></td>
                    <td><?= htmlspecialchars($data['tanggal']); ?> <?= htmlspecialchars($data['waktu']); ?></td>
                    <td><?= htmlspecialchars($data['lokasi']); ?></td>
                    <td><?= htmlspecialchars($data['status_kehadiran']); ?></td>
                    <td><?= $data['sertifikat'] ? 'Ya' : 'Tidak'; ?></td>
                    <td><?= htmlspecialchars($data['nama_calsu']); ?></td>
                    <td><?= htmlspecialchars($data['nama_calis']); ?></td>
                    <td><?= htmlspecialchars($data['tanggal_nikah_m']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="footer">
        Banjarmasin, <?= tanggal_indo(date('Y-m-d')); ?><br><br><br>
        <strong>H. Syamsuri, S.Ag, M.H.I</strong>
    </div>
</body>

</html>
<?php
// Tangkap output buffer
$html = ob_get_contents();
ob_end_clean();

// Masukkan ke mPDF
$mpdf->WriteHTML($html);

// Output file PDF
$mpdf->Output($nama_dokumen . ".pdf", 'D');
?>
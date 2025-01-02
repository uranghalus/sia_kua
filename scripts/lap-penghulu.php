<?php
define('BASEPATH', true);
include "../config/connection.php"; // Sesuaikan dengan lokasi file koneksi
include "../config/fungsi.php"; // Fungsi tambahan (jika diperlukan)

// Load library mPDF
require '../vendor/autoload.php';

use Mpdf\Mpdf;

// Query data dari database
$sql = "SELECT * FROM tbl_penghulu";
$query = $connectdb->query($sql);

// Nama dokumen PDF
$nama_dokumen = 'Rekap Laporan Penghulu ' . date('Y-m-d');

// Inisialisasi MPDF
$mpdf = new Mpdf();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan Penghulu</title>
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
    <table width="100%" style=" font-family: sans-serif; border-bottom:1px solid #000000; ">
        <tr>
            <td width="30%" style="color:#0000BB; "><img src="../assets/dist/img/Logo-KUA.png" width="128" alt="" srcset=""></td>
            <td width="70%" style="text-align: center;">
                <span style="font-weight: bold; font-size: 14pt;">
                    KEMENTRIAN AGAMA REPUBLIK INDONESIA
                </span>
                <br>
                <span style="font-weight: bold; font-size: 14pt;">
                    KANTOR KEMENTRIAN AGAMA KOTA BANJARMASIN
                </span>
                <span style="font-weight: bold; font-size: 14pt;">
                    KANTOR URUSAN AGAMA KEC. BANJARMASIN TIMUR
                </span>
                <br />
                <p>
                    Jl. Pramuka Ray Melati Indah 8 No.1, RT.10, Sungai Lulut, Kec. Banjarmasin Timur Kota Banjarmasin
                </p>
            </td>
        </tr>
    </table>

    <h3 style="text-align: center;">Rekap Laporan Penghulu</h3>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>NIP</th>
                <th>Nama Penghulu</th>
                <th>Foto</th>
                <th>Alamat</th>
                <th>Telpon</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($data = $query->fetch_assoc()) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($data['Nip']); ?></td>
                    <td><?= htmlspecialchars($data['nama_penghulu']); ?></td>
                    <td><img src="../library/xcrud/uploads/<?= htmlspecialchars($data['foto']); ?>" alt="<?= htmlspecialchars($data['nama_penghulu']); ?>" width="50"></td>
                    <td><?= htmlspecialchars($data['alamat_penghulu']); ?></td>
                    <td><?= htmlspecialchars($data['telpon_penghulu']); ?></td>
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
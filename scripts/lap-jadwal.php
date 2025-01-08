<?php
define('BASEPATH', true);
include "../config/connection.php"; // Sesuaikan dengan lokasi file koneksi
include "../config/fungsi.php"; // Fungsi tambahan (jika diperlukan)

// Load library mPDF
require '../vendor/autoload.php';

use Mpdf\Mpdf;

// Ambil rentang tanggal dari request
$tanggala = isset($_GET['ta']) ? $_GET['ta'] : date('Y-m-d');
$tanggalb = isset($_GET['tb']) ? $_GET['tb'] : date('Y-m-d');

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
$query = $connectdb->query($sql);

// Nama dokumen PDF
$nama_dokumen = 'Rekap Jadwal Pernikahan ' . date('Y-m-d');

// Inisialisasi mPDF
$mpdf = new Mpdf();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Jadwal Pernikahan</title>
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
    <table width="100%" style="font-family: sans-serif; border-bottom:1px solid #000000;">
        <tr>
            <td width="30%"><img src="../assets/dist/img/Logo-KUA.png" width="128"></td>
            <td width="70%" style="text-align: center;">
                <span style="font-weight: bold; font-size: 14pt;">KEMENTRIAN AGAMA REPUBLIK INDONESIA</span><br>
                <span style="font-weight: bold; font-size: 14pt;">KANTOR KEMENTRIAN AGAMA KOTA BANJARMASIN</span><br>
                <span style="font-weight: bold; font-size: 14pt;">KANTOR URUSAN AGAMA KEC. BANJARMASIN TIMUR</span><br>
                <p>Jl. Pramuka Ray Melati Indah 8 No.1, RT.10, Sungai Lulut, Kec. Banjarmasin Timur Kota Banjarmasin</p>
            </td>
        </tr>
    </table>

    <h3 style="text-align: center;">Rekap Jadwal Pernikahan</h3>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Id Pendaftaran</th>
                <th>Nama Catin</th>
                <th>Tanggal Nikah</th>
                <th>Tempat Nikah</th>
                <th>Penghulu</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($data = $query->fetch_assoc()) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($data['id_pendaftaran']); ?></td>
                    <td><?= htmlspecialchars($data['nama_catin']); ?></td>
                    <td><?= htmlspecialchars($data['tanggal_nikah']); ?></td>
                    <td><?= htmlspecialchars($data['tempat_nikah']); ?></td>
                    <td><?= htmlspecialchars($data['penghulu']); ?></td>
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
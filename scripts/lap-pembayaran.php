<?php
define('BASEPATH', true);
include "../config/connection.php";
include "../config/fungsi.php";

// Ambil parameter tanggal dan status dari URL
$tanggala = date('Y-m-d', strtotime($_GET['ta']));
$tanggalb = date('Y-m-d', strtotime($_GET['tb']));
$status = $_GET['st'];

// Query data sesuai permintaan
$sql = "
SELECT 
    a.id_daftar, 
    a.nik_calsu, 
    a.nama_calsu, 
    a.nik_calis, 
    a.nama_calis, 
    a.tanggal_nikah_m, 
    a.tanggal_daftar, 
    b.tanggal, 
    a.status 
FROM tbl_daftar_nikah a 
INNER JOIN tbl_bukti_pembayaran b 
ON a.id_daftar = b.id_registrasi 
WHERE b.tanggal BETWEEN '$tanggala' AND '$tanggalb' 
AND a.status = '$status'";
$query = $connectdb->query($sql);

// Nama dokumen PDF
$nama_dokumen = 'Laporan Status Pembayaran Nikah Periode (' . $tanggala . ' - ' . $tanggalb . ')';

// Load library MPDF
require '../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendaftaran Nikah</title>
    <style>
        @page {
            margin-top: 2.5cm;
            margin-bottom: 2.5cm;
            margin-left: 2cm;
            margin-right: 2cm;
        }

        .data,
        .data th,
        .data td {
            border-collapse: collapse;
            border: 1px solid #363636;
            padding: 8px 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
            font-family: sans-serif;
        }

        .header img {
            width: 128px;
        }
    </style>
</head>

<body>
    <htmlpageheader name="letterheader">
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
        <div style="margin-top: 1cm;">
            <div style="text-align:center;">
                <h4>Laporan Pendaftaran Nikah</h4>
                <h6>Periode <?= $tanggala ?> - <?= $tanggalb ?></h6>
            </div>
        </div>
    </htmlpageheader>
    <style>
        @page {
            margin-top: 2.5cm;
            margin-bottom: 2.5cm;
            margin-left: 2cm;
            margin-right: 2cm;
            footer: html_letterfooter2;
            background-color: white;
        }

        @page :first {
            margin-top: 9cm;
            margin-bottom: 4cm;
            header: html_letterheader;
            footer: _blank;
            resetpagenum: 1;
        }

        @page letterhead :first {
            margin-top: 8cm;
            margin-bottom: 4cm;
            header: html_letterheader;
            footer: _blank;
            resetpagenum: 1;
            background-color: lightblue;
        }

        .letter {
            page-break-before: always;
            page: letterhead;
        }

        .data,
        .data th,
        .data td {
            border-collapse: collapse;
            border: 1px solid #363636;
            padding: 8px 15px;
        }
    </style>

    <table class="data" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Id Pendaftaran</th>
                <th>Nama Catin</th>
                <th>Tanggal Nikah</th>
                <th>Tanggal Pendaftaran</th>
                <th>Tanggal Pembayaran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($data = $query->fetch_assoc()) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($data['id_daftar']); ?></td>
                    <td><?= htmlspecialchars($data['nama_calsu']); ?> | <?= htmlspecialchars($data['nama_calis']); ?></td>
                    <td><?= htmlspecialchars($data['tanggal_nikah_m']); ?></td>
                    <td><?= htmlspecialchars($data['tanggal_daftar']); ?></td>
                    <td><?= htmlspecialchars($data['tanggal']); ?></td>
                    <td><?= htmlspecialchars($data['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br>
    <div style="text-align: right; width: 50%; float: right;">
        Banjarmasin, <?= tanggal_indo(date('Y-m-d')); ?>
        <br><br><br>
        <strong>H. Syamsuri, S.Ag, M.H.I</strong>
    </div>
</body>

</html>
<?php
// Tangkap output buffer dan masukkan ke MPDF
$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($html);
$mpdf->Output($nama_dokumen . ".pdf", 'D');
?>
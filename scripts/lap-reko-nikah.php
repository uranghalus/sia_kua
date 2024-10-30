<?php
define('BASEPATH', true);
include "../config/connection.php";
include "../config/fungsi.php";
$tanggala = date('Y-m-d', strtotime($_GET['ta']));
$tanggalb = date('Y-m-d', strtotime($_GET['tb']));
$sql = "SELECT * FROM tbl_rekomendasi 
INNER JOIN tbl_daftar_nikah ON tbl_daftar_nikah.id_daftar=tbl_rekomendasi.id_pendaftaran_nikah
WHERE tanggal BETWEEN '$tanggala' and '$tanggalb'";
$query = $connectdb->query($sql);

$nama_dokumen = 'Laporan Rekomendasi Nikah Periode(' . $tanggala . ' - ' . $tanggalb . ')';
require '../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
ob_start();
?>
<!-- surat -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <title>Document</title>
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
                <h4>Laporan Rekomendasi Nikah</h4>
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
    <!-- isi -->
    <div style="width:100%">
        <table id="example1" class="data">
            <thead>
                <tr>
                    <th><b>No.</b></th>
                    <th><b>Nama Calon Suami</b></th>
                    <th><b>No. Rekomendasi</b></th>
                    <th><b>Id Pendaftaran</b></th>
                    <th><b>Tanggal Rekomendasi</b></th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if ($query) : ?>
                    <?php while ($data = $query->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['nama_calsu'] ?></td>
                            <td><?php echo $data['id'] ?></td>
                            <td><?php echo $data['id_pendaftaran_nikah'] ?></td>
                            <td><?php echo $data['tanggal'] ?></td>
                        </tr>
                    <?php $no++;
                    endwhile ?>
                <?php else : $msg = mysqli_error_list($connectdb);
                    echo json_encode($msg); ?>
                <?php endif ?>
            </tbody>
        </table>

    </div>
    <br><br>
    <!-- ttd -->
    <div style="float: right; text-align:right; width: 50%;">
        Banjarmasin,<?= tanggal_indo(date('Y-m-d')) ?>
    </div>
    <br>
    <div class="ttd">
        <table style="width:100% ;text-align: center;font-weight: bold;">
            <tr>
                <Th>Mengetahui</Th>
                <th>Diketahui</th>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td><br /></td>
            </tr>
            <tr>
                <td><br /></td>
            </tr>
            <tr>
                <td> Zainuddin</td>
                <td> H. Syamsuri , S.Ag,M.H.I.</td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php
// Now collect the output buffer into a variable
$html = ob_get_contents();
ob_end_clean();

// send the captured HTML from the output buffer to the mPDF class for processing
$mpdf->WriteHTML($html);
$mpdf->Output("" . $nama_dokumen . ".pdf", 'D');
?>
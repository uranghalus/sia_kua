<?php
include "config/koneksi.php";
include "config/fungsi.php";
$nik = $_GET['n'];
$query = $db->query("SELECT * FROM tbl_instansi WHERE id_instansi='$nip'") or die(mysqli_error($db));
$result = $query->fetch_assoc();
$nama_dokumen = 'Rekap Laporan Pemeriksaan ' . $result['nama_instansi'];
require __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
ob_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <htmlpageheader name="letterheader">
        <table width="100%" style=" font-family: sans-serif;">
            <tr>
                <td style="text-align: center;color:#0000BB; "><img src="assets/dist/img/Kop-logo.png" width="128" alt="" srcset=""></td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <span style="font-weight: bold; font-size: 14pt;">
                        Perwakilan Ombudsman Republik Indonesia
                    </span>
                    <br>
                    <span style="font-weight: bold; font-size: 14pt;">
                        Provinsi Kalimantan Selatan
                    </span>
                </td>
            </tr>
        </table>
        <div style="margin-top: 20px; font-weight: bold;text-transform: uppercase;font-family:  sans-serif; font-size: 12pt;">
            <div style="text-align:center;">
                LAPORAN
                <br>
                HASIL PEMERIKSAAN PERIODE
                <br>
                <?= $tanggala . " S/D " . $tanggalb ?>
                <br>
                <?= $result['nama_instansi'] ?>
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

        .table {
            margin: 10px 0px;
        }

        .ttd {
            margin: 10px 0px;
            width: 100%
        }
    </style>
    <div class="table">
        <table id="example3" border="1" style="width:100% ;">
            <thead>
                <tr>
                    <th><b>No.</b></th>
                    <th><b>No Laporan</b></th>
                    <th><b>No Regist Laporan</b></th>
                    <th><b>Nama Pemeriksa</b></th>
                    <th><b>Tanggal</b></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query(
                    $db,
                    "SELECT * FROM hasil_pemeriksaan
                                            INNER JOIN tbl_user ON tbl_user.nip=hasil_pemeriksaan.nip
                                            INNER JOIN tbl_instansi ON tbl_instansi.id_instansi=hasil_pemeriksaan.id_instansi
                                         WHERE hasil_pemeriksaan.id_instansi='$nip' AND tgl_pemeriksaan BETWEEN '$tanggala' and '$tanggalb' "
                );
                $no = 1;
                ?>
                <?php if ($query) : ?>
                    <?php while ($data = $query->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['no_laporan']; ?></td>
                            <td><?php echo $data['kode_registrasi']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($data['tgl_pemeriksaan']));  ?></td>
                        </tr>
                    <?php $no++;
                    endwhile ?>
                <?php else : $msg = mysqli_error_list($db);
                    echo json_encode($msg); ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div style="float:right; text-align:right;width: 50%;">
        Banjarmasin, <?= tanggal_indo(date('Y-m-d')) ?><br><br>
    </div>
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
                <td> Hadi Rahman S.IP.,M.PA (Mgmt)</td>
                <td> Supiannor S.IP.,M.PA (Mgmt)</td>
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
$mpdf->Output("" . $nama_dokumen . ".pdf", 'D'); ?>
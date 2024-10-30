<?php
define('BASEPATH', true);
include "../config/connection.php";
include "../config/fungsi.php";
$id = $_GET['n'];

$query = $connectdb->query(
    "SELECT * FROM tbl_daftar_nikah  
    INNER JOIN tbl_penerimaan_pendaftaran ON tbl_penerimaan_pendaftaran.id_pendaftaran_nikah=tbl_daftar_nikah.id_daftar
    WHERE id_daftar= '$id'
    "
);

$result = $query->fetch_assoc();
$nama_dokumen = 'Surat Pemberitahuan Pendaftaran(' . $result['id_daftar'] . ')';
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
            <div style="float: left;width: 50%;">
                Nomor : <?= $result['nomor_surat_penerimaan'] ?>
                <br>
                Lampiran : -
                <br>
                Perihal : <strong>Pemberitahuan Pendaftaran Pernikahan</strong>
                <br><br />
                Kepada <br>
                Yth. <b>Calon Pengantin </b>
                <br>
                <?= $result['nama_calsu'] ?> - <?= $result['nama_calis'] ?> <br>
                Di -Tempat
                <br><br>
            </div>
            <div style="float: right; text-align:right; width: 50%;">
                Banjarmasin,<?= tanggal_indo($result['tanggal_daftar']) ?>
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
    </style>
    <!-- isi -->
    <div style="text-align: justify;text-justify: inter-word;"><br>
        <p style="margin-top: 25px;">Dengan hormat,</p>
        <p>setelah dilakukan pemeriksaan terhadap persyaratan
            pendaftaran perkawinan yang diatur daiam Peraturan Perundang
            undang perkawinan bahwa Permohonan pendaftaran (Perkawinan)Saudara <b><u><?= $result['nama_calsu'] ?></u></b> dengan saudari <b><u><?= $result['nama_calis'] ?> </u></b>dengan data berikut</p>
        <table>
            <tr>
                <td>Nik</td>
                <td>:</td>
                <td><?= $result['nik_calsu'] ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $result['nama_calsu'] ?></td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td><?= $result['tempat_lahir_calsu'] ?>,<?= $result['tanggal_lahir_calsu'] ?></td>
            </tr>
            <tr>
                <td>Warga Negara</td>
                <td>:</td>
                <td><?= $result['kewarganegaraan_calsu'] ?></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td><?= $result['agama_calsu'] ?></td>
            </tr>
            <tr>
                <td>Tempat Tinggal</td>
                <td>:</td>
                <td><?= $result['alamat_calsu'] ?></td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td><?= $result['status_calsu'] ?></td>
            </tr>
        </table>
        <p>
            <b>
                Akan melaksanakan pernikahan dengan seorang Perempuan:
            </b>
        </p>
        <table>
            <tr>
                <td>Nik</td>
                <td>:</td>
                <td><?= $result['nik_calis'] ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $result['nama_calis'] ?></td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td><?= $result['tempat_lahir_calis'] ?>,<?= $result['tanggal_lahir_calis'] ?></td>
            </tr>
            <tr>
                <td>Warga Negara</td>
                <td>:</td>
                <td><?= $result['kewarganegaraan_calis'] ?></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td><?= $result['agama_calis'] ?></td>
            </tr>
            <tr>
                <td>Tempat Tinggal</td>
                <td>:</td>
                <td><?= $result['alamat_calis'] ?></td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td><?= $result['status_calis'] ?></td>
            </tr>
        </table>
        <p>
            Berdasarkan data berikut kami beritahukan anda berhasil melakukan pendaftaran pernikahan dengan nomor pendaftaran <b> <?= $result['id_daftar'] ?></b>
            <br>
            Demikian agar menjadi maklum
        </p>
        </p>
    </div><br><br>
    <!-- ttd -->
    <div style="float:right; text-align:center;width: 50%;">
        Wassalam,
        Kepala
        <br><br><br /><br /><br />
        H. Syamsuri , S.Ag,M.H.I.
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
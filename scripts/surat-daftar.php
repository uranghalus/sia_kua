<?php
define('BASEPATH', true);
include "../config/connection.php";
include "../config/fungsi.php";
$id = $_GET['n'];

$query = $connectdb->query(
    "SELECT * FROM tbl_daftar_nikah
    INNER JOIN tbl_penolakan ON tbl_penolakan.id_pendaftaran=tbl_daftar_nikah.id_daftar
    WHERE id_daftar='$id'"
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
                Nomor : <?= $result['id_penolakan'] ?>
                <br>
                Lampiran : -
                <br>
                <?php if ($result['jenis_penolakan'] == "Berkas Belum Lengkap") : ?>
                    Perihal : <strong>Pemberitahuan Kekurangan Syarat</strong>
                <?php elseif ($result['jenis_penolakan'] == "Umur Belum Mencukupi") : ?>
                    Perihal : <strong>Penolakan Perkawinan atau Rujuk</strong>
                <?php endif ?>
                <br><br />
                Kepada <br>
                Yth. <b>Calon Pengantin </b>
                <?= $result['nama_calsu'] ?> - <?= $result['nama_calis'] ?> <br>
                Di -Tempat
                <br><br>
            </div>
            <div style="float: right; text-align:right; width: 50%;">
                Banjarmasin,<?= tanggal_indo($result['tanggal']) ?>
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
            pendaftaran perkawinan atau rujuk yang diatur daiam Peraturan Perundang
            undang perkawinan bahwa Permohonan pendaftaran (Perkawinan / Rujuk
            *)Saudara <b><u><?= $result['nama_calsu'] ?></u></b> dengan saudari <b><u><?= $result['nama_calis'] ?></u></b> diberrtahukan sebagal berrkut </p>
        <?php if ($result['jenis_penolakan'] == "Berkas Belum Lengkap") : ?>
            <p>Perkawinan dapat dilaksanakan dengan melengkapl persyaratan berupa surat
                Dispensasi dari Camat Kecamatan Banjarmasin Timur, sesual dengan PMA
                Nomor 20 tahun 2019 pasal 3 ayat (3 dan 4) <br>
                agar saudara dapat melengkapi kekurangan syaratnya seperti <b><?= $result['keterangan'] ?></b>
            </p>

        <?php elseif ($result['jenis_penolakan'] == "Umur Belum Mencukupi") : ?>
            <p>
                Tidak dapat dilaksanakan atau ditoiak karena Usia (calon Pengantin
                (Pria/Wanita) KURANG dan Usia 19 tahun sebagaimana yang disyaratkan
                Undang-Undang Nomor 16 Tahun 2019 tentang Perubahan atas UU Perkawinan Nomor 01 Tahun 1974, maka kepada yang bersangkutan kami persilakan ke Pengadilan Agama setempat untuk memohon Dispensasi Usia Nikah.
            </p>
        <?php endif ?>
        <br>
        Demikian agar menjadi maklum
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
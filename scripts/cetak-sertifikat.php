<?php
define('BASEPATH', true);
require '../vendor/autoload.php';
include "../config/connection.php";
include "../config/fungsi.php";

// Ambil ID peserta dari GET
$id_peserta = $_GET['id_peserta'];

// Query untuk mengambil data peserta dan data calon pengantin
$sql = "SELECT
            p.id_peserta, p.id_daftar, p.id_sesi,
            d.nama_calsu, d.nik_calsu, d.nama_calis, d.nik_calis, d.tempat_menikah,
            d.tanggal_nikah_m, d.jam_nikah,
            s.tanggal AS tanggal_sesi, s.waktu AS waktu_sesi
        FROM peserta_bimbingan p
        LEFT JOIN tbl_daftar_nikah d ON p.id_daftar = d.id_daftar
        LEFT JOIN sesi_bimbingan s ON p.id_sesi = s.id_sesi
        WHERE p.id_peserta = ?";
$stmt = $connectdb->prepare($sql);
$stmt->bind_param("i", $id_peserta);
$stmt->execute();
$result = $stmt->get_result();
$peserta = $result->fetch_assoc();

if ($peserta) {
    $nama_dokumen = 'Sertifikat Bimbingan - ' . htmlspecialchars($peserta['nik_calsu']);
    $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4',  // Format A4 untuk halaman standar
        'margin_top' => 20,  // Margin atas
        'margin_bottom' => 20,  // Margin bawah
        'margin_left' => 20,  // Margin kiri
        'margin_right' => 20,  // Margin kanan
    ]);

    ob_start();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sertifikat Bimbingan</title>
        <style>
            @page {
                margin: 20mm;
                /* Mengatur margin semua sisi */
            }

            .certificate {
                text-align: center;
                padding: 20px;
                /* Padding yang lebih kecil agar konten pas di satu halaman */
            }

            .certificate h1 {
                font-size: 24px;
                font-weight: bold;
            }

            .certificate .content {
                margin-top: 20px;
                font-size: 16px;
            }

            .certificate .footer {
                margin-top: 30px;
                font-size: 12px;
                text-align: left;
            }

            .certificate .signature {
                margin-top: 50px;
                text-align: right;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            table,
            th,
            td {
                border: 1px solid black;
            }

            th,
            td {
                padding: 10px;
                text-align: left;
            }
        </style>
    </head>

    <body>
        <div class="certificate">
            <h1>SERTIFIKAT PEMBIMBINGAN</h1>
            <div class="content">
                <p>Dengan ini kami menyatakan bahwa:</p>
                <p><strong><?php echo htmlspecialchars($peserta['nama_calsu']); ?> & <?php echo htmlspecialchars($peserta['nama_calis']); ?></strong></p>
                <p>Telah mengikuti bimbingan pernikahan dengan baik.</p>
                <p>Informasi Pernikahan:</p>
                <table>
                    <tr>
                        <th>Calon Suami</th>
                        <td><?php echo htmlspecialchars($peserta['nama_calsu']); ?> (NIK: <?php echo htmlspecialchars($peserta['nik_calsu']); ?>)</td>
                    </tr>
                    <tr>
                        <th>Calon Istri</th>
                        <td><?php echo htmlspecialchars($peserta['nama_calis']); ?> (NIK: <?php echo htmlspecialchars($peserta['nik_calis']); ?>)</td>
                    </tr>
                    <tr>
                        <th>Tempat Menikah</th>
                        <td><?php echo htmlspecialchars($peserta['tempat_menikah']); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pernikahan</th>
                        <td><?php echo htmlspecialchars($peserta['tanggal_nikah_m']); ?></td>
                    </tr>
                    <tr>
                        <th>Jam Pernikahan</th>
                        <td><?php echo htmlspecialchars($peserta['jam_nikah']); ?></td>
                    </tr>
                </table>
                <p>Informasi Sesi Bimbingan:</p>
                <table>
                    <tr>
                        <th>Tanggal Sesi</th>
                        <td><?php echo htmlspecialchars($peserta['tanggal_sesi']); ?></td>
                    </tr>
                    <tr>
                        <th>Waktu Sesi</th>
                        <td><?php echo htmlspecialchars($peserta['waktu_sesi']); ?></td>
                    </tr>
                </table>
            </div>
            <div class="footer">
                <p>Terima kasih atas partisipasi Anda dalam bimbingan pernikahan ini.</p>
            </div>
            <div class="signature">
                <p>_________________________</p>
                <p>Nama Penanda Tangan</p>
                <p>Jabatan</p>
            </div>
        </div>
    </body>

    </html>

<?php
    $html = ob_get_contents();
    ob_end_clean();
    // Kirim HTML ke mPDF
    $mpdf->WriteHTML($html);
    // Output file PDF
    $mpdf->Output($nama_dokumen . '.pdf', 'I');
} else {
    echo 'Peserta tidak ditemukan.';
}

// Menutup koneksi
$stmt->close();
$connectdb->close();
?>
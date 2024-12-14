<?php
// Pastikan BASEPATH dan koneksi ke database
define('BASEPATH', true);
require '../config/connection.php';

// Cek apakah parameter yang diperlukan ada
if (isset($_GET['id_peserta']) && isset($_GET['jenis'])) {
    // Ambil data dari URL
    $id_peserta = $_GET['id_peserta'];
    $jenis = $_GET['jenis'];

    // Validasi input: pastikan id_peserta adalah angka
    if (!is_numeric($id_peserta)) {
        die("ID peserta tidak valid.");
    }

    // Tentukan status berdasarkan jenis
    $status_pendaftaran = ($jenis == 'tolak') ? 'Ditolak' : 'Diterima';

    // Jika jenis adalah 'terima', masukkan peserta ke tabel peserta_sesi
    if ($jenis == 'terima') {
        // Ambil data peserta untuk memastikan id_peserta valid
        $stmt = $connectdb->prepare("SELECT * FROM peserta_bimbingan WHERE id_peserta = ?");
        $stmt->bind_param("i", $id_peserta);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Ambil ID sesi dari data peserta_bimbingan
            $id_sesi = $row['id_sesi'];

            // Masukkan data ke tabel peserta_sesi
            $insert_stmt = $connectdb->prepare("INSERT INTO peserta_sesi (id_sesi, id_peserta, status_kehadiran, sertifikat) VALUES (?, ?, ?, ?)");
            $status_kehadiran = 'Tidak Hadir'; // Default
            $sertifikat = false;               // Default (false = 0)

            $insert_stmt->bind_param("iisi", $id_sesi, $id_peserta, $status_kehadiran, $sertifikat);

            if ($insert_stmt->execute()) {
                echo "Data berhasil dimasukkan ke tabel peserta_sesi.<br>";
                echo "ID Peserta Sesi: " . $insert_stmt->insert_id . "<br>";
            } else {
                echo "Gagal memasukkan data ke peserta_sesi: " . $insert_stmt->error . "<br>";
            }

            $insert_stmt->close();
        } else {
            echo "Peserta dengan ID $id_peserta tidak ditemukan.<br>";
        }

        $stmt->close();
    }

    // Update status pendaftaran di tabel peserta_bimbingan
    $update_stmt = $connectdb->prepare("UPDATE peserta_bimbingan SET status_pendaftaran = ? WHERE id_peserta = ?");
    $update_stmt->bind_param("si", $status_pendaftaran, $id_peserta);

    if ($update_stmt->execute()) {
        echo '<script>alert("Data Berhasil Diverifikasi");window.location="../dashboard?pages=jadwal-bimbingan"</script>';
    } else {
        echo "Gagal memperbarui status pendaftaran: " . $update_stmt->error . "<br>";
    }

    $update_stmt->close();
} else {
    echo "Invalid parameters.";
}

$connectdb->close();

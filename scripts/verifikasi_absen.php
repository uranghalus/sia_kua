<?php
// Pastikan BASEPATH dan koneksi ke database
define('BASEPATH', true);
require '../config/connection.php';

if (isset($_GET['id_absensi']) && isset($_GET['id_sesi'])) {
    date_default_timezone_set('Asia/Makassar');
    $id_absensi = (int) $_GET['id_absensi']; // Pastikan menjadi integer
    $id_sesi = (int) $_GET['id_sesi'];       // Pastikan menjadi integer

    // Mengambil tanggal dan waktu sekarang
    $tanggal_absen = date('Y-m-d'); // Format: YYYY-MM-DD
    $waktu_absen = date('H:i:s');  // Format: HH:MM:SS

    // Debugging: Tampilkan waktu absensi

    // Mengambil data sesi bimbingan berdasarkan id_sesi
    $stmt_sesi = $connectdb->prepare("SELECT tanggal, waktu FROM sesi_bimbingan WHERE id_sesi = ?");

    if ($stmt_sesi === false) {
        // Cek jika prepare gagal
        echo "Error preparing statement: " . $connectdb->error;
        exit;
    }

    // Bind parameter untuk query sesi
    $stmt_sesi->bind_param("i", $id_sesi);

    // Eksekusi query
    $stmt_sesi->execute();

    // Ambil hasil sesi
    $result_sesi = $stmt_sesi->get_result();

    if ($result_sesi->num_rows > 0) {
        // Ambil data sesi
        $row_sesi = $result_sesi->fetch_assoc();
        $tanggal_sesi = $row_sesi['tanggal']; // Pastikan kolomnya benar
        $waktu_sesi = $row_sesi['waktu'];    // Pastikan kolomnya benar

        // Debugging: Tampilkan waktu sesi bimbingan
        echo "Waktu Sesi: " . $waktu_sesi . "<br>";

        // Cek apakah tanggal absensi sesuai dengan tanggal sesi
        if ($tanggal_absen == $tanggal_sesi) {
            // Menghitung waktu 1 jam setelah sesi
            $waktu_sesi_plus_1jam = date('H:i:s', strtotime($waktu_sesi . ' +1 hour'));

            // Debugging: Tampilkan waktu sesi + 1 jam
            echo "Waktu Sesi + 1 Jam: " . $waktu_sesi_plus_1jam . "<br>";

            // Cek apakah waktu absensi berada dalam rentang waktu sesi + 1 jam
            if ($waktu_absen >= $waktu_sesi && $waktu_absen <= $waktu_sesi_plus_1jam) {
                // Update status kehadiran peserta
                $sql_update = "
                UPDATE peserta_sesi
                SET status_kehadiran = 'Hadir', sertifikat = 1
                WHERE id_peserta_sesi = ? AND id_sesi = ?
                ";

                // Persiapkan statement untuk update
                $stmt_update = $connectdb->prepare($sql_update);

                if ($stmt_update === false) {
                    // Cek jika prepare gagal
                    echo "Error preparing statement: " . $connectdb->error;
                    exit;
                }

                // Bind parameter untuk update
                $stmt_update->bind_param("ii", $id_absensi, $id_sesi);

                // Eksekusi update
                if ($stmt_update->execute()) {
                    echo '<script>alert("Absensi berhasil dan status peserta diperbarui.");window.location="../dashboard?pages=absensi-bimbingan"</script>';
                } else {
                    echo '<script>alert("Gagal memperbarui status peserta.");window.location="../dashboard?pages=absensi-bimbingan"</script>';
                }

                // Tutup statement update
                $stmt_update->close();
            } else {
                echo '<script>alert("Absensi hanya dapat dilakukan dalam satu jam setelah waktu sesi bimbingan.");window.location="../dashboard?pages=absensi-bimbingan"</script>';
            }
        } else {
            echo '<script>alert("Tanggal absensi tidak sesuai dengan tanggal sesi bimbingan.");window.location="../dashboard?pages=absensi-bimbingan"</script>';
        }
    } else {
        echo '<script>alert("Sesi bimbingan tidak ditemukan.");window.location="../dashboard?pages=absensi-bimbingan"</script>';
    }

    // Tutup statement sesi dan koneksi database
    $stmt_sesi->close();
    $connectdb->close();
}

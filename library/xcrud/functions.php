<?php
function nikah_beforeinsert($postdata, $xcrud)
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'db_kua';

    $db = new mysqli($host, $username, $password, $dbname);
    $nik = $_SESSION['user-data']['nik'];
    $bulan = date('n');
    $tahun    = date('Y');
    $tgl_daftar = date('Y-m-d');
    // caridata
    $query = mysqli_query($db, "SELECT MAX(kode_transaksi)as maxNo FROM tbl_daftar_nikah WHERE month(tanggal_daftar)='$bulan'");
    $result = mysqli_fetch_array($query);
    $no = $result['maxNo'];
    // set nomor
    $noUrut = $no + 1;
    $kode =  sprintf("%02s", $noUrut);
    $nomorbaru = "PN/" . $kode . "/" . $tgl_daftar . "/" . $tahun;

    $postdata->set('kode_transaksi', $noUrut);
    $postdata->set('id_daftar', $nomorbaru);
    $postdata->set('tanggal_daftar', $tgl_daftar);
    $postdata->set('user_id', $nik);
    $postdata->set('status', "Menunggu Pembayaran");
}
function nikah_beforeupdate($postdata, $xcrud)
{
    $postdata->set('status', "Menunggu Di Proses");
}
function rekomendasi_beforeinsert($postdata, $xcrud)
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'db_kua';

    $db = new mysqli($host, $username, $password, $dbname);
    $nik = $_SESSION['user-data']['nik'];
    $bulan = date('n');
    $tahun    = date('Y');
    $bln = date('m');
    $tgl_daftar = date('Y-m-d');
    // caridata
    $query = mysqli_query($db, "SELECT MAX(kode_transaksi)as maxNo FROM tbl_rekomendasi WHERE month(tanggal)='$bulan'");
    $result = mysqli_fetch_array($query);
    $no = $result['maxNo'];
    // set nomor
    $noUrut = $no + 1;
    $kode =  sprintf("%02s", $noUrut);
    $nomorbaru = $kode . "/Kua.17.01-2/PW.01/" . $bln . "/" . $tahun;

    $postdata->set('kode_transaksi', $noUrut);
    $postdata->set('id', $nomorbaru);
    $postdata->set('tanggal', $tgl_daftar);
    $postdata->set('user_id', $nik);
    $postdata->set('status', "Menunggu Di Proses");
}
function bayar_beforeinsert($postdata, $xcrud)
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'db_kua';
    $db = new mysqli($host, $username, $password, $dbname);

    $bulan = date('n');
    // caridata
    $query = mysqli_query($db, "SELECT MAX(kode_transaksi)as maxNo FROM tbl_bukti_pembayaran WHERE month(tanggal)='$bulan'");
    $count = $query->num_rows;
    if ($count > 0) {
        $result = mysqli_fetch_array($query);
        $no = $result['maxNo'];
        // set nomor
        $noUrut = $no + 1;
        $kode =  sprintf("%02s", $noUrut);
        $kode_bayar =  "KUA" . date('hmyd') . $kode;

        $tgl_daftar = date('Y-m-d');
        $nik = $_SESSION['user-data']['nik'];
        $postdata->set('tanggal', $tgl_daftar);
        $postdata->set('user_id', $nik);
        $postdata->set('id', $kode_bayar);
        $postdata->set('kode_transaksi', $noUrut);
    } else {
        echo mysqli_error($db);
    }
}
function bayar_afterinsert($postdata, $xcrud)
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'db_kua';
    $db = new mysqli($host, $username, $password, $dbname);

    $id_ = $postdata->get('id_registrasi');

    $query = $db->query("UPDATE tbl_daftar_nikah SET status='Menunggu Di Proses' WHERE id_daftar='$id_'");
}
function tolak_beforeinsert($postdata, $xcrud)
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'db_kua';

    $db = new mysqli($host, $username, $password, $dbname);
    $bulan = date('n');
    $tahun    = date('Y');
    $bln = date('m');
    $tgl_daftar = date('Y-m-d');
    // caridata
    $query = mysqli_query($db, "SELECT MAX(kode_transaksi)as maxNo FROM tbl_penolakan WHERE month(tanggal)='$bulan'");
    $result = mysqli_fetch_array($query);
    $no = $result['maxNo'];
    // set nomor
    $noUrut = $no + 1;
    $kode =  sprintf("%02s", $noUrut);
    $nomorbaru = $kode . "/Kua.17.01-2/PW.01/" . $bln . "/" . $tahun;

    $postdata->set('kode_transaksi', $noUrut);
    $postdata->set('id_penolakan', $nomorbaru);
    $postdata->set('tanggal', $tgl_daftar);
}
function tolak_afterinsert($postdata, $xcrud)
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'db_kua';
    $db = new mysqli($host, $username, $password, $dbname);

    $id_ = $postdata->get('id_pendaftaran');
    $status = "Ditolak";
    $query = $db->query("UPDATE tbl_daftar_nikah SET status='$status' WHERE id_daftar='$id_'");
}
function jadwal_beforeinsert($postdata, $xcrud)
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'db_kua';

    $db = new mysqli($host, $username, $password, $dbname);
    $id = $postdata->get('id_daftar_nikah');
    $query = $db->query("SELECT * FROM tbl_daftar_nikah WHERE id_daftar='$id'");
    $data =  $query->fetch_assoc();

    $postdata->set('tgl_nikah', $data['tanggal_nikah_m']);
    $postdata->set('jam_nikah', $data['jam_nikah']);
    $postdata->set('tempat_nikah', $data['tempat_menikah']);
    $postdata->set('alamat_nikah', $data['alamat_nikah']);
    $postdata->set('status_jadwal', "PENDING");
}

function peserta_callback($value, $field, $primary_key, $list, $xcrud)
{
    $id_user = $_SESSION['user-data']['nik'];
    if ($id_user) {
        return "<span class='label label-info'>$value</span>"; // Menambahkan label-info untuk highlight
    } else {
        return $value; // Jika tidak cocok, tampilkan nama normal
    }
}
function sesi_callback($value, $field, $primary_key, $list, $xcrud)
{
    // Pastikan session dimulai
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'db_kua';

    // Membuat koneksi ke database
    $db = new mysqli($host, $username, $password, $dbname);

    // Cek apakah koneksi berhasil
    if ($db->connect_error) {
        die("Koneksi gagal: " . $db->connect_error);
    }

    // SQL Query yang benar
    $sql = "
    SELECT 
        d.id_daftar, 
        d.kewarganegaraan_calsu, 
        d.nik_calsu, 
        d.nama_calsu, 
        d.nik_calis, 
        d.nama_calis
    FROM tbl_daftar_nikah d
    LEFT JOIN peserta_bimbingan p ON d.id_daftar = p.id_daftar
    WHERE p.id_peserta = ?
    ";

    // Persiapkan statement
    $stmt = $db->prepare($sql);

    // Bind parameter
    $stmt->bind_param("i", $value);

    // Eksekusi query
    $stmt->execute();

    // Ambil hasil
    $result = $stmt->get_result();

    // Menangani hasil
    $output = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Mengambil user_id dari session
            $id_user = isset($_SESSION['user-data']['nik']) ? $_SESSION['user-data']['nik'] : null;

            // Menampilkan hasil sesuai kondisi
            if ($id_user) {
                $output .= "<span class='label label-info'>" . $row['nama_calsu'] . " | " . $row['nik_calsu'] . "</span><br>"; // Menambahkan label-info untuk highlight
            } else {
                $output .= $row['nama_calsu'] . " | " . $row['nik_calsu'] . "<br>"; // Jika tidak cocok, tampilkan nama normal
            }
        }
    } else {
        $output = "Data tidak ditemukan.";
    }

    // Tutup koneksi
    $stmt->close();
    $db->close();

    // Kembalikan output
    return $output;
}

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


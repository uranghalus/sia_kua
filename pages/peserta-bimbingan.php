<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';
// echo Xcrud::load_css();
// echo Xcrud::load_js();
$id_user = $_SESSION['user-data']['nik'];
$xcrud = Xcrud::get_instance();
$xcrud->table('peserta_bimbingan');
$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();
if ($role != "ADMIN") {
    $xcrud->unset_add();
    $xcrud->unset_remove();
    $xcrud->unset_edit();

    // Menambahkan custom PHP untuk memeriksa apakah id_user cocok dengan id_daftar
    $xcrud->column_callback('id_daftar', function ($value, $field, $primary_key) use ($id_user) {
        // Cek jika primary_key yang terdaftar sama dengan id_user yang login
        if ($id_user) {
            return "<span class='label label-info'>$value</span>"; // Menambahkan label-info untuk highlight
        } else {
            return $value; // Jika tidak cocok, tampilkan nama normal
        }
    });
    // $xcrud->button('verif_bimbingan?id_bimbingan={id_sesi}&jenis=terima', 'Terima Bimbingan', 'fa fa-check', 'btn btn-success');
    // $xcrud->button('verif_bimbingan?id_bimbingan={id_sesi}&jenis=tolak', 'Tolak Bimbingan', 'fa fa-times', 'btn btn-danger');
    $xcrud->button('scripts/verifikasi_bimbingan?id_bimbingan={id_sesi}&jenis=tolak', 'Tolak Bimbingan', 'fa fa-times', 'btn btn-danger', '', array('status_pendaftaran', '=', 'Menunggu'));
    $xcrud->button('scripts/verifikasi_bimbingan?id_bimbingan={id_sesi}&jenis=terima', 'Terima Bimbingan', 'fa fa-check', 'btn btn-success', '', array('status_pendaftaran', '=', 'Menunggu'));
}
$xcrud->highlight('status_pendaftaran', '=', 'Diterima', '', 'alert-success');
$xcrud->highlight('status_pendaftaran', '=', 'Ditolak', '', 'alert-danger');
$xcrud->highlight('status_pendaftaran', '=', 'Menunggu', '', 'alert-warning');
$xcrud->fields('status_pendaftaran', true);
// Menambahkan relasi untuk `id_daftar` (mengambil data dari `tbl_daftar_nikah`)
$xcrud->relation('id_daftar', 'tbl_daftar_nikah', 'id_daftar', 'nama_calsu');

// Menambahkan relasi untuk `id_sesi` (mengambil data dari `sesi_bimbingan`)
$xcrud->relation('id_sesi', 'sesi_bimbingan', 'id_sesi', 'nama_sesi');
// Menampilkan kolom dalam tabel
$xcrud->columns('id_daftar, id_sesi, status_pendaftaran, tanggal_daftar');
$xcrud->label('id_daftar', 'Nama Catin'); // Label untuk ID Pendaftaran
$xcrud->label('id_sesi', 'Sesi Bimbingan');
// $xcrud->button('dashboard?pages=materi-bimbingan&id_bimbingan={id}', 'My Title', 'fa fa-book', 'btn btn-indigo');
$crudrender = $xcrud->render(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Data Peserta Bimbingan Pranikah </h3>
            </div>
            <div class="box-body">
                <?= $crudrender; ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
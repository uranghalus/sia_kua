<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';

$xcrud = Xcrud::get_instance();
$xcrud->table('peserta_sesi');
$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();
$xcrud->unset_add();
$xcrud->unset_view();
$xcrud->unset_edit();
$xcrud->unset_remove();
$xcrud->relation('id_daftar', 'tbl_daftar_nikah', 'id_daftar', 'nama_calsu');
// Menambahkan relasi untuk `id_sesi` (mengambil data dari `sesi_bimbingan`)
$xcrud->relation('id_sesi', 'sesi_bimbingan', 'id_sesi', 'nama_sesi');

$xcrud->label(array(
    'id_peserta' => 'Nama Peserta',
    'id_sesi' => 'Sesi Bimbingan'
));

$xcrud->column_callback('id_peserta', 'sesi_callback');
$xcrud->button('scripts/verifikasi_absen?id_absensi={id_peserta_sesi}&id_sesi={id_sesi}', 'Absen', 'fa fa-check', 'btn btn-success', '', array('status_kehadiran', '=', 'Tidak Hadir'));
$xcrud->button('scripts/cetak-sertifikat?id_peserta={id_peserta}', 'Download Sertifikat', 'glyphicon glyphicon-save-file', 'btn btn-warning', '', array('status_kehadiran', '=', 'Hadir'));

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
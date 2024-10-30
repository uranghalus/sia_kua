<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';
// echo Xcrud::load_css();
// echo Xcrud::load_js();
$xcrud = Xcrud::get_instance();
$xcrud->table('tbl_jadwal');
$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();

$xcrud->relation('id_penghulu', 'tbl_penghulu', 'nip', 'nama_penghulu');

if ($role != "ADMIN") {
    $xcrud->unset_add();
    $xcrud->unset_edit();
    $xcrud->unset_remove();
    $xcrud->relation('id_registrasi', 'tbl_daftar_nikah', 'id_daftar', 'id_daftar', "tbl_daftar_nikah.user_id='$nik'");
} else {
    $xcrud->relation('id_daftar_nikah', 'tbl_daftar_nikah', 'id_daftar', ['id_daftar', 'nama_calsu'], '', '', '', ' | ');
}
$xcrud->columns('id_daftar_nikah', true);
$xcrud->columns('tgl_nikah,jam_nikah,id_penghulu');
$xcrud->fields('id_jadwal,tgl_nikah,jam_nikah,tempat_nikah,alamat_nikah,status_jadwal,id_catin,kode_transaksi', true);
$xcrud->before_insert('jadwal_beforeinsert');
$crudrender = $xcrud->render(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Data <?= $page ?> </h3>
            </div>
            <div class="box-body">
                <?php
                echo $crudrender; ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
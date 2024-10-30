<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';
// echo Xcrud::load_css();
// echo Xcrud::load_js();

$id = $_GET['id'];

$xcrud = Xcrud::get_instance();
$xcrud->table('tbl_bukti_pembayaran');
$xcrud->where('id_registrasi=', $id);
$xcrud->relation('id_registrasi', 'tbl_daftar_nikah', 'id_daftar', 'id_daftar', "tbl_daftar_nikah.id_daftar='$id'");

$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();

if ($role == "ADMIN") {
    $xcrud->unset_add();
}

$xcrud->unset_edit();
$xcrud->unset_remove();
$xcrud->fields('id_registrasi,bukti_bayar', false, false, 'create');
$xcrud->fields('id_registrasi,bukti_bayar,tanggal', false, false, 'view');
$xcrud->columns('id,id_registrasi,bukti_bayar,tanggal');
$xcrud->change_type('bukti_bayar', 'image');
$xcrud->label([
    'id' => 'Kode Pembayaran',
    'id_registrasi' => 'Nomor Register',
    'tanggal' => 'Tanggal Pembayaran',
    'bukti_bayar' => 'Bukti Pembayaran'
]);

$xcrud->before_insert('bayar_beforeinsert');
$xcrud->after_insert('bayar_afterinsert');
$crudrender = $xcrud->render(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"> Data <?= $page ?></h3>
            </div>
            <div class="box-body">
                <?php echo $crudrender; ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
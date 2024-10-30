<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';
// echo Xcrud::load_css();
// echo Xcrud::load_js();

$id = $_GET['id'];
$sql = "SELECT * FROM tbl_daftar_nikah WHERE id_daftar= '$id'";
$stmt = $connectdb->query($sql);
//Fetch row.
$data = $stmt->fetch_assoc();

$xcrud = Xcrud::get_instance();
$xcrud->table('tbl_penolakan');
$xcrud->where('id_pendaftaran=', $id);
$xcrud->relation('id_pendaftaran', 'tbl_daftar_nikah', 'id_daftar', 'id_daftar', "tbl_daftar_nikah.id_daftar='$id'");
$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();

if ($role != "ADMIN") {
    $xcrud->unset_add();
    $xcrud->unset_edit();
    $xcrud->unset_remove();
}
$xcrud->unset_add(false, 'tbl_daftar_nikah.status', '!=', 'Menunggu Di Proses');
$xcrud->hide_button('save_new,save_edit');
$xcrud->unset_limitlist();
$xcrud->unset_search();
$xcrud->change_type('jenis_penolakan', 'radio', 'Berkas Belum Lengkap', 'Berkas Belum Lengkap, Umur Belum Mencukupi');
$xcrud->fields('id_penolakan,tanggal,kode_transaksi', true);
$xcrud->columns('id_penolakan,tanggal,kode_transaksi', true);
$xcrud->before_insert('tolak_beforeinsert');
$xcrud->after_insert('tolak_afterinsert');
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
<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';
// echo Xcrud::load_css();
// echo Xcrud::load_js();
$id_bimbingan = $_GET['id_bimbingan'];
$xcrud = Xcrud::get_instance();
$xcrud->table('peserta_bimbingan');
$xcrud->where('bimbingan_id=', $id_bimbingan);
$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();
$xcrud->fields('bimbingan_id,created_at,updated_at', true);
$xcrud->columns('bimbingan_id,created_at,updated_at', true);

$xcrud->pass_var('bimbingan_id', $id_bimbingan);
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
<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';
// echo Xcrud::load_css();
// echo Xcrud::load_js();
$xcrud = Xcrud::get_instance();
$xcrud->table('sesi_bimbingan');
$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();
$xcrud->unset_view();
$xcrud->columns('waktu,lokasi,link_meeting,deskripsi', true);
$xcrud->fields('status', true);
$xcrud->button('dashboard?pages=view-bimbingan&id_bimbingan={id_sesi}', 'View Bimbingan', 'glyphicon glyphicon-search', 'btn btn-info');
// $xcrud->button('dashboard?pages=peserta-bimbingan&id_bimbingan={id}', 'Tambah Peserta Nikah', 'fa fa-user-plus', 'btn btn-secondrary');
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
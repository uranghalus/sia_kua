<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';
// echo Xcrud::load_css();
// echo Xcrud::load_js();
$id_bimbingan = $_GET['id_bimbingan'];
$xcrud = Xcrud::get_instance();
$xcrud_peserta = Xcrud::get_instance();
$xcrud->table('materi_bimbingan');
$xcrud->where('id_sesi=', $id_bimbingan);
$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();
$xcrud->fields('id_sesi', true);
$xcrud->columns('id_sesi', true);
// Menambahkan field untuk file upload
$xcrud->label('file_materi', 'Upload File');
$xcrud->change_type('file_materi', 'file', '', array('path' => 'uploads/'));

$xcrud->pass_var('id_sesi', $id_bimbingan);
// $xcrud->button('dashboard?pages=materi-bimbingan&id_bimbingan={id}', 'My Title', 'fa fa-book', 'btn btn-indigo');
$render_materi = $xcrud->render(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Data Bimbingan Pranikah </h3>
            </div>
            <div class="box-body">
                <?php
                echo $render_materi; ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
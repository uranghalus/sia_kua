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
$xcrud->where('bimbingan_id=', $id_bimbingan);
$xcrud_peserta->table('peserta_bimbingan');
$xcrud_peserta->where('bimbingan_id=', $id_bimbingan);
$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();
$xcrud->fields('bimbingan_id,created_at,updated_at', true);
$xcrud->columns('bimbingan_id,created_at,updated_at', true);
$xcrud_peserta->unset_title();
$xcrud_peserta->unset_csv();
$xcrud_peserta->unset_print();
$xcrud_peserta->fields('bimbingan_id,created_at,updated_at', true);
$xcrud_peserta->columns('bimbingan_id,created_at,updated_at', true);
// $xcrud_peserta->fk_relation('Nama Pendaftar', 'peserta_bimbinban.id_pendaftaran', 'tbl_daftar_nikah', 'id_daftar');

$xcrud_peserta->relation('id_pendaftaran', 'tbl_daftar_nikah', 'id_daftar', ['nama_calis', 'nama_calsu'], array('status' => 'Pendaftaran Berhasil'), '', '', ' | ');
$xcrud_peserta->readonly('status');
$xcrud_peserta->label('id_pendaftaran', 'Nama Catin');

$xcrud->pass_var('bimbingan_id', $id_bimbingan);
$xcrud_peserta->pass_var('bimbingan_id', $id_bimbingan);
// $xcrud->button('dashboard?pages=materi-bimbingan&id_bimbingan={id}', 'My Title', 'fa fa-book', 'btn btn-indigo');
$render_materi = $xcrud->render();
$render_peserta = $xcrud_peserta->render(); ?>
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
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Data Peserta Bimbingan Pranikah </h3>
            </div>
            <div class="box-body">
                <?php
                echo $render_peserta; ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
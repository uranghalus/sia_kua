<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';
// echo Xcrud::load_css();
// echo Xcrud::load_js();
$xcrud = Xcrud::get_instance();
$xcrud->table('tbl_rekomendasi');
$xcrud->relation('id_pendaftaran_nikah', 'tbl_daftar_nikah', 'id_daftar', ['id_daftar', 'nama_calsu'], '', '', '', ' | ');
$xcrud->relation('tujuan_kua', 'master_kua', 'id_', 'nama_kua');
$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();
if ($role == "ADMIN") {
    $xcrud->unset_add();
    $xcrud->unset_edit();
    $xcrud->unset_remove();
    $xcrud->button('scripts/verif-rekomendasi?n={id}&j=tolak', 'tolak pendaftaran', 'fa fa-times', 'btn btn-default', '', array('status', '=', 'Menunggu Di Proses'));
    $xcrud->button('scripts/verif-rekomendasi?n={id}&j=terima', 'terima pendaftaran', 'fa fa-check', 'btn btn-success', '', array('status', '=', 'Menunggu Di Proses'));
    $xcrud->button('scripts/verif-rekomendasi?n={id}&j=kirim-surat', 'kirim surat', 'fa fa-paper-plane', 'btn btn-success', '', array('status', '=', 'Pengajuan Di Proses'));
} else {
    $xcrud->where('user_id=', $nik);
    $xcrud->unset_edit(true, 'status', '!=', 'Menunggu Di Proses');
    $xcrud->unset_remove(true, 'status', '!=', 'Menunggu Di Proses');
    $xcrud->button('scripts/surat-rekomendasi?id={id}', 'download surat rekomendasi', 'fa fa-download', 'btn btn-success', '', array('status', '=', 'Pengajuan Selesai'));
}
// $xcrud->fields('id,status,bukti_pembayaran,tanggal,user_id,kode_transaksi', true);
$xcrud->fields('id,status,tanggal,user_id,kode_transaksi', true, false, 'create');
$xcrud->fields('id,status,tanggal', false, false, 'view');
$xcrud->columns('id,id_pendaftaran_nikah,tujuan_kua,tanggal,status');
$xcrud->before_insert('rekomendasi_beforeinsert');
$xcrud->highlight('status', '=', 'Menunggu Di Proses', '', 'alert alert-danger');
$xcrud->highlight('status', '=', 'Pengajuan Di Proses', '', 'alert alert-warning');
$xcrud->highlight('status', '=', 'Proses Selesai', '', 'alert alert-success');
$xcrud->label([
    'id' => 'Nomor Rekomendasi',
    'id_pendaftaran_nikah' => 'Nomor Pendaftaran',
    'tujuan_kua' => 'Kua Tujuan'
]);
$crudrender = $xcrud->render(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="callout callout-warning">
            <h4 class="animate__animated animate__bounceIn">Informasi</h4>
            <ul class="animate__animatee animate__headShake animate__infinite">
                <li>
                    <p>Sebelum meminta surat rekomendasi nikah harap melakukan pendaftaran nikah terlebih dahulu.</p>
                </li>
                <li>Harap Melakukan pembayaran sebesar <b>Rp 600.000</b> Agar proses pendaftaran dapat di proses</li>
            </ul>
        </div>
    </div>
</div>
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
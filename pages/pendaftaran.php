<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';
// echo Xcrud::load_css();
// echo Xcrud::load_js();
$xcrud = Xcrud::get_instance();
$xcrud->table('tbl_daftar_nikah');

$sql = "SELECT * FROM tbl_daftar_nikah WHERE user_id=$nik";
$stmt = $connectdb->query($sql);
//Fetch row.
$data = $stmt->fetch_assoc();

// config
$xcrud->change_type('kewarganegaraan_calsu', 'select', 'Silahkan Pilih', 'WNI,WNA');
$xcrud->change_type('status_calsu', 'select', 'Silahkan Pilih', 'Duda,Belum Menikah');
$xcrud->change_type('agama_calsu', 'select', 'Silahkan Pilih', 'Islam,Kristen Protestan,Kristen Katolik,Hindu, Budha');
$xcrud->change_type('tanggal_lahir_calsu', 'date');
$xcrud->change_type('pendidikan_terakhir_calsu', 'select', 'Silahkan Pilih', 'Tidak Tamat Sekolah,SD,SMP,SMA/Sederajat,D3,S1,S2,S3');

$xcrud->change_type('kewarganegaraan_calis', 'select', 'Silahkan Pilih', 'WNI,WNA');
$xcrud->change_type('status_calis', 'select', 'Silahkan Pilih', 'Janda,Belum Menikah');
$xcrud->change_type('tanggal_lahir_calis', 'date');
$xcrud->change_type('agama_calis', 'select', 'Silahkan Pilih', 'Islam,Kristen Protestan,Kristen Katolik,Hindu, Budha');
$xcrud->change_type('pendidikan_terakhir_calis', 'select', 'Silahkan Pilih', 'Tidak Tamat Sekolah,SD,SMP,SMA/Sederajat,D3,S1,S2,S3');

$xcrud->change_type('tanggal_nikah_m', 'date');
$xcrud->change_type('tempat_menikah', 'radio', 'Dirumah', 'Dirumah, Di Kua, Di Kua Wilayah Lain');
$xcrud->change_type('jam_nikah', 'time');
$xcrud->change_type('foto_latar_gandeng', 'image');
$xcrud->change_type('foto_calsu', 'image');
$xcrud->change_type('foto_calis', 'image');
$xcrud->change_type('berkas_diperlukan', 'file');
$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();

if ($role == "ADMIN") {
    $xcrud->unset_add();
    $xcrud->unset_edit();
    $xcrud->unset_remove();
    $xcrud->button('scripts/surat-daftar?n={id_daftar}', 'cetak surat', 'fa fa-print', 'btn btn-info', '', array('status', '=', 'Ditolak'));
    $xcrud->button('dashboard?pages=tolak-daftar&id={id_daftar}', 'tolak pendaftaran', 'fa fa-times', 'btn btn-danger', '', array('status', '=', 'Menunggu Di Proses'));
    $xcrud->button('dashboard?pages=upload-bayar-r&id={id_daftar}', 'Bukti Pembayaran', 'fa fa-money', 'btn btn-secondary',);
    $xcrud->button('scripts/verif-daftar?n={id_daftar}', 'terima pendaftaran', 'fa fa-check', 'btn btn-success', '', array('status', '=', 'Menunggu Di Proses'));
} else {
    $xcrud->where('user_id=', $nik);
    $xcrud->button('scripts/surat-daftar?n={id_daftar}', 'download surat', 'fa fa-download', 'btn btn-info', '', array('status', '=', 'Ditolak'));
    $xcrud->button('scripts/surat-berhasil-daftar?n={id_daftar}', 'download surat pendaftaran', 'fa fa-download', 'btn btn-success', '', array('status', '=', 'Pendaftaran Berhasil'));
    $xcrud->button('dashboard?pages=upload-bayar-r&id={id_daftar}', 'Bukti Pembayaran', 'fa fa-money', 'btn btn-secondary',);
    // tidak bisa edit ketika sudah meupload bukti transfer
    $xcrud->unset_edit(true, 'status', '!=', 'Menunggu Pembayaran');
    $xcrud->unset_edit(false, 'status', '=', 'Ditolak');
    // tidak bisa hapus ketika sudah meupload bukti transfer
    $xcrud->unset_remove(true, 'status', '!=', 'Menunggu Pembayaran');
    $xcrud->before_update('nikah_beforeupdate');
}



$xcrud->fields(
    'kewarganegaraan_calsu,
    nik_calsu,
    nama_calsu,
    tempat_lahir_calsu,
    tanggal_lahir_calsu,
    umur_calsu,
    status_calsu,
    agama_calsu,
    alamat_calsu,
    pendidikan_terakhir_calsu',
    false,
    'Data Suami'
);
$xcrud->fields(
    'kewarganegaraan_calis,
    nik_calis,
    nama_calis,
    tempat_lahir_calis,
    tanggal_lahir_calis,
    umur_calis,
    status_calis,
    agama_calis,
    alamat_calis,
    pendidikan_terakhir_calis',
    false,
    'Data Istri'
);
$xcrud->fields(
    'tempat_menikah,
    alamat_nikah,
    tanggal_nikah_m,
    jam_nikah,
    foto_calsu,
    foto_calis,
    foto_latar_gandeng,
    berkas_diperlukan',
    false,
    'Data Lainnya'
);

$xcrud->label(array(
    'id_daftar' => 'ID Pendaftaran',
    'kewarganegaraan_calsu' => 'Kewarganegaraan Catin Laki-Laki',
    'nik_calsu' => 'NIK Catin Laki-Laki',
    'nama_calsu' => 'Nama Catin Laki-Laki',
    'tempat_lahir_calsu' => 'Tempat Lahir Catin Laki-Laki',
    'tanggal_lahir_calsu' => 'Tgl Lahir Laki-Laki',
    'umur_calsu' => 'Umur Catin Laki-Laki',
    'status_calsu' => 'Status Catin Laki-Laki',
    'agama_calsu' => 'Agama Catin Laki-Laki',
    'alamat_calsu' => 'Alamat Catin Laki-Laki',
    'pendidikan_terakhir_calsu' => 'Pendidikan Terakhir Catin Laki-Laki',
    'foto_calsu' => 'Foto Catin Laki-Laki',
    'kewarganegaraan_calis' => 'Kewarganegaraan Catin Perempuan',
    'nik_calis' => 'NIK Catin Perempuan',
    'nama_calis' => 'Nama Catin Perempuan',
    'tempat_lahir_calis' => 'Tempat Lahir Catin Perempuan',
    'tanggal_lahir_calis' => 'Tgl Lahir Perempuan',
    'umur_calis' => 'Umur Catin Perempuan',
    'status_calis' => 'Status Catin Perempuan',
    'agama_calis' => 'Agama Catin Perempuan',
    'alamat_calis' => 'Alamat Catin Perempuan',
    'pendidikan_terakhir_calis' => 'Pendidikan Terakhir Catin Perempuan',
    'foto_calis' => 'Foto Catin Perempuan',
    'tanggal_nikah_m' => 'Tanggal Nikah'
));
$xcrud->fields('status,tanggal_daftar,id_daftar', false, true, 'view');
$xcrud->columns('id_daftar,tanggal_daftar,nama_calsu,nama_calis,tanggal_nikah_m,status');
$xcrud->before_insert('nikah_beforeinsert');
$crudrender = $xcrud->render(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <h4 class="animate__animated animate__bounceIn">Informasi</h4>

            <ul class="animate__animatee animate__headShake animate__infinite">
                <li>
                    <p>Jika Anda ingin melakukan pernikahan di luar wilayah KUA Kec. Banjarmasin Timur harap meminta surat rekomendasi nikah ketempat yang ingin di tuju</p>
                </li>
                <li>Harap Melakukan pembayaran sebesar <b>Rp 600.000</b> Agar proses pendaftaran dapat di proses</li>
                <li>Sebelum Melakukan Pembayaran Pastikan semua data yang anda masukkan sudah benar</li>
                <li>Jika anda melakukan pernikahan di kantor kua kami harap isi form alamat dengan tanda strip ( <b>-</b> )</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Data Pendaftaran Nikah </h3>
            </div>
            <div class="box-body">
                <?php
                echo $crudrender; ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
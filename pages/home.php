<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <h4 class="animate__animated animate__bounceIn">Selamat Datang di Sistem Informasi Administrasi Kantor Urusan Agama Kec. Banjarmasin Timur</h4>

            <p class="animate__animated animate__headShake animate__infinite">Silahkan ikut petunjuk pengguna yang ada di bagian bawah ini.</p>
        </div>
    </div>
</div>
<?php if ($role == "ADMIN") : ?>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">CPU Traffic</span>
                    <span class="info-box-number">90<small>%</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
<?php endif ?>
<?php if ($role != "ADMIN") : ?>
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Petunjuk Penggunaan</h2>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Pendaftaran Nikah</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Rekomendasi Nikah</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Dispensasi Nikah</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <b>Berkas Yang harus di lampirkan</b>
                        <ol>
                            <li>Pengantar Nikah dari Desa/Kelurahan</li>
                            <li>Fotokopi KTP,KK, KTP Wali Nikah</li>
                            <li>Fotokopi Akta Kelahiran/Ijasah</li>
                            <li>Foto Gandeng Berlatar Biru</li>
                            <li>Fotokopi Buku Nikah Orang Tua</li>
                            <li>Surat Pernyataan Belum Menikah</li>
                            <li>Surat Keterangan Imunisasi</li>
                            <li>Akte Cerai/Ket Kematian</li>
                            <li>Surat Rekomendasi Bagi Mempelai dari Luar Wilayah</li>
                        </ol>
                        <strong>Semua dijadikan satu berkas file dengan format PDF</strong>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <p>Surat numpang nikah adalah surat rekomendasi yang dijadikan syarat ketika seseorang akan melangsungkan pernikahan di luar wilayah tempat tinggalnya.</p>
                        <strong>Berikut Berkas yang Harus Dilampirkan:</strong>
                        <ol>
                            <li>Surat permohonan dari catin</li>
                            <li>Surat pengantar nikah dari desa/kelurahan tempat tinggal catin</li>
                            <li>Fotokopi akta kelahiran catin</li>
                            <li>Fotokopi KTP dan KK catin</li>
                            <li>Izin tertulis orang tua atau wali bagi catin yang belum mencapai usia 21</li>
                            <li>Izin dari wali yang memelihara untuk syarat (5) jika orang tua mati atau tidak mampu menyampaikan kehendaknya</li>
                            <li>Surat izin dari atasan atau kesatuan jika calon mempelai berstatus anggota TNI atau POLRI</li>
                            <li>Penetapan izin poligami dari pengadilan agama bagi suami yang hendak beristri lebih dari seorang</li>
                            <li>Akta cerai atau kutipan buku pendaftaran talak atau buku pendaftaran cerai bagi mereka yang perceraiannya terjadi sebelum berlakunya UU No.7 Tahun 1989 tentang Peradilan Agama</li>
                            <li>Akta kematian atau surat keterangan kematian suami atau istri dibuat oleh Kepala Desa/Lurah bagi janda/duda ditinggal mati</li>
                        </ol>
                        <strong>Semua dijadikan satu berkas file dengan format PDF</strong>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        <p>Dispensasi nikah merupakan upaya bagi mereka yang ingin menikah namun belum mencukupi batas usia untuk menikah yang telah ditetapkan oleh pemerintah, sehingga orang tua bagi anak yang belum cukup umurnya tersebut bisa mengajukan dispensasi nikah ke Pengadilan Agama melalui proses persidangan terlebih dahulu agar mendapatkan izin dispensasi perkawinan. Singkatnya dispensasi nikah ini merupakan kelonggaran hukum bagi mereka yang tidak memenuhi syarat sah perkawinan secara hukum positif, oleh karena itu undang-undang memberikan kewenangan kepada pengadilan untuk memberikan dispensasi nikah.</p>
                        <p>Untuk dispensasi nikah pengguna dapat mengunduh file suratnya di menu pendaftaran nikah jika status pendaftaran anda <b>Dispensasi</b></p>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>
<?php endif ?>
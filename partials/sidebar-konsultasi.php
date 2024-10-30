<div class="col-md-3">
    <?php if (isset($_GET['pages'])) : ?>
        <?php if ($_GET['pages'] == "konsultasi") : ?>
            <a href="dashboard?pages=create-pesan" class="btn btn-primary btn-block margin-bottom">Buat Pesan</a>
        <?php else : ?>
            <a href="dashboard?pages=konsultasi" class="btn btn-primary btn-block margin-bottom">Kembali Ke Pesan Masuk</a>
        <?php endif ?>
    <?php endif ?>


    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Folders</h3>

            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                <li <?php if ($page == "Konsultasi Nikah") : ?>class="active" <?php endif ?>>
                    <a href="dashboard?pages=konsultasi"><i class="fa fa-inbox"></i> Pesan Masuk
                        <span class="label label-primary pull-right">12</span></a>
                </li>
                <li <?php if ($page == "Pesan Keluar") : ?>class="active" <?php endif ?>>
                    <a href="dashboard?pages=pesan-keluar"><i class="fa fa-envelope-o"></i> Pesan Keluar</a>
                </li>
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /. box -->
</div>
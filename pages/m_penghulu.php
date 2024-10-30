<?php
// load xcrud
include 'library/xcrud/xcrud.php';
include_once 'library/xcrud/functions.php';
// echo Xcrud::load_css();
// echo Xcrud::load_js();
$xcrud = Xcrud::get_instance();
$xcrud->table('tbl_penghulu');
$xcrud->change_type('foto', 'image');
$xcrud->unset_title();
$xcrud->unset_csv();
$xcrud->unset_print();
$crudrender = $xcrud->render();
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $page ?></h3>
            </div>
            <div class="box-body">
                <?php echo $crudrender; ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
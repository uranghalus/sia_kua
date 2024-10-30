<?php if (isset($_GET['pages'])) : ?>
    <?php if ($_GET['pages'] == "konsultasi") : ?>
        <section class="content-header">
            <h1>
                <?= $page ?>
                <small>13 new messages</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><?= $page ?></li>
            </ol>
        </section>
    <?php else : ?>
        <section class="content-header">
            <h1>
                Dashboard
                <small><?= $page ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active"><?= $page ?></li>
            </ol>
        </section>
    <?php endif ?>
<?php endif ?>
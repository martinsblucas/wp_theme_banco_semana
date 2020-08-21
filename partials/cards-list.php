<?php

use App\Controllers\ArchiveController as Controller;
use App\View\CardsView as View;

$controller = new Controller;
$data = $controller->data;

array_key_exists('metas', $data) ? $metas = $data['metas'] : $metas = [];
array_key_exists('paged', $data) ? $paged = $data['paged'] : $paged = null;

if(array_key_exists('posts', $data)) {
    $view = new View($data['posts'], $metas, $paged);
    $views = (array)$view->views;
}

?>

<section class="row archive">

    <?php if(array_key_exists('posts', $data)) { ?>

    <div class="col-12 archive-header">
        <h3><?= $data['title']; ?> <span class="badge badge-secondary" style="font-size: 14px; font-weight: 300"><?= $data['total']; ?></span></h3>
    </div>

    <div class="col-12 archive-body">
        <div class="card-group-banco row">
            <?php foreach ($views as $view) { echo $view; } ?>
        </div>
    </div>

    <div class="col-12">

        <div class="d-none justify-content-center" id="Loading">

            <img src="<?= get_template_directory_uri(); ?>/assets/img/loading.gif" width="60" class="py-3">

        </div>

    </div>

    <?php } else { get_template_part('partials/content', 'none'); } ?>

</section>
<?php

use App\Controllers\PageController;

$controller = new PageController();
$data = $controller->getData();

$terms = $controller->getTerms();

?>

<div class="row m-0 justify-content-center">

    <div class="col-md-8">

        <div class="card card-outline-secondary">
            <div class="card-header">
                <h2 class="mb-0"><?= $data['post']->post_title; ?></h2>
            </div>
            <div class="card-body">
                <?= $data['post']->post_content; ?>
                <?php

                if ($terms) { ?>

                    <div class="row">

                        <?php foreach ($terms as $key => $term) { ?>

                            <div class="col-md-6 col-lg-4 tags-cloud mb-2">
                                <a class="d-block btn btn-banco btn-banco-primary" href="<?= get_term_link($term->term_id) ?>"><?= $term->name; ?></a>
                            </div>

                        <?php } ?>

                    </div>

                <?php } ?>
            </div>
        </div>

    </div>


</div>
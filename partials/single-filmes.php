<?php


use App\Controllers\SingleFilmesController as Controller;


$controller = new Controller;
$data = $controller->data;

array_key_exists('post', $data) ? $post = $data['post'] : $post = null;

array_key_exists('metas', $data) ? $metas = $data['metas'] : $metas = [];

array_key_exists('header', $metas) ? $metasHeader = $data['metas']['header'] : $metasHeader = [];

array_key_exists('ficha', $metas) ? $metasFicha = $data['metas']['ficha'] : $metasFicha = [];

$tax = array_key_exists('tax', $data) ? $data['tax'] : false;

array_key_exists('premios', $metas) ? $premios = $data['metas']['premios'] : $premios = [];

array_key_exists('videos', $metas) ? $videos = $data['metas']['videos'] : $videos = [];

$teaser = array_key_exists('teaser-url', $videos) ? $videos['teaser-url']['meta'] : null;

$movie = array_key_exists('teaser-url', $videos) ? $videos['movie-url']['meta'] : null;

$clIndicativa = array_key_exists('cl-indicativa', $metasHeader) ? 'Classificação ' . $data['metas']['header']['cl-indicativa']['meta'] . ' anos' : 'Classificação Livre';

$contato = array_key_exists('contato', $metas) ? $data['metas']['contato'] : null;

$biofilmografias = $data['metas']['biofilmografias'] ? $data['metas']['biofilmografias'] : [];

?>


<?php if ($post) { ?>


    <section class="single">

        <div class="row filme m-0">

            <div class="col-12">

                <div class="filme-header">

                    <div class="row m-0">

                        <div class="filme-thumb col-12 col-md-7 d-flex align-items-center justify-content-center p-0">

                            <div class="card">

                                <div class="card-img">

                                    <?php if ($data['img-sm']) { ?>

                                        <img class="img-fluid thumbnail d-block d-md-none" src="<?= $data['img-sm']; ?>">

                                    <?php } ?>

                                    <?php if ($data['img']) { ?>

                                        <img class="img-fluid thumbnail d-none d-md-block" src="<?= $data['img']; ?>">

                                    <?php } ?>

                                </div>

                                <div class="card-img-overlay">

                                    <?php if ($teaser) { ?>

                                        <button class="btn btn-banco btn-banco-primary" type="button"
                                                data-toggle="modal" data-target="#TeaserModal"><i
                                                    class="fas fa-video"></i> Assistir teaser
                                        </button>

                                        <div class="modal fade" id="TeaserModal" tabindex="-1" role="dialog"
                                             aria-labelledby="TeaserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="TeaserModalLabel">Teaser</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Fechar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                        global $wp_embed;
                                                        echo $wp_embed->run_shortcode('[embed]' . $teaser . '[/embed]'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>

                                    <?php if ($movie) { ?>

                                    <button class="btn btn-lg btn-banco btn-banco-primary" type="button" data-toggle="modal"
                                            data-target="#MovieModal"><i class="fas fa-film"></i> Assistir Filme
                                    </button>

                                    <div class="modal fade" id="MovieModal" tabindex="-1" role="dialog"
                                         aria-labelledby="MovieModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="MovieModalLabel">Filme</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <?php

                                                    if(is_user_logged_in()) {

                                                        global $wp_embed;
                                                        echo $wp_embed->run_shortcode('[embed]' . $movie . '[/embed]');

                                                    } else { get_template_part('partials/login-form'); } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>

                            </div>


                        </div>

                    </div>

                    <div class="filme-infos col-12 col-md-5 d-flex align-items-center justify-content-center">

                        <div>

                            <h2><?= $post->post_title; ?></h2>

                            <h4><?= $metasHeader['direcao']['label']; ?></h4>

                            <h3 class="mb-4"><?= $metasHeader['direcao']['meta']; ?></h3>

                            <h3 class="d-inline-block mt-3"><?= $metasHeader['duracao']['meta'] . ' ' . $metasHeader['duracao']['after'] ?>
                                . <?= $metasHeader['ano']['meta']; ?> . <?= $metasHeader['origem']['meta']; ?></h3>

                            <h4>Sinopse</h4>

                            <p><?= $post->post_content; ?></p>

                            <h5><?= $clIndicativa; ?></h5>

                            <?php

                            if($tax) {

                                foreach ($tax as $key => $taxonomy) { ?>

                                    <p class="filme-tax mt-3"><span class="tax-label"><?= $taxonomy['label'] ?>: </span><span
                                                class="tax-list">


                                            <?php foreach ($taxonomy['terms'] as $termKey => $term) {

                                                $colon = array_key_last((array) $taxonomy['terms']) === $termKey ? '' : ', ';

                                                ?>

                                            <span class="tax-item"><a href="<?= get_term_link($term->term_id); ?>"><?= $term->name; ?></a><?= $colon ?></span>

                                            <?php } ?>

                                        </span></p>

                                    <?php

                                }

                            }

                            ?>


                        </div>

                    </div>


                </div>

            </div>

        </div>

        <div class="col-12 col-md-7">

            <div class="filme-ficha">

                <?php if (count($metasFicha) > 0 and $metasFicha[0]['meta'] != null) { ?>

                    <h4>Ficha técnica</h4>

                    <ul class="list-group list-group-ficha">

                        <?php
                        foreach ($metasFicha as $key => $meta) {
                            if ($meta['meta'] != null) { ?>

                                <li class="list-group-item list-group-ficha-item">

                                    <div class="label"><?= $meta['label'] ?></div>
                                    <div class="meta"><?= $meta['meta'] ?></div>

                                </li>

                            <?php }
                        } ?>

                    </ul>

                <?php } ?>

                <?php

                if (count($premios) > 0 and $premios['meta'][0] != null) { ?>

                    <h4>Festivais e prêmios</h4>

                    <ul class="list-group list-group-premios">

                        <?php foreach ($premios['meta'] as $key => $premio) { ?>

                            <li class="list-group-item list-group-premios-item">

                                <?= $premio; ?>

                            </li>

                        <?php } ?>

                    </ul>

                <?php } ?>

            </div>

        </div>

        <?php if ($biofilmografias and $biofilmografias[0]->post_content != null) { ?>

            <div class="col-12 col-md-5">

                <div class="direcao">

                    <?php

                    $foto_direcao = get_the_post_thumbnail_url($biofilmografias[0]->ID, 'thumbnail') ? '<img class="img-fluid direcao-thumb" src="' . get_the_post_thumbnail_url($biofilmografias[0]->ID, 'thumbnail') . '">' : null;

                    echo $foto_direcao;

                    foreach ($biofilmografias as $biofilmografia) { ?>

                        <h4 class="direcao-title"><?= $biofilmografia->post_title; ?></h4>

                        <?= $biofilmografia->post_content; ?>

                    <?php } ?>


                    <?php if ($contato and $contato['meta'] != null) { ?>

                        <div class="direcao-contato">

                            <div class="label"><?= $contato['label']; ?></div>
                            <div class="meta">
                                <?= $contato['meta']; ?>
                            </div>

                        </div>

                    <?php } ?>

                </div>

            </div>

        <?php } ?>

        </div>


    </section>


<?php } ?>


<?php if($_GET and $_GET['action'] === 'movie') { ?>

    <script>

        jQuery(document).ready(r => {

            jQuery('#MovieModal').modal('show');

        });

    </script>

<?php } ?>
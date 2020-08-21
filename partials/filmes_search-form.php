<?php


use App\Controllers\FilmesSearchFormController as Controller;

$controller = new Controller;

$data = $controller->data;


$display = $data['has_query_var'] ? 'block' : 'none';

$btn_active = $data['has_query_var'] ? 'active' : null;


?>


<section class="row search">
    <div class="col-12 search-form">

        <form method="get" action="<?= get_post_type_archive_link('filmes'); ?>">

            <div class="form-group">

                <div class="input-group p-2">
                    <label class="sr-only" for="search">Digite aqui sua pesquisa</label>
                    <input class="form-control" type="text" name="s" id="search" value="<?= get_search_query(); ?>" placeholder="Digite aqui sua pesquisa">
                    <div class="input-group-append">
                        <button type="submit" class="btn mx-2 btn-banco btn-banco-tertiary"><span>Pesquisar</span><i class="fas fa-search ml-2"></i></button>
                        <button class="btn btn-banco btn-banco-tertiary btn-pesquisa_avancada <?= $btn_active; ?>"><span class="d-none d-md-inline">Pesquisa avançada</span><i class="fas fa-chevron-right ml-md-2"></i></button>
                    </div>
                </div>

            </div>

            <div>

                <div class="p-2" style="display: <?= $display; ?>" id="pesquisaAvancada">

                    <?php if(key_exists('diretores', $data)) { ?>

                        <div class="form-group" id="formDirecao">

                            <label for="direcao" class="sr-only">Diretor</label>

                            <select class="form-group" multiple id="direcao">
                                <?php while($data['diretores']->have_posts()) { ?>
                                    <?php $data['diretores']->the_post(); ?>
                                    <option value="<?= the_ID(); ?>" <?php echo get_the_ID() == get_query_var( 'direcao', FALSE ) ? 'selected' : null ?>><?php echo the_title(); ?></option>
                                <?php } ?>
                            </select>

                            <input type="hidden" name="direcao" value="<?= get_query_var( 'direcao', FALSE ) ?>">

                        </div>

                    <?php } ?>



                    <?php if(key_exists('filtros', $data)) { ?>

                        <div class="form-group">

                            <label class="sr-only" for="filtros">Filtros</label>

                            <select name="filtros_ids[]" multiple id="filtros">


                                <?php foreach ($data['filtros'] as $key => $filtro) { ?>

                                    <option value="<?php echo $filtro->term_id; ?>"
                                        <?php if(get_query_var('filtros_ids') && in_array($filtro->term_id, get_query_var( 'filtros_ids', FALSE))) { echo 'selected'; } ?>
                                    ><?php echo $filtro->name; ?></option>

                                <?php } ?>


                            </select>


                        </div>

                    <?php } ?>



                    <?php if(key_exists('temas', $data)) { ?>

                        <div class="form-group">

                            <label class="sr-only" for="temas">Temas</label>

                            <select name="temas_ids[]" multiple id="temas">

                                <?php foreach ($data['temas'] as $key => $tema) { ?>

                                    <option value="<?= $tema->term_id; ?>"
                                        <?php if(get_query_var('temas_ids') && in_array($tema->term_id, get_query_var( 'temas_ids', FALSE))) { echo 'selected'; } ?>
                                    ><?= $tema->name; ?></option>

                                <?php } ?>


                            </select>


                        </div>

                    <?php } ?>



                    <?php if(key_exists('raca_e_genero', $data)) { ?>

                        <div class="form-group">

                            <label class="sr-only" for="raca_e_genero">Raça e Gênero</label>

                            <select name="raca-e-genero_ids[]" multiple id="raca_e_genero">

                                <?php foreach ($data['raca_e_genero'] as $key => $raca_e_genero) { ?>

                                    <option value="<?= $raca_e_genero->term_id; ?>"
                                        <?php if(get_query_var('raca-e-genero_ids') && in_array($raca_e_genero->term_id, get_query_var( 'raca-e-genero_ids', FALSE))) { echo 'selected'; } ?>
                                    ><?= $raca_e_genero->name; ?></option>

                                <?php } ?>


                            </select>


                        </div>

                    <?php } ?>



                    <?php if(key_exists('genero', $data)) { ?>

                        <div class="form-group">

                            <label class="sr-only" for="genero">Gênero</label>

                            <select name="genero_ids[]" multiple id="genero">

                                <?php foreach ($data['genero'] as $key => $genero) { ?>

                                    <option value="<?= $genero->term_id; ?>"
                                        <?php if(get_query_var('genero_ids') && in_array($genero->term_id, get_query_var( 'genero_ids', FALSE))) { echo 'selected'; } ?>
                                    ><?= $genero->name; ?></option>

                                <?php } ?>


                            </select>


                        </div>

                    <?php } ?>

                </div>
            </div>

        </form>

    </div>
</section>
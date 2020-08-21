<?php get_header(); ?>

    <main id="main" class="container-fluid">
        <div class="container">
            <?php if(is_singular('filmes')) {
                get_template_part('partials/single', 'filmes');
            }
            elseif (is_singular('post')) {
                get_template_part('partials/page');
            }
            else {
                get_template_part('partials/404');
            }
            ?>
        </div>
    </main>

<?php get_footer(); ?>
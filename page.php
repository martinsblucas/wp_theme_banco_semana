<?php get_header(); ?>

    <main id="main" class="container-fluid">
        <div class="container">
            <section class="page <?= $post->post_name; ?>">

                <?php
                $slug = $post->post_name;
                switch ($slug) {
                    case 'cadastrar-exibidor' :
                        get_template_part('partials/editar', 'exibidor');
                        break;
                    case 'editar-perfil' :
                        if (is_user_logged_in()) {
                            get_template_part('partials/editar', 'exibidor');
                        } else {
                            get_template_part('partials/401');
                        };
                        break;
                    case 'entre-em-contato' : {
                        get_template_part('partials/contact', 'form');
                        break;
                    }
                    default :
                        get_template_part('partials/page');
                        break;
                }
                ?>
            </section>
        </div>
    </main>

<?php get_footer(); ?>
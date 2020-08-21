<?php


namespace App\Controllers;


class ScriptsEnqueueController
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    private function register_scripts()
    {

        wp_register_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap/bootstrap.min.js', ['jquery'], 1.2, true);
        wp_register_script('popper', get_template_directory_uri() . '/assets/js/popper/popper.min.js', ['jquery'], 1.2, true);
        wp_register_script('multiselect', get_template_directory_uri() . '/assets/js/jquery/jquery.multiselect.js', ['jquery'], 1.2, true);
        wp_register_script('menu', get_template_directory_uri() . '/assets/js/menu.js', ['jquery'], 1.2, true);
        wp_register_script('load-more', get_template_directory_uri() . '/assets/js/load-more.js', ['jquery'], 1.2, true);
        wp_register_script('filmes-select', get_template_directory_uri() . '/assets/js/filmes-select.js', ['jquery'], 1.2, true);
        wp_register_script('elements-load', get_template_directory_uri() . '/assets/js/elements-load.js', ['jquery'], 1.2, true);
        wp_register_script('authenticate-user', get_template_directory_uri() . '/assets/js/authenticate-user.js', ['jquery'], 1.2, true);
        wp_register_script('change-pass', get_template_directory_uri() . '/assets/js/change-pass.js', ['jquery'], 1.2, true);
        wp_register_script('send-email', get_template_directory_uri() . '/assets/js/send-email.js', ['jquery'], 1.2, true);
    }

    public function enqueue_scripts()
    {
        $this->register_scripts();
        wp_enqueue_script('bootstrap');
        wp_enqueue_script('popper');
        wp_enqueue_script('multiselect');
        wp_enqueue_script('menu');
        wp_enqueue_script('load-more');
        wp_enqueue_script('filmes-select');
        wp_enqueue_script('elements-load');
        wp_enqueue_script('authenticate-user');
        wp_enqueue_script('change-pass');
        wp_enqueue_script('send-email');
    }
}
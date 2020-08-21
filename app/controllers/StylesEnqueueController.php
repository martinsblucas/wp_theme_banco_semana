<?php


namespace App\Controllers;


class StylesEnqueueController
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }

    private function register_styles()
    {
        wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css-3rd/bootstrap/bootstrap.min.css', false,1.3,'all' );
        wp_register_style('banco-de-obras', get_stylesheet_uri(), false, 1.3, 'all' );
        wp_register_style( 'layout', get_template_directory_uri() . '/assets/smacss/module/layout.css',false,1.3,'all' );
        wp_register_style( 'btn-banco', get_template_directory_uri() . '/assets/smacss/module/btn-banco/btn-banco.css',false,1.3,'all' );
        wp_register_style( 'base', get_template_directory_uri() . '/assets/smacss/base.css',false,1.3,'all' );
        wp_register_style( 'font-poppins', 'https://fonts.googleapis.com/css?family=Poppins:400,400i,700,700i&display=swap',false,1.3,'all' );
        wp_register_style( 'all', get_template_directory_uri() . '/assets/font/font-awesome/all.min.css',false,1.3,'all' );
        wp_register_style( 'icons', get_template_directory_uri() . '/assets/smacss/icons.css',false,1.3,'all' );
        wp_register_style( 'shiv', 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js',false,1.3,'all' );
        wp_register_style( 'respond', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js',false,1.3,'all' );
        global $wp_styles;
        $wp_styles->add_data( 'shiv', 'conditional', 'IE' );
        $wp_styles->add_data( 'respond', 'conditional', 'IE' );
        wp_register_style( 'header', get_template_directory_uri() . '/assets/smacss/module/header/header.css',false,1.3,'all' );
        wp_register_style( 'navbar-banco', get_template_directory_uri() . '/assets/smacss/module/header/navbar-banco.css',false,1.3,'all' );
        wp_register_style( 'main', get_template_directory_uri() . '/assets/smacss/module/main/main.css',false,1.3,'all' );
        wp_register_style( 'card-group-banco', get_template_directory_uri() . '/assets/smacss/module/main/card-group-banco.css',false,1.3,'all' );
        wp_register_style( 'jumbotron-banco', get_template_directory_uri() . '/assets/smacss/module/main/jumbotron-banco.css',false,1.3,'all' );
        wp_register_style( 'single-filmes', get_template_directory_uri() . '/assets/smacss/module/main/single-filmes.css',false,1.3,'all' );
        wp_register_style( 'search', get_template_directory_uri() . '/assets/smacss/module/search/search.css',false,1.3,'all' );
        wp_register_style( 'search-form', get_template_directory_uri() . '/assets/smacss/module/search/search-form.css',false,1.3,'all' );
        wp_register_style( 'footer', get_template_directory_uri() . '/assets/smacss/module/footer/footer.css',false,1.3,'all' );
        wp_register_style( 'footer-bar', get_template_directory_uri() . '/assets/smacss/module/footer/footer-bar.css',false,1.3,'all' );
        wp_register_style( 'list-group-footer-banco', get_template_directory_uri() . '/assets/smacss/module/footer/list-group-footer-banco.css',false,1.3,'all' );
        wp_register_style( 'tags-cloud', get_template_directory_uri() . '/assets/smacss/module/main/tags-cloud.css',false,1.3,'all' );
        wp_register_style( 'login-form', get_template_directory_uri() . '/assets/smacss/module/main/login-form.css',false,1.3,'all' );
    }

    public function enqueue_styles()
    {
        $this->register_styles();
        wp_enqueue_style('bootstrap');
        wp_enqueue_style('banco-de-obras');
        wp_enqueue_style('layout');
        wp_enqueue_style('btn-banco');
        wp_enqueue_style('base');
        wp_enqueue_style('font-poppins');
        wp_enqueue_style('all');
        wp_enqueue_style('icons');
        wp_enqueue_style('shiv');
        wp_enqueue_style('respond');
        wp_enqueue_style('header');
        wp_enqueue_style('navbar-banco');
        wp_enqueue_style('main');
        wp_enqueue_style('card-group-banco');
        wp_enqueue_style('jumbotron-banco');
        wp_enqueue_style('single-filmes');
        wp_enqueue_style('search');
        wp_enqueue_style('search-form');
        wp_enqueue_style('footer');
        wp_enqueue_style('footer-bar');
        wp_enqueue_style('list-group-footer-banco');
        wp_enqueue_style('tags-cloud');
        wp_enqueue_style('login-form');
    }
}
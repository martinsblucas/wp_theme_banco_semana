<?php


namespace App\Controllers;


class RegisterMenusController
{

    public $data;

    public function __construct()
    {

        add_action( 'after_setup_theme', [$this, 'register_nav_menus'], 0 );
        add_action( 'after_setup_theme', [$this, 'register_navwalker'], 1 );

    }

    public function register_nav_menus()
    {

        return register_nav_menus( [
            'primary_menu' => __( 'Primary Menu', 'banco_semana' )
        ] );

    }

    public function register_navwalker()
    {

        return require_once (APP_DIR . 'util/WP_Bootstrap_Navwalker.php');

    }

}
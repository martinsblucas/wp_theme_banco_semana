<?php


namespace App\Controllers;


class LocalizeScriptsController
{

    public function __construct()
    {

        add_action( 'wp_enqueue_scripts', [$this, 'localize_scripts'] );

    }

    public function localize_scripts()
    {


        global $wp_query;


        $args = [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'posts_per_page' => get_option('posts_per_page'),
            'wp_query' => $wp_query
        ];

        wp_localize_script( 'load-more', 'bancoloadmore', $args );

        $args = [
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ];
        wp_localize_script( 'authenticate-user', 'authenticateuser', $args );

        $args = [
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ];
        wp_localize_script( 'send-email', 'sendemail', $args );


    }

}
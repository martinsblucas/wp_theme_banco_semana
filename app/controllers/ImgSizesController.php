<?php


namespace App\Controllers;

class ImgSizesController
{

    public function __construct()
    {
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'foto_noticia', 700, 520, true );
        add_image_size( 'foto_filme_grande', 800, 450, true );
    }

}
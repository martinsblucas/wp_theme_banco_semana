<?php


namespace App\Controllers;

use App\Util\WP_Bootstrap_Navwalker;

class NavbarController
{

    public function getMenu() {

        wp_nav_menu(
            ['theme_location'    => 'primary_menu',
                'depth'             => 3,
                'container'         => 'div',
                'container_class'   => 'menu-primary',
                'container_id'      => 'MenuPrimary',
                'menu_class'        => 'navbar-nav',
                'walker'            => new WP_Bootstrap_Navwalker]
        );

    }

}
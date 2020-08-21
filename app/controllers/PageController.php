<?php


namespace App\Controllers;


class PageController
{

    private $data;

    private $wp_query;


    public function __construct($custom_wp_query = '')
    {

        global $wp_query;

        $custom_wp_query ? $this->wp_query = $custom_wp_query : $this->wp_query = $wp_query;

        $this->data['post'] = $this->wp_query->posts[0];

        switch ($this->data['post']->post_name) {

            case 'temas' :
                $this->data['terms'] = get_terms([
                    'taxonomy' => 'temas'
                ]);
                break;
            case 'generos' :
                $this->data['terms'] = get_terms([
                    'taxonomy' => 'genero'
                ]);
                break;
            case 'por-raca-e-genero' :
                $this->data['terms'] = get_terms([
                    'taxonomy' => 'raca-e-genero'
                ]);
                break;

            default : null; break;

        }

    }

    public function getData()
    {

        return $this->data;

    }

    public function getTerms()
    {

        if(array_key_exists('terms', $this->data)) {

            return $this->data['terms'];

        }

        return false;

    }


}
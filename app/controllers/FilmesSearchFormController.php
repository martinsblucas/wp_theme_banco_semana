<?php


namespace App\Controllers;


class FilmesSearchFormController
{
    private $diretores;
    private $filtros;
    private $temas;
    private $raca_e_genero;
    private $genero;
    public $data;

    public function __construct()
    {
        $this->diretores = new \WP_Query([
            'post_type' => 'diretores',
            'posts_per_page' => -1,
            'orderby' => 'name',
            'order' => 'asc'
        ]);

        $this->filtros = get_terms([
            'taxonomy' => 'filtros'
        ]);
        $this->temas = get_terms([
            'taxonomy' => 'temas'
        ]);
        $this->raca_e_genero = get_terms([
            'taxonomy' => 'raca-e-genero'
        ]);
        $this->genero = get_terms([
            'taxonomy' => 'genero'
        ]);

        if($this->diretores->have_posts()) {
            $this->data['diretores'] = $this->diretores;
        }
        if (!empty($this->filtros)) {
            $this->data['filtros'] = $this->filtros;
        }
        if (!empty($this->temas)) {
            $this->data['temas'] = $this->temas;
        }
        if (!empty($this->raca_e_genero)) {
            $this->data['raca_e_genero'] = $this->raca_e_genero;
        }
        if (!empty($this->genero)) {
            $this->data['genero'] = $this->genero;
        }
        if(get_search_query() or get_query_var( 'direcao', FALSE ) or get_query_var( 'filtros_ids', FALSE) or get_query_var( 'temas_ids', FALSE) or get_query_var( 'raca-e-genero_ids', FALSE) or get_query_var( 'genero_ids', FALSE)) {
            $this->data['has_query_var'] =  true;
        } else {
            $this->data['has_query_var'] =  false;
        }

        wp_reset_postdata();
    }
}
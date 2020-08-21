<?php


namespace App\Controllers;


class SingleFilmesController
{

    public $data;

    public function __construct($custom_wp_query = '')
    {

        global $wp_query;

        $custom_wp_query ? $this->wp_query = $custom_wp_query : $this->wp_query = $wp_query;

        $this->data['post'] = $this->wp_query->posts[0];

        $this->data['img'] = get_the_post_thumbnail_url($this->data['post']->ID, 'foto_noticia') ? get_the_post_thumbnail_url($this->data['post']->ID, 'foto_noticia') : null;

        $this->data['img-sm'] = get_the_post_thumbnail_url($this->data['post']->ID, 'foto_filme_grande') ? get_the_post_thumbnail_url($this->data['post']->ID, 'foto_filme_grande') : null;

        if (get_post_meta($this->data['post']->ID, 'direcao', true)) {

            $direcaoArrIds[$this->data['post']->ID] = get_post_meta($this->data['post']->ID, 'direcao', true);

            $this->data['metas']['biofilmografias'] = $posts = get_posts( ['include' => $direcaoArrIds[$this->data['post']->ID], 'post_type' => 'diretores' ]);

            if (get_post_meta($this->data['post']->ID, 'contato', true)) {
                $this->data['metas']['contato'] = [
                    'label' => 'Contato',
                    'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'contato', true))
                ];
            };

            foreach ($direcaoArrIds[$this->data['post']->ID] as $direcaoPost) {

                $direcaoArrNames[$this->data['post']->ID][] = get_the_title($direcaoPost);
            }

            $this->data['metas']['header']['direcao'] = [
                'label' => 'Direção',
                'meta' => implode(', ', $direcaoArrNames[$this->data['post']->ID])
            ];
        };

        if (get_post_meta($this->data['post']->ID, 'duracao', true)) {
            $this->data['metas']['header']['duracao'] = [
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'duracao', true)),
                'after' => '&rsquo;'
            ];
        };

        if (get_post_meta($this->data['post']->ID, 'ano', true)) {
            $this->data['metas']['header']['ano'] = [
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'ano', true))
            ];
        };
        if (get_post_meta($this->data['post']->ID, 'origem', true)) {
            $this->data['metas']['header']['origem'] = [
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'origem', true))
            ];
        };
        if (get_post_meta($this->data['post']->ID, 'cl-indicativa', true)) {
            $this->data['metas']['header']['cl-indicativa'] = [
                'meta' => get_post_meta($this->data['post']->ID, 'cl-indicativa', true)[0]
            ];
        }
        if (get_post_meta($this->data['post']->ID, 'cl-indicativa', true)) {
            $this->data['metas']['header']['cl-indicativa'] = [
                'meta' => get_post_meta($this->data['post']->ID, 'cl-indicativa', true)[0]
            ];
        }
        if (get_the_terms($this->data['post']->ID, 'filtros')) {
            $this->data['tax']['filtros'] = [
                'label' => 'Filtros',
                'terms' => get_the_terms($this->data['post']->ID, 'filtros')
            ];
        }
        if (get_the_terms($this->data['post']->ID, 'temas')) {
            $this->data['tax']['temas'] = [
                'label' => 'Temas',
                'terms' => get_the_terms($this->data['post']->ID, 'temas')
            ];
        }
        if (get_the_terms($this->data['post']->ID, 'raca-e-genero')) {
            $this->data['tax']['raca-e-genero'] = [
                'label' => 'Por raça e gênero',
                'terms' => get_the_terms($this->data['post']->ID, 'raca-e-genero')
            ];
        }
        if (get_the_terms($this->data['post']->ID, 'genero')) {
            $this->data['tax']['genero'] = [
                'label' => 'Por gênero',
                'terms' => get_the_terms($this->data['post']->ID, 'genero')
            ];
        }
        if (get_post_meta($this->data['post']->ID, 'teaser-url', true)) {
            $this->data['metas']['videos']['teaser-url'] = [
                'label' => 'Teaser',
                'meta' => get_post_meta($this->data['post']->ID, 'teaser-url', true)[0]
            ];
        };
        if (get_post_meta($this->data['post']->ID, 'movie-url', true)) {
            $this->data['metas']['videos']['movie-url'] = [
                'label' => 'Filme',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'movie-url', true))
            ];
        };

        if(get_post_meta($this->data['post']->ID, 'roteiro', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Roteiro',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'roteiro', true)),
                'slug' => 'roteiro'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'producao', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Produção',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'producao', true)),
                'slug' => 'producao'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'co-producao', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Co-produção',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'co-producao', true)),
                'slug' => 'co-producao'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'co-producao', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Produtora Associada',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'produtora-associada', true)),
                'slug' => 'produtora-associada'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'producao-executiva', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Produção executiva',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'producao-executiva', true)),
                'slug' => 'producao-executiva'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'companhia-produtora', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Companhia Produtora',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'companhia-produtora', true)),
                'slug' => 'companhia-produtora'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'direcao-de-fotografia', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Direção de fotografia',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'direcao-de-fotografia', true)),
                'slug' => 'direcao-de-fotografia'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'fotografia', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Fotografia',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'fotografia', true)),
                'slug' => 'fotografia'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'montagem', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Montagem',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'montagem', true)),
                'slug' => 'montagem'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'direcao-de-arte', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Direção de arte',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'direcao-de-arte', true)),
                'slug' => 'direcao-de-arte'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'som', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Som',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'som', true)),
                'slug' => 'som'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'musicas', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Músicas',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'musicas', true)),
                'slug' => 'musicas'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'edicao-de-som', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Edição de som',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'edicao-de-som', true)),
                'slug' => 'edicao-de-som'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'trilha-sonora', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Trilha Sonora',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'trilha-sonora', true)),
                'slug' => 'trilha-sonora'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'figurino', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Figurino',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'figurino', true)),
                'slug' => 'figurino'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'design', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Design',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'design', true)),
                'slug' => 'design'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'maquiagem', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Maquiagem',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'maquiagem', true)),
                'slug' => 'maquiagem'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'correcao-de-cor', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Correção de cor',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'correcao-de-cor', true)),
                'slug' => 'correcao-de-cor'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'gravacao', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Gravação',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'gravacao', true)),
                'slug' => 'gravacao'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'camera', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Câmera',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'camera', true)),
                'slug' => 'camera'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'execucao-de-video-audio', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Execução de Vídeo-Áudio',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'execucao-de-video-audio', true)),
                'slug' => 'execucao-de-video-audio'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'implementacao-do-site', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Implementação do site',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'implementacao-do-site', true)),
                'slug' => 'implementacao-do-site'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'concessao-do-uso-da-cancao', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Concessão do uso da canção',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'concessao-do-uso-da-cancao', true)),
                'slug' => 'concessao-do-uso-da-cancao'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'voz', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Voz',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'voz', true)),
                'slug' => 'voz'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'curadoria', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Curadoria',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'curadoria', true)),
                'slug' => 'curadoria'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'mixagem', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Mixagem',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'mixagem', true)),
                'slug' => 'mixagem'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'efeitos-especiais', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Efeitos especiais',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'efeitos-especiais', true)),
                'slug' => 'efeitos-especiais'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'correcao-de-cor', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Animador',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'animador', true)),
                'slug' => 'animador'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'correcao-de-cor', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'Elenco',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'elenco', true)),
                'slug' => 'elenco'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'sd-foley', true)) {
            $this->data['metas']['ficha'][] = [
                'label' => 'SD e Foley',
                'meta' => implode(', ', get_post_meta($this->data['post']->ID, 'sd-foley', true)),
                'slug' => 'sd-foley'
            ];
        };
        if(get_post_meta($this->data['post']->ID, 'principais-exibicoes', true)) {
            $this->data['metas']['premios'] = [
                'meta' => get_post_meta($this->data['post']->ID, 'principais-exibicoes', true),
                'slug' => 'principais-exibicoes'
            ];
        };

    }

}
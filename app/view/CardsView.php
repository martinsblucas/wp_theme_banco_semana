<?php


namespace App\View;


class CardsView
{

    private $posts;
    private $metas;
    private $paged;
    private $button;
    private $display;
    public $views;

    public function __construct($posts, $metas = [], $paged = '', $button = true, $display = false)
    {

        $this->posts = $posts;
        $this->metas = $metas;
        $this->paged = $paged;
        $this->button = $button;
        $this->display = $display;

        foreach ($this->posts as $key => $post) {

            $the_permalink = get_the_permalink($post->ID);
            $the_title = get_the_title($post->ID);
            $the_excerpt = get_the_excerpt($post->ID);
            get_the_post_thumbnail_url($post->ID, 'foto-noticia') ? $the_thumbnail_url = get_the_post_thumbnail_url($post->ID, 'foto_noticia') : $the_thumbnail_url = null;
            $the_thumbnail_url ? $thumbnailRender = '<img class="card-img" src="'.$the_thumbnail_url.'">' : $thumbnailRender = null;
            $metaRenders = [];
            if($this->metas) {
                foreach ($this->metas as $metaKey => $meta) {
                    $label = array_key_exists('label', $meta[$post->ID]) ? $meta[$post->ID]['label'] . ':' : null;
                    $after = array_key_exists('after', $meta[$post->ID]) ? $meta[$post->ID]['after'] : null;
                    if($meta[$post->ID]['slug'] === 'direcao') {
                        $metaRenders[] = '
                        <h5>
                             '.$label.'
                            '.$meta[$post->ID]['meta'].'
                            '.$after.'
                        </h5>
                        ';
                    } else {
                            $metaRenders[] = '
                        <h5 class="d-inline">
                             '.$label.'
                            '.$meta[$post->ID]['meta'].'
                            '.$after.'
                        </h5>
                        ';
                    }
                }
            }
            $this->button ? $buttonRender = '<div class="card-btn btn btn-banco btn-banco-primary">Veja Mais</div>' : $buttonRender = null;
            $this->display ? $displayRender = null : $displayRender = 'style = "display: none;"';

                $this->views[$key] = '
                    <article class="col-12 col-sm-6 col-lg-4 page-'.$this->paged.'" '.$displayRender.'>
                        <div class="card card-banco card-banco">
                            <a href="'.$the_permalink.'" class="card-link">
                            '.$thumbnailRender.'
                            <div class="card-footer">
                                <h4 class="card-title">
                                    '.$the_title.'
                                </h4>
                                '.implode($metaRenders).'
                                <div class="card-text">
                                    '.$the_excerpt.'
                                </div>
                                '.$buttonRender.'
                            </div>
                            </a>
                        </div>
                    </article>
                    ';
        }

    }

}
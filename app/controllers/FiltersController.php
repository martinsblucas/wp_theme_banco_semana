<?php


namespace App\Controllers;


class FiltersController
{
    public function __construct()
    {
        add_filter( 'excerpt_length', [$this, 'filter_excerpt'], 999 );
        add_filter( 'wp_new_user_notification_email', [$this, 'new_user_notification_email'] );
    }

    public function filter_excerpt($length)
    {
        return 10;
    }

    public function new_user_notification_email( $new_user_notification_email )
    {

        $name = isset($_POST['display_name']) ? $_POST['display_name'] : $_POST['user_login'];
        $username = $_POST['user_login'];
        $pass = $_POST['user_pass'];

        $linkAcervo = get_post_type_archive_link( "filmes" );

        $new_user_notification_email['headers'] .= "Content-Type: text/html";
        $new_user_notification_email['subject'] = "Bem-vindo ao Banco de Obras, $name!";
        $new_user_notification_email['message'] = "<h3 style='color: #293462'>Conheça nosso acervo: </h3>";
        $new_user_notification_email['message'] .= "<span><a href='$linkAcervo' target='_blank'>$linkAcervo</a></span>";
        $new_user_notification_email['message'] .= "<h4 style='color: #293462'>Confira seus dados de acesso: </h4>";
        $new_user_notification_email['message'] .= "<p><strong>Nome de usuário: </strong>$username";
        $new_user_notification_email['message'] .= "<br><strong>Senha: </strong>$pass</br>";

        return $new_user_notification_email;

    }
}
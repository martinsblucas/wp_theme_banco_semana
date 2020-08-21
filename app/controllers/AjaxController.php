<?php


namespace App\Controllers;

use App\View\CardsView as CardsView;


class AjaxController
{

    public function __construct()
    {


        add_action('wp_ajax_authenticate_user', [$this, 'authenticate_user']);
        add_action('wp_ajax_nopriv_authenticate_user', [$this, 'authenticate_user']);

        add_action('wp_ajax_load_more', [$this, 'load_more']);
        add_action('wp_ajax_nopriv_load_more', [$this, 'load_more']);

        add_action('wp_ajax_send_email', [$this, 'send_email']);
        add_action('wp_ajax_nopriv_send_email', [$this, 'send_email']);


    }

    public function authenticate_user()
    {

        $user_login = isset($_POST['user_login']) ? $_POST['user_login'] : null;
        $user_pass = isset($_POST['user_pass']) ? $_POST['user_pass'] : null;

        if($user_login == null) {
            wp_send_json_error('Informe o nome de usuário', 400);
        }

        if($user_pass == null) {
            wp_send_json_error('Informe a senha', 400);
        }

        $auth = wp_authenticate( $user_login, $user_pass ) instanceof \WP_Error ? false : true;

        if($auth) {
            wp_send_json_success();
        } else {
            wp_send_json_error('Credenciais inválidas', 401);
        }

    }

    public function send_email()
    {

        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $subject = isset($_POST['subject']) ? $_POST['subject'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $text = isset($_POST['text']) ? $_POST['text'] : null;

        if($name == null) {
            wp_send_json_error('Informe seu nome', 400);
        }

        if($subject == null) {
            wp_send_json_error('Informe o assunto do seu email', 400);
        }

        if($email == null) {
            wp_send_json_error('Informe seu email', 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            wp_send_json_error('Informe um endereço de email válido', 400);
        }

        if($text == null) {
            wp_send_json_error('Escreva algo.', 400);
        }

        $to = get_option('admin_email');

        $headers[] = "From: $name <$email>";
        $headers[] = "Reply-To: $name <$email>";

        $sent = wp_mail($to, $subject, strip_tags($text), $headers);

        if($sent) {
            wp_send_json_success($sent);
        } else {
            wp_send_json_error('Ocorreu um erro ao enviar seu email. Por favor, tente novamente mais tarde.', 500);
        }

    }

    public function load_more() {

        isset($_GET['post_type']) ? $post_type = $_GET['post_type'] : $post_type = get_post_types();
        isset($_GET['tax_query']) ? $tax_query = $_GET['tax_query'] : $tax_query = (object) [];
        isset($_GET['meta_query']) ? $meta_query = $_GET['meta_query'] : $meta_query = (object) [];
        isset($_GET['paged']) ? $paged = $_GET['paged'] : $paged = 1;
        isset($_GET['s']) ? $s = $_GET['s'] : $s = '';

        $tax_queries = (array) $tax_query;
        $meta_queries = (array) $meta_query;

        $args = [
            'post_type' => $post_type,
            'tax_query' => $tax_queries['queries'],
            'meta_query' => $meta_queries['queries'],
            's' => $s,
            'paged' => $paged,
            'orderby' => 'name',
            'order' => 'ASC'
        ];

        $newQuery = new \WP_Query($args);

        $controller = new ArchiveController($newQuery);

        $controllerData = (array) $controller->data;
        $controllerPosts = $controllerData['posts'];
        $controllerMetas = $controllerData['metas'];

        $CardsView = new CardsView($controllerPosts, $controllerMetas, $paged, true, false);
        $views = (array) $CardsView->views;

        foreach ($views as $newQueryKey => $view) {

            $results[$newQueryKey] = $view;

        }

        $data = [
            'results' => $results
        ];

        wp_send_json_success($data);

    }

}
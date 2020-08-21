<?php


namespace App\Controllers;


class RegisterUser
{

    private $ID;
    private $user_login;
    private $first_name;
    private $user_pass;
    private $user_email;
    private $user_url;
    private $description;
    private $show_admin_bar_front;
    private $role;

    public function __construct($ID = null, $user_login = null, $first_name, $user_pass = null, $user_email, $user_url, $description, $role)
    {

        $this->ID = $ID;
        if($user_login) {
            $this->user_login = $user_login;
        }
        $this->first_name = $first_name;
        if($user_pass) {
            $this->user_pass = $user_pass;
        }
        $this->user_email = $user_email;
        $this->user_url = $user_url;
        $this->description = $description;
        $this->show_admin_bar_front = false;
        $this->role = $role;

    }

    public function user_register()
    {
        $errors = [];

        $insertData = [
            'user_login' => $this->user_login,
            'first_name' => $this->first_name,
            'user_email' => $this->user_email,
            'user_url' => $this->user_url,
            'description' => $this->description,
            'show_admin_bar_front' => $this->show_admin_bar_front,
            'role' => $this->role
        ];


        $this->ID ? $insertData['ID'] = $this->ID : null;
        $this->user_pass ? $insertData['user_pass'] = $this->user_pass : null;
        $this->ID and $this->user_pass ? $insertData['user_pass'] = md5($insertData['user_pass']) : null;
        $this->ID ? $this->role = null : null;

        $insert = wp_insert_user($insertData);

        if($insert instanceof \WP_Error) {
            foreach ($insert->get_error_messages() as $key => $message) {
                $errors[] = $message;
            }
        }


        if(count($errors) > 0)
            return new \WP_Error(400, $errors);


        wp_new_user_notification($insert, null, 'both');

        return $insert;

    }


}
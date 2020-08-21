<?php

use App\Controllers\RegisterUser;

$ID = null;
$role = 'exibidor';

if ($post->post_name !== 'cadastrar-exibidor') {

    $user_id = get_current_user_id();
    if ($user_id) {
        $ID = $user_id;
        $user_data = get_userdata($user_id);
        $role = implode($user_data->roles);

    }

}

$user_login = null;
$display_name = null;
$user_email = null;
$user_url = null;
$description = null;
$userRegister = false;
$messages = [];

if (isset($_POST['register_user'])) {

    if ($ID) {
        $user_login = $user_data->user_login ? $user_data->user_login : null;
    } else {
        $user_login = isset($_POST['user_login']) ? $_POST['user_login'] : null;
    }


    $display_name = $_POST['display_name'] ? $_POST['display_name'] : null;
    $user_pass = isset($_POST['user_pass']) ? $_POST['user_pass'] : null;
    $user_email = $_POST['user_email'] ? $_POST['user_email'] : null;
    $user_url = $_POST['user_url'] ? $_POST['user_url'] : null;
    $description = $_POST['description'] ? $_POST['description'] : null;

    $user = new RegisterUser($ID, $user_login, $display_name, $user_pass, $user_email, $user_url, $description, $role);

    $userRegister = $user->user_register();

    if ($userRegister instanceof WP_Error) {
        foreach ($userRegister->get_error_messages()[0] as $key => $message) {
            $messages[] = ['class' => 'text-danger', 'message' => $message];
        }

    } else {
        $user_login = null;
        $display_name = null;
        $user_email = null;
        $user_url = null;
        $description = null;
        $msg = $ID ? "Perfil atualizado com sucesso." : "Exibidor cadastrado com sucesso!";
        $messages[] = ['class' => 'text-success', 'message' => $msg];
    }

}

if ($ID) {
    $user_login = $user_data->user_login;
    $display_name = $user_data->display_name;
    $user_email = $user_data->user_email;
    $user_url = $user_data->user_url;
    $description = $user_data->description;
}

$user_login = $user_login ? "value='{$user_login}'" : false;
$display_name = $display_name ? "value='{$display_name}'" : false;
$user_email = $user_email ? "value='{$user_email}'" : false;
$user_url = $user_login ? "value='{$user_url}'" : false;
$description = $description ? $description : false;

$button_label = $ID ? 'Editar' : 'Cadastrar';


?>

<div class="row m-0">


    <div class="col-md-6 offset-md-3">

        <div class="card card-outline-secondary">
            <div class="card-header">
                <h2 class="mb-0"><?= the_title() ?></h2>
            </div>
            <div class="card-body">
                <?php if ($messages) {
                    echo '<div class="mb-4">';
                    foreach ($messages as $key => $message) {
                        echo "<p class='{$message['class']}'>{$message['message']}</p>";
                    }
                    echo '</div>';
                }
                ?>
                <?php if(!is_int($userRegister)) { ?>
                <form class="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" role="form"
                      autocomplete="off">
                    <div class="form-group">
                        <label for="display_name">Nome</label>
                        <input id="display_name" name="display_name" type="text"
                               class="form-control" <?= $display_name ?> required>
                    </div>
                    <div class="form-group">
                        <label for="user_login">Nome de usuário</label>
                        <input id="user_login" name="user_login" type="text"
                               class="form-control" <?= $user_login ?><?= $ID ? ' disabled' : null ?> required>
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input id="user_email" name="user_email" type="email"
                               class="form-control" <?= $user_email ?> required>
                    </div>

                    <?php if ($post->post_name == 'cadastrar-exibidor') { ?>

                        <div class="form-group">
                            <label for="user_pass">Senha</label>
                            <input id="user_pass" name="user_pass" type="password" class="form-control" required>
                        </div>

                    <?php } else { ?>

                        <div class="form-group">
                            <label for="user_pass" class="d-block">Senha</label>
                            <button type="button" class="btn mb-3 btn-banco btn-secondary btn-lg"
                                    id="change_pass">Alterar senha
                            </button>
                            <input id="user_pass" name="user_pass" type="password" class="form-control"
                                   style="display: none;">
                        </div>

                    <?php } ?>
                    <div class="form-group">
                        <label for="user_url">Site ou rede social</label>
                        <input id="user_url" name="user_url" type="url" <?= $user_url ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Sobre</label>
                        <textarea name="description" id="description"
                                  class="form-control"><?= $description ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-banco btn-success btn-lg float-right"
                                name="register_user"><?= $button_label ?></button>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>

    </div>

</div>

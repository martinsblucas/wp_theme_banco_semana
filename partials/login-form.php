<?php

$query = new WP_Query(
    [
        'name' => 'cadastrar-exibidor',
        'post_type' => 'page'
    ]);

$cadastrarExibidorId = $query->posts[0]->ID;
$cadastrarExibidorUrl = get_permalink($cadastrarExibidorId);

?>

<form method="post" name="loginform" id="loginForm" action="<?php echo site_url( '/wp-login.php' ); ?>">

    <div class="form-group">

        <div class="mb-4" style="display: none" id="authErrors">
        </div>

        <div class="input-group">
            <input type="text" class="form-control mb-2" name="log" id="User" placeholder="Usuário">

        </div>

        <div class="input-group">
            <input type="password" class="form-control" name="pwd" Id="Pass" placeholder="Senha">
        </div>


        <div class="input-group mb-2 my-3">

            <button type="submit" id="login" class="btn btn-banco btn-banco-primary mr-2">Entrar</button>
            <a href="<?= $cadastrarExibidorUrl; ?>" class="btn btn-banco btn-banco-secondary">Cadastrar-se</a>

            <?php global $wp; $redirect_to = home_url( $wp->request ) . '?action=movie'; ?>

            <input type="hidden" value="<?= esc_attr( $redirect_to ); ?>" name="redirect_to">

        </div>

        <div class="input-group">

            <a href="<?= wp_lostpassword_url( $redirect_to ); ?>" class="esqueceu-senha">Esqueceu a senha?</a>

        </div>

    </div>

</form>
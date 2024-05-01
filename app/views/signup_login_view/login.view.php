<?php
declare(strict_types=1);

$currentDirectory = __DIR__;
$newDirectory = dirname($currentDirectory, 2);
require $newDirectory . '/core/Validate_data.php';

if (isset($_GET['verification'])) {

    $auth_code = $_GET['verification'];
    $msg = [];

    if (select_user_verification_code($auth_code)) {
        $msg['auth_code'] = '¡Su cuenta a sido verificada con exito!';
        delete_verification_code($auth_code);
        if ($msg)
            $_SESSION["header_scs_msg"] = $msg;
    } elseif (!user_verification_code_are_empty($auth_code)) {

        $msg['auth_code'] = '¡Su cuenta ya fue verificada con exito! Porfavor ingrese sus datos.';
        if ($msg)
            $_SESSION["header_scs_msg"] = $msg;

    } else {
        $msg['error_auth_code'] = '¡Upps a ocurrido un error al verificar su cuenta!';
        if ($msg)
            $_SESSION["header_err_msg"] = $msg;
    }
}

if (!isset($_SESSION['user_id'])) { ?>
    <div class="header-msg-container"><?php show_header_msg(); ?></div>
    <div class="scss-msg-container"><?php show_scs_msg(); ?></div>

    <div id="FORM-SYSTEM">
        <form action="http://localhost/public_html/framework-v1/login/login_user" method="post">
            <div class="form-header">
                <h3>Iniciar sesion</h3>
                <p>!Bienvenido¡ Porfavor ingrese su nombre de correo y contraseña.</p>
            </div>

            <div class="form-inputs-container">

                <div class="form-email-container">
                    <label for="email">correo:</label>
                    <input class="form-input-fields" autocomplete="off" type="email" name="email" placeholder="correo: johndoe123@mail.com...">
                </div>

                <div class="form-pwd-container">
                    <label for="pwd">contraseña:</label>
                    <div class="form-pwd-input-container">
                        <input class="form-input-fields form-input-pwd pwd" minlength="8" autocomplete="off" type="password" name="password" placeholder="contraseña: 8 a 16 carrateres...">
                        <button type="button" class="showPwdBtn">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <a href="http://localhost/public_html/framework-v1/forgetpwd">¿contraseña olvidada?</a>
            </div>

            <button class="form-submit-btn" type="submit">Iniciar sesion</button>
            <h3 class="form-link-login">¿No tienes una cuenta?
                <a href="signup">
                    crear una ahora</a>
            </h3>
        </form>
    </div>
    <div class="form-error-msg-container"><?php show_err_msg(); ?></div>
<?php } else {
    header("Location: http://localhost/public_html/php-mvc-framework/public/home");
    die();
} ?>


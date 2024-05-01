<?php
function get_session_code()
{
    if (isset($_SESSION['auth_code_data'])) {
        echo '
            <input type="text" name="auth_code" value="' . $_SESSION['auth_code_data']['auth_code'] . '">
        ';
    } else {
        echo 'Upps a acudorido un error en el codigo. vuelva a ingresar en el enlace de su correo.';
    }
}

if (!isset($_SESSION['user_id'])) { ?>
    <div id="FORM-SYSTEM">
        <form action="http://localhost/public_html/framework-v1/resetpass/r" method="post">
            <div class="form-header">
                <h3>Restaurar contraseña</h3>
                <p>Porfavor escriba su nueva contraseña. (minimo 8 characteres)
            </div>
            <div class="form-inputs-container">
                <?php get_session_code(); ?>
                <div class="form-pwd-container">
                    <label for="pwd">contraseña:</label>
                    <div class="form-pwd-input-container">
                        <input class="form-input-fields form-input-pwd pwd" minlength="8" autocomplete="off" type="password"
                            name="password" placeholder="contraseña: 8 a carrateres...">
                        <button type="button" class="showPwdBtn"><i class="bi bi-eye-slash"></i></button>
                    </div>
                </div>

                <div class="form-pwd-container">
                    <label for="pwd_cnfr">confirmar contraseña:</label>
                    <div class="form-pwd-input-container">
                        <input class="form-input-fields form-input-pwd pwd_cnfr" minlength="8" autocomplete="off"
                            type="password" name="password_cnfr" placeholder="confirmar contraseña...">
                        <button type="button" class="showPwdBtn"><i class="bi bi-eye-slash"></i></button>
                    </div>
                </div>
            </div>

            <button class="form-submit-btn" type="submit">Cambiar contraseña</button>
            <h3 class="form-link-login">¿Ya recuerdas tu contraseña?
                <a href="login" class="links-color"> inicia sesion</a>
            </h3>
            <h3 class="form-link-login">¿No tienes una cuenta?
                <a href="singup" class="links-color"> crear una ahora</a>
            </h3>
            <div class="form-error-msg-container"><?php show_err_msg(); ?></div>
        </form>
    </div>
<?php } else {
    header("Location: http://localhost/public_html/framework-v1/");
    die();
} ?>
</body>

</html>
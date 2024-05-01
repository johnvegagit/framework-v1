<?php if (!isset($_SESSION['user_id'])) { ?>
    <div class="info-msg-container"><?php show_inf_msg(); ?></div>
    <div id="FORM-SYSTEM">
        <form action="<?= URLPATH ?>forgetpwd/get_auth_code" method="post">
            <div class="form-header">
                <h3>Contraseña olvidada</h3>
                <p>Ingrese su correo, recivira un enlace para resetear su contraseña.</p>
            </div>

            <div class="form-inputs-container">
                <div class="form-email-container">
                    <label for="email">correo:</label>
                    <input class="form-input-fields" maxlength="50" minlength="5" autocomplete="off" type="email"
                        name="email" placeholder="correo: johndoe123@mail.com...">
                </div>
            </div>

            <button class="form-submit-btn" type="submit">Obtener enlace</button>

            <h3 class="form-link-login">¿Ya recuerdas tu contraseña? <a href="<?= URLPATH ?>login"> inicia
                    sesion</a></h3>
            <h3 class="form-link-login">¿No tienes una cuenta? <a href="<?= URLPATH ?>signup"> crear una
                    ahora</a></h3>
            <div class="form-error-msg-container"><?php show_err_msg(); ?></div>
        </form>
    </div>
<?php } else {
    header('Location: ' . URLPATH);
    die();
} ?>
</body>

</html>
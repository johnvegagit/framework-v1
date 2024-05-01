<?php
function signup_inputs()
{
    # Name & Surname...
    if (isset($_SESSION['signup_data']['name']) && isset($_SESSION['signup_data']['surname'])) {
        echo '
        <div class="form-name-surname-cont">

            <div class="form-name-container" >
                <label for="name" >nombre:</label>
                <input class="form-input-fields" maxlength="15" minlength="2" autocomplete="off" type="text" name="name" placeholder="example: john" value="' . $_SESSION['signup_data']['name'] . '">
            </div>

            <div class="form-surname-container">
                <label for="surname" >apellido:</label>
                <input class="form-input-fields" maxlength="15" minlength="2" autocomplete="off" type="text" name="surname" placeholder="(opcional)" value="' . $_SESSION['signup_data']['surname'] . '">
            </div>

        </div>';
    } else {
        echo '
        <div class="form-name-surname-cont">

            <div class="form-name-container" >
                <label for="name" >nombre:</label>    
                <input class="form-input-fields" maxlength="15" minlength="2" autocomplete="off" type="text" name="name" placeholder="nombre...">
            </div>

            <div class="form-surname-container">
                <label for="surname" >apellido:</label>
                <input class="form-input-fields" maxlength="15" minlength="2" autocomplete="off" type="text" name="surname" placeholder="(opcional)">
            </div>

        </div>';
    }
    # User name...
    if (isset($_SESSION['signup_data']['username']) && !isset($_SESSION['errors_signup']['username_used']) && !isset($_SESSION['errors_signup']['invalid_username'])) {

        echo '
        <div class="form-username-container">
            <label for="username" >nombre de usuario:</label>
            <input class="form-input-fields" maxlength="50" minlength="5" autocomplete="off" type="text" name="username" placeholder="johndoe123..." value="' . $_SESSION['signup_data']['username'] . '">
        </div>
        ';

    } else {
        echo '
        <div class="form-username-container">
            <label for="username" >nombre de usuario:</label>
            <input class="form-input-fields" maxlength="50" minlength="5" autocomplete="off" type="username" name="username" placeholder="johndoe123...">
        </div>
        ';
    }
    # Email...
    if (isset($_SESSION['signup_data']['email']) && !isset($_SESSION['errors_signup']['email_used']) && !isset($_SESSION['errors_signup']['invalid_email'])) {

        echo '
        <div class="form-email-container">
            <label for="email" >correo:</label>
            <input class="form-input-fields" maxlength="50" minlength="5" autocomplete="off" type="email" name="email" placeholder="correo: johndoe123@mail.com..." value="' . $_SESSION['signup_data']['email'] . '">
        </div>
        ';

    } else {
        echo '
        <div class="form-email-container">
            <label for="email" >correo:</label>
            <input class="form-input-fields" maxlength="50" minlength="5" autocomplete="off" type="email" name="email" placeholder="correo: johndoe123@mail.com...">
        </div>
        ';
    }
    # Password...
    echo '
        <div class="form-pwd-container">
            <label for="password" >contraseña:</label>
            <div class="form-pwd-input-container" >
                <input class="form-input-fields form-input-pwd pwd" minlength="8"  autocomplete="off" type="password" name="password" placeholder="contraseña: 8 a 16 carrateres...">
                <button type="button" class="showPwdBtn"><i class="bi bi-eye-slash"></i></button>
            </div>
        </div>

        <div class="form-pwd-container">
            <label for="password_cnfr" >confirmar contraseña:</label>
            <div class="form-pwd-input-container" >
                <input class="form-input-fields form-input-pwd pwd_cnfr" minlength="8" autocomplete="off" type="password" name="password_cnfr" placeholder="confirmar contraseña...">
                <button type="button" class="showPwdBtn"><i class="bi bi-eye-slash"></i></button>
            </div>
        </div>
    ';
}

if (!isset($_SESSION['user_id'])) { ?>
    <div class="info-msg-container"><?php show_inf_msg(); ?></div>
    <div id="FORM-SYSTEM">
        <form action="http://localhost/public_html/framework-v1/signup/insert_user" method="post">
            <div class="form-header">
                <h3>Crear una cuenta</h3>
                <!-- <p>Porfavor complete los campos para crear una cuenta.</p> -->
            </div>

            <div class="form-inputs-container">
                <?php signup_inputs(); ?>
            </div>

            <button class="form-submit-btn" type="submit"> Crear una cuenta</button>

            <h3 class="form-link-login">Ya tienes una cuanta: <a href="login"> iniciar sesion</a></h3>
        </form>
    </div>
    <div class="form-error-msg-container"><?php show_err_msg(); ?></div>
<?php } else {
    header("Location: http://localhost/public_html/framework-v1/");
    die();
}
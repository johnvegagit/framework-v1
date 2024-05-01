<?php
declare(strict_types=1);

class Resetpass
{

    use Controller;

    public function index()
    {
        $data = [
            'title' => 'Reset password | framework',
        ];

        $this->header($data);
        $this->view('signup_login_view/resetpass', $data);
        $this->footer();

    }

    public function r()
    {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $password = $_POST['password'];
            $password_cnfr = $_POST['password_cnfr'];
            $auth_code = $_POST['auth_code'];

            $currentDirectory = __DIR__;
            $newDirectory = dirname($currentDirectory);

            try {

                require $newDirectory . '/core/Validate_data.php';

                $errors = [];

                $data = [
                    'password' => $password,
                    'password_cnfr' => $password_cnfr,
                ];

                if (is_input_empty($data)) {
                    $errors['empty_input'] = '¡Campos vacios! Ingrese una nueva contraseña.';
                }

                if (is_user_code_empty($auth_code)) {
                    $errors['empty_code'] = '¡A ocurrido un error con el codigo!';
                }

                if (!is_password_match($password, $password_cnfr)) {
                    $errors['pwd_mismatch'] = '¡las contraseñas no coinciden!';
                }

                if (is_user_code_wrong($auth_code)) {
                    $errors['empty_code'] = '¡A ocurrido un error con el codigo!';
                }

                if ($errors) {
                    $_SESSION['error_msg'] = $errors;

                    header("Location:  http://localhost/public_html/framework-v1/resetpass");
                    die();
                }

                update_user_reset_code($password, $auth_code);

                $scss_msg = [];
                $scss_msg['restpwd_scs'] = "!Su contraseña a sido restaurada con exito¡";
                $_SESSION['scss_msg'] = $scss_msg;

                header("Location:  http://localhost/public_html/framework-v1/login/?resetpass=success");
                die();

            } catch (PDOException $e) {
                die("Query failds: " . $e->getMessage());
            }
        }

    }

}
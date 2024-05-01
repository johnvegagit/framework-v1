<?php
declare(strict_types=1);

use models\Login as user_login;

class Login
{

    use Controller;

    public function index()
    {

        $data = [
            'title' => 'Log In | framework',
        ];

        $this->header($data);
        $this->view('signup_login_view/login', $data);
        $this->footer();

    }

    public function login_user()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $currentDirectory = __DIR__;
            $newDirectory = dirname($currentDirectory);

            try {
                require $newDirectory . '/core/Validate_data.php';

                // ERROR HANDLER...
                $errors = [];

                $data = [
                    'email' => $email,
                    'password' => $password,
                ];

                $get_data = get_user_data($email);

                if (is_input_empty($data)) {
                    $errors['empty_input'] = '¡Campos vacios!';
                }

                if (is_user_email_wrong($email)) {
                    $errors['login_incorrect'] = '¡Datos incorrectos!';
                }

                if (!is_user_email_wrong($email) && is_password_wrong($password, $email)) {
                    $errors['login_incorrect'] = '¡Datos incorrectos!';
                }

                if (is_user_verify($email)) {
                    $errors['user_are_verify'] = '¡Aun no has verificado tu cuenta. revisa tu correo!';
                }

                if ($errors) {
                    $_SESSION['error_msg'] = $errors;

                    header('Location: http://localhost/public_html/framework-v1/login');
                    die();
                }

                $newSessionId = session_create_id();
                $sessionId = $newSessionId . "_" . $get_data->id;
                session_id($sessionId);

                /** saved in session */
                $_SESSION["user_id"] = $get_data->id;
                $_SESSION["user_name"] = htmlspecialchars($get_data->name);
                $_SESSION["user_surname"] = htmlspecialchars($get_data->surname);
                $_SESSION["user_email"] = htmlspecialchars($get_data->email);


                $_SESSION["last_regeneration"] = time();

                header('Location: http://localhost/public_html/framework-v1/');
                die();

            } catch (PDOException $e) {
                die("Query failds: " . $e->getMessage());
            }

        } else {
            header("Location: http://localhost/public_html/framework-v1/");
            die();
        }

    }
}
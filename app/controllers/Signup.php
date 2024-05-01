<?php
declare(strict_types=1);
defined('ROOTPATH') or exit('Access Denied!');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use models\Signup as user_signup;

class Signup
{

    use Controller;

    public function index()
    {

        $data = [
            'title' => 'Sign Up | framework',
        ];

        $this->header($data);
        $this->view('signup_login_view/signup', $data);
        $this->footer();

    }

    public function insert_user()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_cnfr = $_POST['password_cnfr'];
            $auth_code = md5((string) rand());

            $currentDirectory = __DIR__;
            $newDirectory = dirname($currentDirectory);

            try {
                require $newDirectory . '/core/Validate_data.php';

                $errors = [];

                $data = [
                    'name' => $name,
                    'surname' => $surname,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'password_cnfr' => $password_cnfr,
                    'auth_code' => $auth_code
                ];

                $nameSurname = [
                    'name' => $name,
                    'surname' => $surname,
                ];

                if (is_input_empty($data)) {
                    $errors['empty_input'] = '¡Campos vacios!';
                }

                if (!are_inputs_contains_allowed_characters($nameSurname)) {
                    $errors['allowed_characters'] = '¡Campo nombre o apellido contiene caracteres no permitidos. Solo se permiten letras, números y guiones bajos!';
                }

                if (is_username_taken($username)) {
                    $errors['username_taken'] = '¡El nombre de usuario ya fue adquirido.!';
                }

                if (!validate_email_domain($email)) {
                    $errors['invalid_email_domain'] = '¡Dominion de correo no permitido! solo se acepta (gmail.com, hotmail.com, outlook.com)';
                }

                if (is_email_invalid($email)) {
                    $errors['invalid_email'] = '¡Correo invalido!';
                }

                if (is_email_registered($email)) {
                    $errors['email_used'] = '¡Este correo ya fue resgistrado!';
                }

                if (!is_password_match($password, $password_cnfr)) {
                    $errors['password_mismatch'] = '¡las contraseñas no coinciden!';
                }

                if (!are_password_secure($password)) {
                    $errors['pwd_validation'] = '¡Contraseña no segura. Debe de incluir una letra minúscula y mayúscula, un número y un carácter especial!';
                }

                if (!are_password_have_minimun_characters($password)) {
                    $errors['pwd_validation_lng'] = '¡La contraseña tiene que tener minimo 8 caracteres!';
                }

                if ($errors) {
                    $_SESSION['error_msg'] = $errors;

                    $signupData = [
                        'name' => $name,
                        'surname' => $surname,
                        'username' => $username,
                        'email' => $email
                    ];

                    $_SESSION['signup_data'] = $signupData;
                    header('Location: ' . $_ENV['BASEURL'] . 'signup');
                    die();
                }

                // Envío del correo electrónico de verificación.
                $currentDirectory = __DIR__;
                $newDirectory = dirname($currentDirectory, 2);
                require $newDirectory . '/vendor/autoload.php';

                $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
                $dotenv->safeLoad();

                $mail = new PHPMailer(true);

                // Configuración del servidor SMTP y contenido del correo electrónico.
                // Server settings.
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output.
                $mail->isSMTP();                                           //Send using SMTP.
                $mail->Host = 'smtp.gmail.com';                           //Set the SMTP server to send through.
                $mail->SMTPAuth = true;                                  //Enable SMTP authentication.
                $mail->Username = $_ENV['DATAMAIL'];                    //SMTP username.
                $mail->Password = $_ENV['DATAPASS'];                   //SMTP password.
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      //Enable implicit TLS encryption.
                $mail->Port = 465;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`.

                // Recipients.
                $mail->setFrom($_ENV['DATAMAIL']);
                $mail->addAddress($email);

                // Content.
                $mail->isHTML(true);                             //Set email format to HTML
                $mail->Subject = 'no reply';
                $mail->Body = 'Ingrese en este enlace, para iniciar sesíon. <b><a href="' . $_ENV['BASEURL'] . 'login/?verification=' . $auth_code . '">' . $_ENV['BASEURL'] . 'login/?verification=' . $auth_code . '</a></b>';

                // Envía el correo electrónico.
                $mail->send();

                // If mail have been send, display user message.
                if ($mail) {

                    $info_msg = [];
                    $info_msg['verify_email'] = "¡Hola $name! Te hemos enviado un enlace para verificar tu cuenta a tu correo: $email";
                    $_SESSION['info_msg'] = $info_msg;

                    $user = new user_signup;
                    $user->insertData($data);

                    header('Location: ' . $_ENV['BASEURL'] . 'signup');
                    die();
                }

            } catch (PDOException $e) {
                die("Query failds: " . $e->getMessage());
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        } else {
            header('Location: ' . $_ENV['BASEURL']);
            die();
        }
    }
}
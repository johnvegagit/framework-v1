<?php
declare(strict_types=1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use models\Forgetpwd as user_forgetpwd;

class Forgetpwd
{
    use Controller;

    public function index()
    {
        $data = [
            'title' => 'Forget password | framework',
        ];

        $this->header($data);
        $this->view('signup_login_view/forgetpwd', $data);
        $this->footer();
    }

    public function get_auth_code()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $auth_code = md5((string) rand());

            $currentDirectory = __DIR__;
            $newDirectory = dirname($currentDirectory);

            try {

                require $newDirectory . '/core/Validate_data.php';

                $errors = [];

                $data = [
                    'email' => $email,
                ];

                if (is_input_empty($data)) {
                    $errors['empty_input'] = '¡Porfavor ingrese su correo!';
                }

                if (is_email_wrong($email)) {
                    $errors['email_used'] = '¡El correo ingresado no fue encontrado!';
                }

                if ($errors) {
                    $_SESSION['error_msg'] = $errors;

                    header('Location: http://localhost/public_html/framework-v1/forgetpwd');
                    die();
                }

                update_user_code($email, $auth_code);

                // Envío del correo electrónico de verificación.
                $currentDirectory = __DIR__;
                $newDirectory = dirname($currentDirectory, 2);
                require $newDirectory . '/vendor/autoload.php'; // Incluye Composer autoload.
                $mail = new PHPMailer(true);

                // Configuración del servidor SMTP y contenido del correo electrónico.
                // Server settings.
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output.
                $mail->isSMTP();                                           //Send using SMTP.
                $mail->Host = 'smtp.gmail.com';                           //Set the SMTP server to send through.
                $mail->SMTPAuth = true;                                  //Enable SMTP authentication.
                $mail->Username = 'email...';             //SMTP username.
                $mail->Password = 'password...';                  //SMTP password.
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      //Enable implicit TLS encryption.
                $mail->Port = 465;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`.

                // Recipients.
                $mail->setFrom('email...');
                $mail->addAddress($email);

                // Content.
                $mail->isHTML(true);                             //Set email format to HTML
                $mail->Subject = 'no reply';
                $mail->Body = 'Ingrese en este enlace, para iniciar sesíon. <b><a href="http://localhost/public_html/framework-v1/resetpass/?verification=' . $auth_code . '">http://localhost/public_html/framework-v1/resetpass/?verification=' . $auth_code . '</a></b>';

                // Envía el correo electrónico.
                $mail->send();

                // If mail have been send, display user message.
                if ($mail) {

                    $info_msg = [];
                    $info_msg['verify_email'] = "¡Hola! Te hemos enviado un enlace a tu cuenta a tu correo : $email, para cambiar contraseña";
                    $_SESSION['info_msg'] = $info_msg;

                    $auth_code_data = ['auth_code' => $auth_code];
                    $_SESSION['auth_code_data'] = $auth_code_data;

                    header("Location: http://localhost/public_html/framework-v1/forgetpwd");
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
            header("Location: http://localhost/public_html/framework-v1/");
            die();
        }
    }

}
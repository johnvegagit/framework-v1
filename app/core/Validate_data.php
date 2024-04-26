<?php
declare(strict_types=1);
/**
 * Data validation functions.
 */

use core\Database;

class Validate_data
{
    use Database;

    public function validate_data_func()
    {
        $pdo = $this->get_connection();
        return $pdo;
    }

    public function get_email(string $email)
    {
        $pdo = $this->get_connection();
        $query = "select * from users where email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function check_user_verification_code_exist($verification_code)
    {
        # Logic code to check user verification code.
        return true;
    }

    public function delete_verification_code_db($verification_code)
    {
        # Logic code to check user verification code.
        return true;
    }

    public function user_verification_code_are_empty($verification_code)
    {
        # Logic code to check user verification code.
        return true;
    }

}

# - Check if inputs are empty.
function is_input_empty(array $data)
{

    foreach ($data as $key => $value) {

        if (empty($value)) {
            return true;
        }
    }

}

# - Check if input are empty. Use this if function to validate signup/login.
function is_input_empty_for_signup_user(string $email, ?string $pwd = null, ?string $name = null, ?string $surname = null, ?string $pwd_cnfr = null)
{

    if (empty($email)) {
        return true; // If email have data, return true.
    }

    if (!is_null($name) && !is_null($surname) && !is_null($pwd) && !is_null($pwd_cnfr)) {
        if (empty($name) || empty($surname) || empty($pwd) || empty($pwd_cnfr)) {
            return true; // If inputs from signup/login are empty, return true.
        }
    }

    return false; // inputs have data, return false.

}

# - Validate email domain.
function validate_email_domain(string $email)
{

    $partes = explode('@', $email);
    $dominio = end($partes);

    $dominiosPermitidos = array('gmail.com', 'hotmail.com', 'outlook.com');

    if (in_array($dominio, $dominiosPermitidos)) {
        return true;
    } else {
        return false;
    }

}

# - Email validation.
function is_email_invalid(string $email)
{

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }

}

# - check if email are already exist in db.
function is_email_registered(string $email) #johnvegauser@gmail.com
{

    $get_bol = new Validate_data;
    $torf = $get_bol->get_email($email);

    if ($torf) {
        return true;
    } else {
        return false;
    }

}

# - Check if password match whit confirm password.
function is_password_match(string $pwd, string $pwd_cnfr)
{
    if ($pwd === $pwd_cnfr) {
        return true;
    } else {
        return false;
    }
}

# - Get user verification code.
function select_user_verification_code(string $verification_code)
{

    $get_bol = new Validate_data;
    $torf = $get_bol->check_user_verification_code_exist($verification_code);

    if ($torf) {
        return true;
    } else {
        return false;
    }

}

# - Delete user verification code.
function delete_verification_code(string $verification_code)
{

    $get_bol = new Validate_data;
    $torf = $get_bol->delete_verification_code_db($verification_code);

    if ($torf) {
        return true;
    } else {
        return false;
    }

}

# - Check if inputs contains onlly allowded characters.
function are_inputs_contains_allowed_characters(array $data)
{

    foreach ($data as $key => $value) {

        if (preg_match('/^[a-zA-Z0-9_]+$/', $value)) {
            return true;
        }
        return false;
    }

}

# - Check if password are secure.
function are_password_secure($password)
{
    if (
        !preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[0-9]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)
    ) {
        return false;
    }

    return true;
}

# - Check if password is atleast 8 characters minimun.
function are_password_have_minimun_characters($password)
{
    if (strlen($password) < 8) {
        return false;
    }

    return true;
}

# - At login check if user email are wrong.
function is_user_email_wrong(bool|array $result)
{
    if (!$result) {
        return true;
    } else {
        return false;
    }
}

# - Check if password are wrong, pwd and hashedPwd should be equal.
function is_password_wrong(string $pwd, string $hashedPwd)
{
    if (!password_verify($pwd, $hashedPwd)) {
        return true;
    } else {
        return false;
    }
}

# - Check if user are verify, check if code in db are empty.
function is_user_verify(string $email)
{

    $get_bol = new Validate_data;
    $torf = $get_bol->user_verification_code_are_empty($email);

    if ($torf) {
        return true;
    } else {
        return false;
    }

}
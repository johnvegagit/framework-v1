<?php
declare(strict_types=1);

class Logout
{

    use Controller;

    public function index()
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location: http://localhost/public_html/framework-v1/?logout=success");
        die();
    }
}
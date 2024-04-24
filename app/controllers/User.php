<?php
declare(strict_types=1);
use models\User as user_model;

class User
{
    use Controller;

    public function index()
    {

        $data = ['title' => 'Usuarios'];
        $this->header($data);
        $user = new user_model;
        $user->getAll();
        $this->footer();

    }
}
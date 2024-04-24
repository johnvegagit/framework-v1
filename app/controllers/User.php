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
        //$user->getAll();
        $this->footer();

    }

    public function one()
    {

        $data = ['title' => 'Usuarios'];
        $this->header($data);
        $user = new user_model;
        //$user->getOne('5');
        $this->footer();

    }

    public function insert()
    {

        $data = ['title' => 'Usuarios'];
        $this->header($data);
        $user = new user_model;
        //$user->insert('eric', '19');
        $this->footer();

    }

    public function update()
    {

        $data = ['title' => 'Usuarios'];
        $this->header($data);
        $user = new user_model;
        //$user->update('john', '26', '1');
        $this->footer();

    }

    public function delete()
    {

        $data = ['title' => 'Usuarios'];
        $this->header($data);
        $user = new user_model;
        //$user->delete('4');
        $this->footer();

    }
}
<?php
declare(strict_types=1);
defined('ROOTPATH') or exit . 'Access Denied!';
use models\User as user_model;

class User
{
    use Controller;

    public function index()
    {
        $userModel = new user_model;
        $results = $userModel->selectAllCache();

        $data = [
            'title' => 'Users | Framework',
            'results' => $results
        ];
        $this->header($data);
        $this->view('user', $data);
        $this->footer();

    }

    public function where()
    {
        $id = $_GET['id'];
        $userModel = new user_model;
        $result = $userModel->selectWhereCache($id);

        $data = [
            'title' => 'Users | Framework',
            'oneresult' => $result
        ];
        $this->header($data);
        $this->view('user', $data);
        $this->footer();

    }
}
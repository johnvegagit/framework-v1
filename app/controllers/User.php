<?php
declare(strict_types=1);

# DON'T Remove this: Your general error will display in the: (app/log/gn_err.log).
ini_set("display_errors", 0);
ini_set("log_errors", 'On');
ini_set('error_log', '/opt/lampp/htdocs/public_html/framework-v1/app/log/php_err_gn.log');
# DON'T Remove this: Your general error will display in the: (app/log/gn_err.log).

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
<?php
declare(strict_types=1);

# DON'T Remove this: Your general error will display in the: (app/log/gn_err.log).
ini_set("display_errors", 0);
ini_set("log_errors", 'On');
ini_set('error_log', '/opt/lampp/htdocs/public_html/framework-v1/app/log/php_err_gn.log');
# DON'T Remove this: Your general error will display in the: (app/log/gn_err.log).

defined('ROOTPATH') or exit('Access Denied!');

use models\Home as queryData;

class Home
{
    use Controller;

    public function index()
    {
        $id = $_GET['id'] ?? null;

        $queryData = new queryData;
        $results = $queryData->queryAllData();
        //$results = $queryData->queryWhereData($id);

        $data = [
            'title' => 'Welcome to framework-v1',
            'results' => $results
        ];
        $this->header($data);
        $this->view('home', $data);
        $this->footer();
    }

}
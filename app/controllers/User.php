<?php
declare(strict_types=1);
use models\User as user_model;

class User
{
    use Controller;

    public function index()
    {
        $userModel = new user_model;
        $results = $userModel->selectAll();

        $data = [
            'title' => 'Usuarios',
            'results' => $results
        ];
        $this->header($data);
        $this->view('user', $data);
        $this->footer();

    }

    public function insert()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $age = $_POST['age'];

            $currentDirectory = __DIR__;
            $newDirectory = dirname($currentDirectory);

            try {
                require $newDirectory . '/core/validate_data.php';


                if (is_input_empty($name, $age)) {
                    header('Location: http://localhost/public_html/framework-v1/user');
                    die();
                }

                $data = [
                    'name' => $name,
                    'age' => $age,
                ];

                $user = new user_model;
                $user->insertData($data);

                header('Location: http://localhost/public_html/framework-v1/user');
                die();
            } catch (PDOException $e) {
                die("Query failds: " . $e->getMessage());
            }
        }
    }

    public function update()
    {
        $id = $_GET['user_id'];

        $user = new user_model;
        $one_user = $user->selectWhere($id);

        $data = [
            'title' => 'Usuarios',
            'user_data' => $one_user
        ];

        $this->header($data);
        $this->view('update_user', $data);
        $this->footer();

    }

    public function exc_update()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $name = $_POST['name'];
            $age = $_POST['age'];

            $currentDirectory = __DIR__;
            $newDirectory = dirname($currentDirectory);

            try {
                require $newDirectory . '/core/validate_data.php';


                if (is_input_empty($name, $age)) {
                    header('Location: http://localhost/public_html/framework-v1/user');
                    die();
                }

                $data = [
                    'name' => $name,
                    'age' => $age,
                ];

                $user = new user_model;
                $user->updateData($data, $id);

                header('Location: http://localhost/public_html/framework-v1/user');
                die();
            } catch (PDOException $e) {
                die("Query failds: " . $e->getMessage());
            }
        }

    }

    public function delete()
    {

        $id = $_GET['d'];
        $user = new user_model;
        $user->deleteData($id);
        header('Location: http://localhost/public_html/framework-v1/user');
        die();

    }
}
<?php
trait Controller
{
    public function header($data = [])
    {
        $DS = DIRECTORY_SEPARATOR;
        $filename = $DS . 'opt' . $DS . 'lampp' . $DS . 'htdocs' . $DS . 'public_html' . $DS . 'framework-v1' . $DS . 'app' . $DS . 'views' . $DS . 'layout' . $DS . 'header.php';
        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = $DS . 'opt' . $DS . 'lampp' . $DS . 'htdocs' . $DS . 'public_html' . $DS . 'framework-v1' . $DS . 'app' . $DS . 'views' . $DS . '404.view.php';
            require $filename;
        }
    }

    public function view($name, $data = [])
    {
        $DS = DIRECTORY_SEPARATOR;
        $filename = $DS . 'opt' . $DS . 'lampp' . $DS . 'htdocs' . $DS . 'public_html' . $DS . 'framework-v1' . $DS . 'app' . $DS . 'views' . $DS . $name . '.view.php';
        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = $DS . 'opt' . $DS . 'lampp' . $DS . 'htdocs' . $DS . 'public_html' . $DS . 'framework-v1' . $DS . 'app' . $DS . 'views' . $DS . '404.view.php';
            require $filename;
        }
    }

    public function footer()
    {
        $DS = DIRECTORY_SEPARATOR;
        $filename = $DS . 'opt' . $DS . 'lampp' . $DS . 'htdocs' . $DS . 'public_html' . $DS . 'framework-v1' . $DS . 'app' . $DS . 'views' . $DS . 'layout' . $DS . 'footer.php';
        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = $DS . 'opt' . $DS . 'lampp' . $DS . 'htdocs' . $DS . 'public_html' . $DS . 'framework-v1' . $DS . 'app' . $DS . 'views' . $DS . '404.view.php';
            require $filename;
        }
    }
}
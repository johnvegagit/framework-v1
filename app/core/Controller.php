<?php
trait Controller
{

    public function view($name)
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
}
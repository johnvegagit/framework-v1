<?php
ini_set('display_errors', 1);

spl_autoload_register(function ($classname) {
    $classname = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
    require $filename = "/opt/lampp/htdocs/public_html/framework-v1/app/" . $classname . ".php";
});

require 'session.php';
require 'function.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'Router.php';
require 'App.php';
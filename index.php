<?php
$DS = DIRECTORY_SEPARATOR;
include __DIR__ . $DS . 'app' . $DS . 'core' . $DS . 'init.php';

$app = new App;
$app->startApp();
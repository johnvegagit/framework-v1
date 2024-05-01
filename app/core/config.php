<?php
declare(strict_types=1);
defined('ROOTPATH') or exit('Access Denied!');

if ($_SERVER['SERVER_NAME'] === 'localhost') {
    define('URLPATH', 'http://localhost/public_html/framework-v1/');
} else {
    # code...
}

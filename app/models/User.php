<?php
declare(strict_types=1);
namespace models;

use core\Model;

defined('ROOTPATH') or exit('Access Denied!');

class User
{
    use Model;

    //users
    //products
    //email
    protected $table = 'users';
    protected $id = 'id';
    protected $allowdedColumns = [

        "name",
        "age",
        "gender",

    ];

}
<?php
declare(strict_types=1);
namespace models;

use core\Model;

class User
{
    use Model;

    //users
    //products
    protected $table = 'users';
    protected $id = 'id';
    protected $allowdedColumns = [

        "name",
        "age",
        "gender",

    ];

}
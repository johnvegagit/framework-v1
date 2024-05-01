<?php
declare(strict_types=1);
namespace models;

use core\Model;

class Forgetpwd
{

    use Model;

    protected $table = 'users';
    protected $id = 'id';
    protected $allowdedColumns = [

        "email",

    ];

}
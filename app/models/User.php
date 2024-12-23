<?php
declare(strict_types=1);
namespace models;

use core\Model;

defined('ROOTPATH') or exit . 'Access Denied!';

class User
{
    use Model;

    protected $table = 'customers';
    protected $id = 'id';
    protected $allowdedColumns = [

        // If you want to select all columns use "*" and remove the other columns.
        "id",
        "name",
        "email",

    ];

}
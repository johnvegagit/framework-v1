<?php
declare(strict_types=1);
namespace models;

use core\Model;

class User
{
    use Model;

    protected $table = 'users';
    protected $id = 'id';
    protected $name = 'name';
    protected $age = 'age';

}
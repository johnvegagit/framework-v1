<?php
declare(strict_types=1);

namespace models;

use core\Model;

class User
{
    use Model;

    protected $table = 'users';
}

//$obj = new Model;
//$obj->test('chris', 30);

//$obj = new Model;
//$obj->getAll();
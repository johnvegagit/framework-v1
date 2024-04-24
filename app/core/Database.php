<?php
declare(strict_types=1);

namespace core;

use PDO;
use PDOException;

trait Database
{
    private $dbhost = 'localhost';
    private $dbname = 'dbtest';
    private $dbuser = 'root';
    private $dbpass = '';

    public function get_connection(): PDO
    {
        try {
            $pdo = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

}

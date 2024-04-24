<?php
namespace core;

use core\Database;
use PDO;

trait Model
{
    use Database;

    protected $order_column = 'id';
    protected $order_type = 'desc';
    protected $limit = '10';

    public function getAll()
    {
        $pdo = $this->get_connection();
        $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        showPre($results);
    }

    public function test($name, $age)
    {
        $pdo = $this->get_connection();
        $query = "insert into users (name,age) values (:name, :age)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->execute();
    }
}
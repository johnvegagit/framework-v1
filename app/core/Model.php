<?php
/**
 * This is the main model.
 * -> i'ts make CRUD.
 * -> use table depends an your /models/ class directory
 */
declare(strict_types=1);
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

    public function getOne($id)
    {

        $pdo = $this->get_connection();
        $query = "select $this->id, $this->name, $this->age from $this->table where id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        showPre($result);

    }

    public function insert($name, $age)
    {

        $pdo = $this->get_connection();
        $query = "insert into $this->table ($this->name, $this->age) values (:name, :age)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->execute();

    }

    public function update($name, $age, $id)
    {

        $pdo = $this->get_connection();
        $query = "update $this->table set $this->name = :name, $this->age = :age where id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }

    public function delete($id)
    {

        $pdo = $this->get_connection();
        $query = "delete from $this->table where id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }
}
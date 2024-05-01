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

    public function selectAll()
    {

        $pdo = $this->get_connection();
        $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;

    }

    public function selectWhere($id)
    {

        $pdo = $this->get_connection();
        $query = "select * from $this->table where id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;

    }

    public function insertData($data)
    {

        $pdo = $this->get_connection();

        /** remove unwanted data **/
        if (!empty($this->allowdedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowdedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";

        $stmt = $pdo->prepare($query);

        if (isset($data['password'])) {
            $option = [
                'cost' => 12
            ];
            $hashedPwd = password_hash($data['password'], PASSWORD_BCRYPT, $option);
            $data['password'] = $hashedPwd;
        }

        foreach ($keys as $key) {
            $paramName = ':' . $key;
            $stmt->bindParam($paramName, $data[$key]);
        }

        $stmt->execute();
    }

    public function updateData($data, $id)
    {

        $pdo = $this->get_connection();

        /** remove unwanted data **/
        if (!empty($this->allowdedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowdedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $setClause = implode("=?, ", $keys) . "=?";
        $query = "update $this->table set $setClause where id = ?";
        $stmt = $pdo->prepare($query);

        $i = 1;
        foreach ($data as $value) {
            $stmt->bindValue($i++, $value);
        }

        $stmt->bindValue($i, $id);

        $stmt->execute();
    }

    public function deleteData($id)
    {

        $pdo = $this->get_connection();
        $query = "delete from $this->table where id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }

}
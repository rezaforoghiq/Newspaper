<?php

namespace database;

use PDO;
use PDOException;

class DataBase
{

    private $connenction;
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    private $dbHost = DB_HOST;
    private $dbName = DB_NAME;
    private $dbUsername = DB_USERNAME;
    private $dbPassword = DB_PASSWORD;


    public function __construct()
    {

        try {

            $this->connenction = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUsername, $this->dbPassword, $this->options);

        } catch (PDOException $e) {

            echo "Your Error is: " . $e->getMessage();

        }

    }

    public function select($sql, $values = null)
    {
        try {
            $statement = $this->connenction->prepare($sql);

            if ($values == null) {

                $statement->execute();

            } else {

                $statement->execute($values);

            }

            $result = $statement;
            return $result;

        } catch (PDOException $e) {

            echo $e->getMessage();

        }

    }

    // insert(table, fildes, values);
    public function insert($table, $fildes, $values)
    {

        $statment = $this->connenction->prepare("INSERT INTO " . $table . " (" . implode(", ", $fildes) . ", created_at) VALUES (:" . implode(", :", $fildes) . ", NOW())");
        $statment->execute(array_combine($fildes, $values));
        return true;

    }


    public function update($tableName, $id, $fildes, $values)
    {
        $sql = "UPDATE `" . $tableName . "` SET";
        $first = true;
        $params = [];

        foreach ($fildes as $index => $filde) {
            if (!$first) {
                $sql .= ",";
            }
            $value = $values[$filde];
            if ($value !== null && $value !== '') {
                $sql .= " `" . $filde . "` = ?";
                $params[] = $value;
            } else {
                $sql .= " `" . $filde . "` = NULL";
            }
            $first = false;
        }
        $sql .= ", updated_at = NOW()";
        $sql .= " WHERE id = ?";
        $params[] = $id;

        try {
            $statment = $this->connenction->prepare($sql);
            $statment->execute($params);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }



    public function delete($tableName, $id)
    {

        try {

            $statment = $this->connenction->prepare("DELETE FROM " . $tableName . " WHERE id = ?;");
            $statment->execute([$id]);

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }
}



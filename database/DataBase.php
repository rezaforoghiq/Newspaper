<?php

namespace database;

use PDO;
use PDOException;

class Dataase{

    private $connenction;
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    private $dbHost = DB_HOST;
    private $dbName = DB_NAME;
    private $dbUsername = DB_USERNAME;
    private $dbPassword = DB_PASSWORD;


    public function __construct(){

        try{

            $this->connenction = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUsername, $this->dbPassword, $this->options);
            echo "ok";

        }
        catch(PDOException $e){

            echo "Your Error is: " . $e->getMessage();

        }

    }

    public function select($sql, $values = null){
        try{
            $statement = $this->connenction->prepare($sql);

            if( $values == null ){

                $statement->execute();

            }else{

                $statement->execute($values);

            }

            $result = $statement;
            return $result;
            
        } 
        catch(PDOException $e){

            echo $e->getMessage();

        }

    }

    // insert(table, fildes, values);
    public function insert($table, $fildes, $values) {

        $statment = $this->connenction->prepare("INSERT INTO ". $table . " (" . implode(", ", $fildes) . ", created_at) VALUES (:". implode(", :" , $fildes) . ", NOW())");
        $statment->execute(array_combine($fildes, $values));
        return true;

    }


    public function update ($tableName, $id, $fildes, $values) {

        $query = "UPDATE `". $tableName . "` SET";
        
        foreach(array_combine($fildes, $values) as $filde => $value){
            if($value){

                $query .= " `". $filde . "` = ? ,";

            }
            else{

                $query .= " `". $filde . "` =  NULL ,";

            }
        }

        $query .= " updated_at = NOW()";
        $query .= " WHERE id = ?";

        try{

            //prepare the statment
            $statment = $this->connenction->prepare($query);
            //execute the statment
            $statment->execute(array_filter(array_merge(array_values($values)), [$id]));

            return true;
        }

        catch(PDOException $e){

            echo $e->getMessage();

        }
    }


    public function delete($tableName, $id){

        try{

            $statment = $this->connenction->prepare("DELETE FROM ". $tableName . " WHERE id = ?;");
            $statment->execute([$id]);

        }
        catch(PDOException $e){

            echo $e->getMessage();

        }
    }

    public function createTable($sql){

        try {

            $this->connenction->exec($sql);
            return true;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

}


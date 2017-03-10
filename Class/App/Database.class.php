<?php
/**
 * User: Ryjek01
 * Date: 23.02.17
 * Time: 20:35
 */

namespace App;

use PDO;
use PDOException;

class Database
{
    private $dbh;
    private $error;
    private $query;
    private $prepare=null;
    private $return=PDO::FETCH_OBJ;
    private $options = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    public function __construct()
    {
        $conf = General::config("sql",["host","port","user","password","name"]);

        try{
            $dsn = "mysql:host={$conf['host']};dbname={$conf['name']}";
            $this->dbh = new PDO($dsn,$conf['user'], $conf['password'],$this->options);

            $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->return);
        } catch (PDOException $e) {
            $this->error['connection'] = $e->getMessage();
            $this->error("error");
        }
    }

    public function prepare($query)
    {
        try {
            $this->prepare = $this->dbh->prepare($query);
        } catch (PDOException $e) {
            $this->error['query'] = $e->getMessage();
            $this->error("error");
        }
    }

    public function query($query)
    {
        try {
            $this->query = $this->dbh->query($query);
        } catch (PDOException $e) {
            $this->error['query'] = $e->getMessage();
            $this->error("error");
        }
    }

    public function bind($param,$value,$type=null)
    {
        if ($this->prepare === null) {
            $this->error['query'] = "Prepare query is empty!";
            $this->error("error");
        }

        if($type===null) {
            switch (true){
                case is_int($value): $type=PDO::PARAM_INT; break;
                case is_bool($value): $type=PDO::PARAM_BOOL; break;
                case is_null($value): $type=PDO::PARAM_NULL; break;
                default: $type=PDO::PARAM_STR;
            }
        }

        $this->prepare->bindValue($param,$value,$type);
    }

    public function execute()
    {
        if($this->prepare !== null) {
            return $this->prepare->execute();
        }

        if ($this->query !== null) {
            return $this->query->execute();
        }

        $this->error['query'] = "Prepare query is empty!";
        $this->error("error");
        return [];
    }

    public function getAll($query=null)
    {
        if($query!==null) {
            $this->query($query);
        }
        try {
            $this->execute();
            return $this->query->fetchAll();
        } catch (PDOException $e) {
            $this->error['fetchAll'] = $e->getMessage();
            $this->error("error");
        }

        return false;
    }

    public function getOne($query=null)
    {
        if($query!==null) {
            $this->query($query);
        }
        try {
            $this->execute();
            return $this->query->fetch();
        } catch (PDOException $e) {
            $this->error['fetch'] = $e->getMessage();
            $this->error("error");
        }

        return false;
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    private function error($type)
    {
        if($type=="error" && $_SERVER['ON_DEV']){
            foreach ($this->error as $type => $message) {
                echo "<h2>$type</h2>";
                echo $message."<br><br>";
            }
        }
        return false;
    }
}
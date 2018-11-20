<?php

class BDD 
{
    private $servername;
    private $username;
    private $password;
    private $conn;
    function __construct()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "root";
    }
    public function connect()
    {
        $this->conn = new PDO("mysql:host=$this->servername;dbname=my_meetic;charset=utf8", $this->username , $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // var_dump($this->conn);
    }
    public function getUsers()
    {
        $result = $this->conn->prepare("SELECT * FROM users");
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);
       
    }
    public function getUser($mail , $password)
    {
        $result = $this->conn->prepare("SELECT name, surname FROM users WHERE mail LIKE LOWER(:mail) AND pasword LIKE :p");
        $result->bindParam(":mail", $mail, PDO::PARAM_STR);
        $result->bindParam(":p", $password, PDO::PARAM_STR);
        $result->execute();
        // var_dump($result->debugDumpParams());
        return $result->fetch(PDO::FETCH_OBJ);
    }
    public function insertUser($name, $surname, $birthdate, $sex, $city, $mail, $pasword)
    {
        $result= $this->conn->prepare("INSERT INTO users (name, surname, birthdate, sex, city, mail, pasword, isDesact) VALUE (:nom, :surname, :birthdate, :sex, :city, LOWER(:mail), :p, 0) ");
        $result->bindParam(":nom", $name, PDO::PARAM_STR);
        $result->bindParam(":surname", $surname, PDO::PARAM_STR);
        $result->bindParam(":birthdate", $birthdate, PDO::PARAM_STR);
        $result->bindParam(":sex", $sex, PDO::PARAM_STR);
        $result->bindParam(":city", $city, PDO::PARAM_STR);
        $result->bindParam(":mail", $mail, PDO::PARAM_STR);
        $result->bindParam(":p", $pasword, PDO::PARAM_STR);
        return  $result->execute();
    }
    public function getInfoUser($mail)
    {
        $result = $this->conn->prepare("SELECT * FROM users WHERE mail LIKE LOWER(:mail)");
        $result->bindParam(":mail", $mail, PDO::PARAM_STR);
        $result->execute();
        $fetchResult = $result->fetchAll(PDO::FETCH_ASSOC);
        if ($fetchResult !== false) {
            
            return $fetchResult[0];
        } else {
            return $fetchResult;
        }
    }
    public function modifInfoUser($name, $surname, $birthdate, $sex, $city, $mail, $id)
    {
        $result = $this->conn->prepare("UPDATE users SET name = :name, surname = :surname, birthdate = :birthdate, sex = :sex, city = :city, mail = LOWER(:mail) WHERE id = :id");
        $result->bindParam(":name", $name, PDO::PARAM_STR);
        $result->bindParam(":surname", $surname, PDO::PARAM_STR);
        $result->bindParam(":birthdate", $birthdate, PDO::PARAM_STR);
        $result->bindParam(":sex", $sex, PDO::PARAM_STR);
        $result->bindParam(":city", $city, PDO::PARAM_STR);
        $result->bindParam(":mail", $mail, PDO::PARAM_STR);
        $result->bindParam(":id", $id, PDO::PARAM_STR);
        return $result->execute();
    }
    public function verifMdp($pasword, $id)
    {
        $result = $this->conn->prepare("SELECT * FROM users WHERE pasword LIKE :p AND id LIKE :id");
        $result->bindParam(":p", $pasword, PDO::PARAM_STR);
        $result->bindParam(":id", $id, PDO::PARAM_STR);
        $result->execute();
        return $result->fetch(PDO::FETCH_OBJ);
    }
    public function changeMdp($pasword, $id)
    {
        $result = $this->conn->prepare("UPDATE users SET pasword = :p WHERE id like :id");
        $result->bindParam(":p", $pasword, PDO::PARAM_STR);
        $result->bindParam(":id", $id, PDO::PARAM_STR);
        return $result->execute();
    }
     public function verifMail($mail)
    {
        $result = $this->conn->prepare("SELECT * FROM users WHERE mail LIKE LOWER(:mail)");
        $result->bindParam(":mail", $mail, PDO::PARAM_STR);
        $result->execute();
        return $result->fetch(PDO::FETCH_OBJ);
    }
    public function desactivation($id)
    {
        $result = $this->conn->prepare("UPDATE users SET isDesact = 1 WHERE id LIKE :id");
        $result->bindParam(":id", $id, PDO::PARAM_STR);
        return $result->execute();
    }
    public function verifAge($age)
    {
        $result= $this->conn->prepare("SELECT FLOOR(DATEDIFF(CURDATE(), :age)/365) AS age");
        $result->bindParam(":age", $age, PDO::PARAM_STR);
        $result->execute();
        return $result->fetch(PDO::FETCH_OBJ);
    }
    public function rechercheTotal($name = NULL,$surname = NULL)
    {
        $result = "SELECT * FROM users ";
        if ($name !== NULL) {
            $result .= "WHERE name LIKE :name";
        }
        if ($surname !== NULL) {
            $result .= "WHERE surname LIKE :surname";
        }
        $result = $this->conn->prepare();
        if ($name !== NULL) {
            bindParam(":name", $name, PDO::PARAM_STR);
        }
        if ($surname !== NULL) {
            bindParam(":surname", $surname, PDO::PARAM_STR);
        }
    }
    public function rechercheHomme($name = NULL,$surname = NULL)
    {
        $result = "SELECT * FROM users WHERE sex LIKE 'Homme'";
        if ($name !== NULL) {
            $result .= "WHERE name LIKE :name ";
        }
        if ($surname !== NULL) {
            $result .= "WHERE surname LIKE :surname ";
        }
        $result = $this->conn->prepare();
        if ($name !== NULL) {
            bindParam(":name", $name, PDO::PARAM_STR);
        }
        if ($surname !== NULL) {
            bindParam(":surname", $surname, PDO::PARAM_STR);
        }
    }
    public function rechercheFemme($name = NULL,$surname = NULL)
    {
        $result = "SELECT * FROM users WHERE sex LIKE 'femme'";
        if ($name !== NULL) {
            $result .= "WHERE name LIKE :name ";
        }
        if ($surname !== NULL) {
            $result .= "WHERE surname LIKE :surname ";
        }
        $result = $this->conn->prepare();
        if ($name !== NULL) {
            bindParam(":name", $name, PDO::PARAM_STR);
        }
        if ($surname !== NULL) {
            bindParam(":surname", $surname, PDO::PARAM_STR);
        }
    }
    public function rechercheVille($ville = NULL)
    {
        $result = "SELECT * FROM users WHERE sex LIKE 'femme'";
        if ($city !== NULL) {
            $result .= "WHERE city LIKE :city ";
        }
        $result = $this->conn->prepare();

        if ($city !== NULL) {
            $city = "%:city%";
            bindParam(":city", $city, PDO::PARAM_STR);
            $result->execute();
            return $result->fetchAll();
        }
    }
}
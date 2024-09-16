<?php
require_once 'db.php';

class User extends Database
{
    public $id;
    public $lastname;
    public $firstname;
    public $email;
    public $password;
    // Clés étrangères
    public $id_roles;

    public function add()
    {
        $query = "INSERT INTO `user` (`lastname`, `firstname`, `email`, `password`, `id_roles`) 
                    VALUES (:lastname, :firstname, :email, :password, :id_roles)";
        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindValue(":lastname", $this->lastname, PDO::PARAM_STR);
            $stmt->bindValue(":firstname", $this->firstname, PDO::PARAM_STR);
            $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue(":password", $this->password, PDO::PARAM_STR);
            $stmt->bindValue(":id_roles", $this->id_roles, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login(){
        $query = "SELECT * FROM user WHERE email = :email AND password = :password";
        try{
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue(":password", $this->password, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
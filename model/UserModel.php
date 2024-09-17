<?php
require_once 'db.php';
require __DIR__ . '/../vendor/autoload.php';


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

            $hashed =  password_hash($this->password, PASSWORD_DEFAULT);

            $stmt->bindValue(":lastname", $this->lastname, PDO::PARAM_STR);
            $stmt->bindValue(":firstname", $this->firstname, PDO::PARAM_STR);
            $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue(":password", $hashed, PDO::PARAM_STR);
            $stmt->bindValue(":id_roles", $this->id_roles, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function boolEmail(){
        $query = "SELECT id
                FROM user
                WHERE email = :email ";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);

            $stmt->execute();

            $count = $stmt->fetchColumn();

            return ($count >= 1);
        } catch (PDOException $e) {
            throw new Exception("Error checking pointage: " . $e->getMessage());
        }
    }

    public function login(){
        $query = "SELECT user.*, roles.role_nom
        FROM user 
        JOIN roles ON user.id_roles = roles.id
        WHERE email = :email AND password = :password";
        try{
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue(":password", $this->password, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function infos(){
        $query = "SELECT user.*, roles.role_nom
        FROM user 
        JOIN roles ON user.id_roles = roles.id
        WHERE email = :email";
        try{
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    function retrievePassword(){
        try {
            $query = 'SELECT password FROM user WHERE email = :email';
            $stmt = $this->db->prepare($query);
            $stmt -> bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt -> execute();

            $result = $stmt -> fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['password'];
            } else {
                return false;
            }
        } catch (PDOException $e){
            return false;
        }
    }
}
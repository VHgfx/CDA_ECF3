<?php 
class Database{

    public $db;

    public function __construct() {
        try {
            $this->db = new PDO ('mysql:host=localhost;dbname=cda_ecf3;charset=utf8','root','');
        } catch (Exception $e) {
            die ('Erreur :'. $e->getMessage());
            
        }

    }
    public function getConnection() {
        return $this->db;
    }
    
}

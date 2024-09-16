<?php
require_once 'db.php';

class Events extends Database
{
    public $id;
    public $event_name;
    public $event_debut;
    public $event_fin;
    public $description;
    // Clés étrangères
    public $id_user;

    public function add()
    {
        $query = "INSERT INTO `events` (`event_name`, `event_debut`, `event_fin`, `description`, `id_user`) 
                            VALUES (:event_name, :event_debut, :event_fin, :description, :id_user)";
        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindValue(":event_name", $this->event_name, PDO::PARAM_STR);
            $stmt->bindValue(":event_debut", $this->event_debut, PDO::PARAM_STR);
            $stmt->bindValue(":event_fin", $this->event_fin, PDO::PARAM_STR);
            $stmt->bindValue(":description", $this->description, PDO::PARAM_STR);
            $stmt->bindValue(":id_user", $this->id_user, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
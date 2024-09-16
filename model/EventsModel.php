<?php
require_once 'db.php';

class Event extends Database
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

    public function getAllBaseInfos()
    {
        $query = "SELECT id, event_name
            FROM events";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getEventInfos()
    {
        $query = "SELECT events.*,
            user.firstname, user.lastname
            FROM events
            JOIN user ON user.id = events.id_user
            WHERE events.id = :id";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            return [];
        }
    }
}
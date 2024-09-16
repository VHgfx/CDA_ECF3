<?php
require_once 'db.php';

class EventParticipants extends Database
{
    public $id;
    public $email;
    public $firstname;
    public $lastname;
    // Clés 
    public $id_user;
    public $id_events;


    public function add(){
        $query = "INSERT INTO `event_participants` (`email`, `firstname`, `lastname`, `id_user`, `id_events`) 
                            VALUES (:email, :firstname, :lastname, :id_user, :id_events)";
        try{
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue(":firstname", $this->firstname, PDO::PARAM_STR);
            $stmt->bindValue(":lastname", $this->lastname, PDO::PARAM_STR);
            $stmt->bindValue(":id_user", $this->id_user, PDO::PARAM_INT);
            $stmt->bindValue(":id_events", $this->id_events, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getParticipants()
    {
        $query = "SELECT 
                    COALESCE(user.firstname, event_inscriptions.firstname) AS firstname,
                    COALESCE(user.lastname, event_inscriptions.lastname) AS lastname,
                    COALESCE(user.email, event_inscriptions.email) AS email, 
                    event_inscriptions.id_user,
                    user.id_roles
                FROM event_inscriptions 
                LEFT JOIN user ON user.id = event_inscriptions.id_user
                WHERE event_inscriptions.id_events = :id_events";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id_events", $this->id_events, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('BaseFunctions.php');
require_once __DIR__.'/../model/EventsModel.php';
require_once __DIR__.'/../model/EventParticipantsModel.php';

function addEvent(){
    try {
        if(checkRequired(['event_name', 'event_debut', 'event_fin', 'description']) == false){
            throw new Exception("Un des champs obligatoire est vide");
        }

        $event_debut = new DateTime($_POST['event_debut']);
        $event_fin = new DateTime($_POST['event_fin']);

        if($event_fin < $event_debut){
            throw new Exception("La date de fin de l'évènement doit être supérieure à la date de début");
        }

        $event = new Event();
        $event->event_name = $_POST['event_name'];
        $event->event_debut = $_POST['event_debut'];
        $event->event_fin = $_POST['event_fin'];
        $event->description = $_POST['description'];
        $event->id_user = $_SESSION['user']['id'];
            
        $result = $event->add();
        if($result == false){
            throw new Exception("Erreur lors de l'ajout de l'évènement");
        } else {
            return "Ajout réussi";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function getListEvents(){
    try {
        $event = new Event();
        $list_events = $event->getAllBaseInfos();
        if(empty($list_events)){
            throw new Exception("Aucun évènement trouvé");
        }
        return $list_events;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function getEventInfos(){
    try {
        if(checkRequired(['select_event_id']) == false){
            throw new Exception("Un des champs obligatoire est vide");
        }

        $event_infos = [];

        $event = new Event();
        $event->id = trim($_POST['select_event_id']);

        $event_infos = [];
        $event_infos['participants'] = [];
        $event_infos = $event->getEventInfos();

        $event_participants = new EventParticipants();
        $event_participants->id_events = $event->id;
        $event_participants_list = $event_participants->getParticipants();

        $event_infos['participants'] = !empty($event_participants_list) ? $event_participants_list : [];
        return $event_infos;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}


function subscribeEvent(){
    try {

        if(checkRequired(['select_event_id', 'lastname', 'firstname', 'email']) == false){
            throw new Exception("Un des champs obligatoire est vide");
        }

        $eventParticipants = new EventParticipants();
        $eventParticipants->id_events = $_POST['select_event_id'];
        $eventParticipants->lastname = $_POST['lastname'];
        $eventParticipants->firstname = $_POST['firstname'];
        $eventParticipants->email = $_POST['email'];
        $eventParticipants->id_user = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

        if($eventParticipants->boolEmail()){
            throw new Exception("Vous êtes déjà inscrit(e) à cet évènement");
        }
        $result = $eventParticipants->add();

        if($result == false){
            throw new Exception("Erreur lors de l'inscription à l'évènement");
        } else {
            return "Inscription réussie";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
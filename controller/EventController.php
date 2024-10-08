<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('EventFunctions.php');
$list_events = getListEvents();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    $input = file_get_contents('php://input');
    $inputDecoded = json_decode($input, true);
    if(!empty($inputDecoded)){
        $action = isset($inputDecoded['action']) ? $inputDecoded['action'] : '';
    }

    $result = [];

    if(!empty($action)){
        switch ($action) {
            case 'addEvent':  
                $_SESSION['add_event_result'] = addEvent();
                break;

            case 'selectEvent':  
                $get_event_infos_result = getEventInfos();
                break;

            case 'subscribeEvent':  
                $_SESSION['subscribe_result'] = subscribeEvent();
                break;

            case 'getEventDetails':
                $get_event_details_result = json_encode(getEventInfos());
                echo $get_event_details_result;
                break;
        }
        $action = null;
        $type = null;
    } 
}
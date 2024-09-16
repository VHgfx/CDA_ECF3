<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('UserFunctions.php');

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
            case 'login':  
                $result = login();

                echo "<script>console.log('result : " . json_encode($result) . "')</script>";
                break;

            default:
                exit();
        }
        $action = null;
        $type = null;
    } 
    if(isset($result) && !empty($result)){
        if($result == false){
            return $result;
        }
    }
}
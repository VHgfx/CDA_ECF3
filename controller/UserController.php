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
                $_SESSION['login_result'] = login();
                if($_SESSION['login_result'] == true) {
                    header("Location: " . $_SERVER['PHP_SELF']);
                }
                break;

            case 'logout':  
                session_destroy();
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
        }
        $action = null;
        $type = null;
    } 
}
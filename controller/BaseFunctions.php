<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function checkRequired(array $required){
    foreach ($required as $field){
        if(empty($_POST[$field])){
            return false;
        } else {
            return true;
        }
    }
}
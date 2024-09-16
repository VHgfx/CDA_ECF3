<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
    include_once(__DIR__.'/view/login.php');
} else {
    $user_lastname = strtoupper($_SESSION['user']['lastname']);
    $user_firstname = $_SESSION['user']['firstname'];
    $user_email = $_SESSION['user']['email'];
    $user_role_nom = $_SESSION['user']['role_nom'];

    echo "Bonjour $user_firstname $user_lastname, vous êtes connecté(e) en tant que $user_role_nom";
}
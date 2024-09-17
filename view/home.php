<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
    include_once(__DIR__.'/login.php');
} else {
    include_once(__DIR__.'/navbar.php');
}
include_once(__DIR__.'/subscribe.php');

if(isset($_SESSION['user']) || !empty($_SESSION['user'])){
    include_once(__DIR__.'/add_event.php');
} 
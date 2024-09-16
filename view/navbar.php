<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_lastname = strtoupper($_SESSION['user']['lastname']);
$user_firstname = $_SESSION['user']['firstname'];
$user_email = $_SESSION['user']['email'];
$user_role_nom = $_SESSION['user']['role_nom'];

echo "Bonjour $user_firstname $user_lastname, vous êtes connecté(e) en tant que $user_role_nom";
?>

<div>
    <a href="home.php">Accueil</a>
    <a href="add_event.php">Ajout évènement</a>
    <a href="select_event.php">Détails d'un évènement</a>
    <?php include_once(__DIR__.'/logout.php'); ?>
</div>
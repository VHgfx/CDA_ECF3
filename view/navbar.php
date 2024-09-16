<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div>
    <a href="home.php">Accueil</a>
    <a href="add_event.php">Ajout évènement</a>
    <a href="select_event.php">Détails d'un évènement</a>
    <a href="subscribe.php">S'inscrire à un évènement</a>
    <?php include_once(__DIR__.'/logout.php'); ?>
</div>
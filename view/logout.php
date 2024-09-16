<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__.'/../controller/UserController.php');
?>

<form method="POST" role="form" id="logoutForm" action="">
    <input type="hidden" name="action" value="logout" />
    <button type="submit">Se déconnecter</button>
</form>
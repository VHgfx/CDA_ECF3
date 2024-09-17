<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../controller/UserController.php');
?>
<form method="POST" role="form" id="inscriptionForm" action="">
    <div style="display:flex; flex-direction:column">
        <h3>Devenir membre</h3>

        <input type="hidden" name="action" value="inscription">

        <label for="firstname">Votre prénom</label>
        <input type="text" name="firstname" required></input>
        <label for="lastname">Votre nom</label>
        <input type="text" name="lastname" required></input>
        <label for="email">Votre email</label>
        <input type="email" name="email" required></input>
        <label for="password">Votre mot de passe</label>
        <input type="password" name="password" required></input>

        <input type="submit" target="_self" name="isSendInscription" value="Créer un compte"></input>
        <?php if (isset($_SESSION['inscription_result']) && !empty($_SESSION['inscription_result'])): ?>
            <p><?= $_SESSION['inscription_result'] ?></p>
            <?php unset($_SESSION['inscription_result']); ?>
        <?php endif; ?>
    </div>
</form>
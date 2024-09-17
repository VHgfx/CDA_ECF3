<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../controller/UserController.php');
?>

<form method="POST" role="form" id="loginForm" action="">
    <div style="display:flex; flex-direction:column">

        <h3>Se connecter</h3>
        <input type="hidden" name="action" value="login">
        <label for="email">Votre email</label>
        <input type="email" name="email" required></input>
        <label for="password">Votre mot de passe</label>
        <input type="password" name="password" required></input>

        <input type="submit" target="_self" name="isSendLogin" value="Connexion"></input>
    </div>
</form>

<?php if (isset($_SESSION['login_result']) && !empty($_SESSION['login_result']) && $_SESSION['login_result'] != true): ?>
    <p><?= $_SESSION['login_result'] ?></p>
    <?php unset($_SESSION['login_result']); ?>
<?php endif; ?>
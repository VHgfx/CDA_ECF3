<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__.'/../controller/UserController.php');
?>

<form method="POST" role="form" id="loginForm" action="">
    <input type="hidden" name="action" value="login">
    <div>
        <label for="email">Votre email</label>
        <input type="email" name="email" required></input>
        <label for="password" >Votre mot de passe</label>
        <input type="password" name="password" required></input>
    </div>
    <input type="submit" target="_self" name="isSendLogin" value="Connexion"></input>
</form>

<?php if (isset($_SESSION['login_result']) && !empty($_SESSION['login_result']) && $_SESSION['login_result'] != true): ?>
    <p><?= $_SESSION['login_result'] ?></p>
    <?php unset($_SESSION['login_result']); ?>
<?php endif; ?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../controller/EventController.php');
?>

<h3>S'inscrire à un évènement</h3>

<form method="POST" role="form" id="subscribeEventForm" action="">
    <input type="hidden" value="subscribeEvent" name="action" />
    <select id="select_event_id" name="select_event_id">
        <option value="">-- Sélectionner un event</option>
        <?php foreach ($list_events as $event): ?>
            <option value="<?= $event['id'] ?>"><?= $event['event_name'] ?></option>
        <?php endforeach; ?>
    </select>
    <?php if (isset($_SESSION['user'])): ?>
        <input type="hidden" name="lastname" value="<?= $_SESSION['user']['lastname'] ?>"></input>
        <input type="hidden" name="firstname" value="<?= $_SESSION['user']['firstname'] ?>"></input>
        <input type="hidden" name="email" value="<?= $_SESSION['user']['email'] ?>" ?>></input>
    <?php else: ?>
        <label for="lastname">Nom</label>
        <input type="text" name="lastname" required></input>
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" required></input>
        <label for="email">Email</label>
        <input type="email" name="email" required></input>
    <?php endif; ?>
    <input type="submit" target="_self" name="isSendSubscribe" value="S'inscrire à l'évènement"></input>
</form>

<?php if (isset($_SESSION['subscribe_result']) && !empty($_SESSION['subscribe_result'])): ?>
    <p><?= $_SESSION['subscribe_result'] ?></p>
    <?php unset($_SESSION['subscribe_result']); ?>
<?php endif; ?>
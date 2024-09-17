<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../controller/EventController.php'); ?>

<h3>Ajouter un évènement</h3>

<form method="POST" role="form" id="addEventForm" action="">
    <input type="hidden" name="action" value="addEvent">
    <div>
        <input type="hidden" name="id_user" value="<?= $_SESSION['user']['id'] ?>">

        <label for="event_name">Nom de l'évènement</label>
        <input type="text" name="event_name" required></input>
        <label for="event_debut">Début de l'évènement</label>
        <input type="datetime-local" name="event_debut" required></input>
        <label for="event_fin">Fin de l'évènement</label>
        <input type="datetime-local" name="event_fin" required></input>
        <label for="description">Description</label>
        <input type="description" name="description" required></input>
    </div>
    <?php if (isset($_SESSION['add_event_result']) && !empty($_SESSION['add_event_result'])): ?>
        <p><?= $_SESSION['add_event_result'] ?></p>
        <?php unset($_SESSION['add_event_result']); ?>
    <?php endif; ?>
    <input type="submit" target="_self" name="isSendAddEvent" value="Ajouter un évènement"></input>
</form>




<?php include_once(__DIR__ . '/select_event.php'); ?>
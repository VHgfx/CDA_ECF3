<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/../controller/EventController.php');
?>
<?php include_once(__DIR__.'/navbar.php'); ?>

<h3>Afficher les participants d'un évènement</h3>

<form method="POST" role="form" id="selectEventForm" action="">
    <input type="hidden" value="selectEvent" name="action" />
    <select id="select_event_id" name="select_event_id" onchange="this.form.submit();">
        <option value="">-- Sélectionner un event</option>
        <?php foreach ($list_events as $event): ?>
            <option value="<?= $event['id'] ?>"><?= $event['event_name'] ?></option>
        <?php endforeach; ?>
    </select>
</form>

<?php if (isset($get_event_infos_result) && !empty($get_event_infos_result)): ?>
    <table>
        <thead>
            <tr>
                <th>Nom de l'évènement</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Description</th>
                <th>Auteur</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $get_event_infos_result[0]['event_name'] ?></td>
                <td><?= $get_event_infos_result[0]['event_debut'] ?></td>
                <td><?= $get_event_infos_result[0]['event_fin'] ?></td>
                <td><?= $get_event_infos_result[0]['description'] ?></td>
                <td><?= $get_event_infos_result[0]['firstname'] ?>     <?= $get_event_infos_result[0]['lastname'] ?></td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th>Nom et prénom</th>
                <th>Email</th>
                <th>Inscrit ?</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($get_event_infos_result['participants'])): ?>
                <?php foreach ($get_event_infos_result['participants'] as $participant): ?>
                    <tr>
                        <td><?= $participant['firstname'] ?>             <?= $participant['lastname'] ?></td>
                        <td><?= $participant['email'] ?></td>
                        <td><?= $participant['id_user'] != null ? "Oui" : "Non" ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Aucun participant inscrit à cet évènement</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php endif; ?>
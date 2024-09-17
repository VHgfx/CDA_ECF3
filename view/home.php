<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user']) || empty($_SESSION['user'])) :?>
    <div style="display: flex; justify-content: center; flex-direction:row;">
        <?php include_once(__DIR__.'/login.php'); ?>
        <span style="width:15px"></span>
        <?php include_once(__DIR__.'/inscription.php'); ?>
    </div>
   
<?php else : ?>
    <?php include_once(__DIR__.'/navbar.php'); ?>
<?php endif; ?>

<?php include_once(__DIR__.'/subscribe.php');

if(isset($_SESSION['user']) || !empty($_SESSION['user'])){
    include_once(__DIR__.'/add_event.php');
} 
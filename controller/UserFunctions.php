<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('BaseFunctions.php');
require_once __DIR__.'/../model/UserModel.php';

function login(){
    try {
        if(isset($_SESSION['user'])){
            return true;
        }

        if(checkRequired(['email', 'password']) == false){
            throw new Exception("Un des champs obligatoire est vide");
        }

        $user = new User();
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        var_dump($user);
            
        $og_password = $user->retrievePassword();

        var_dump($og_password);


        if(password_verify($user->password,$og_password)){
            $result_infos = $user->infos();
            $_SESSION['user'] = $result_infos;
            return true;
        } else {
            throw new Exception("Mauvais mot de passe");        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
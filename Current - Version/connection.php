<?php
session_start();
include 'includes/classes/db_pdo.php';
include 'includes/resources/connection_clients.php';
include 'includes/resources/decryptage.php';
include 'includes/resources/cryptage_data.php';

if (isset($_POST['logins'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        header("location:login.php?Empty= S'il vous plaît veuillez remplir tous les champs obligatoires");
    } else {
        $db_pdo = new db_pdo();
        $connection = new connection_clients($db_pdo);

        $email = $_POST['email'];
        $password  = $_POST['password'];

        $email = CryptageEmail($email);

        $dataUser = $connection->ConnectionUser($email);

        if (VerifyHashPassword($password, $dataUser[0][3]) == 0) {
            if ($dataUser[0][1] == 0 || $dataUser[0][1] == false) {
                header("location:login.php?Empty= Veuillez confirmer votre compte. Un email de confirmation vous a été envoyé");
            } else if ($dataUser[0][2] == 1) {
                $_SESSION['keyuser'] = $dataUser[0][0];
                $_SESSION['email'] =  EncodeData($_POST['email']);
                header("location:shopping_shop.php");
            } else {
                $_SESSION['keyuser'] = $dataUser[0][0];
                $_SESSION['email'] =  EncodeData($_POST['email']);
                header("location:panel/dashboard_pmu.php");
            }
        } else {
            header("location:login.php?Invalid= Information incorrecte");
        }
    }
} else {
    header("location:error/404.html");
}
?>
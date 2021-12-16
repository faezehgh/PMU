<?php
include 'includes/classes/db_pdo.php';
if(isset($_GET['key'])){
    $key = $_GET['key'];

    $db_pdo = new db_pdo();
    if($db_pdo->queryInsertion("UPDATE clients idpermission = 1,  check_account = 1 WHERE use_key = '$key';") == 0){
        header("location:index.php");
    }else{
        echo "<h1>AAAAAAAAAAAAAAAAAAAAAAAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaahhh Erreur</h1>";
    }
}
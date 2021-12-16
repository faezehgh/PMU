<?php
include '../classes/db_pdo.php'; // Classe PDO connection
include 'cryptage_data.php';
$db_pdo = new db_pdo(); // connection base de données

if (isset($_POST['submit-client'])) { // Formulaire d'ajout client
    try{
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $codepostal = $_POST['cp'];
        $address = $_POST['adresse'];
        $permission = $_POST['permission'];
        $check = $_POST['check'];
        $password = $_POST['pass'];
    
        $userArray = array($fname, $lname, $address, $phone); // Tableau des données a encoder
    
        // Crytage des données
        $encodeData = EncodeMultiDatas($userArray);
        $keyUser = KeyUniqueUser($email . $password);
        $email = CryptageEmail($email);
        $pass = CryptagePassword($password);
    
        $db_pdo->queryInsertion("INSERT INTO clients (last_name, first_name, email, phone, city, postal_code, address, idpermission, check_account, use_key) VALUES ('$encodeData[0]', '$encodeData[1]', '$email', '$encodeData[3]', '$city', '$codepostal', '$encodeData[2]', '$permission', '$check', '$keyUser');");
        $selectId = $db_pdo->queryExtraction("SELECT idclients FROM clients ORDER BY idclients DESC LIMIT 1;");
        $selectId = $selectId->fetchAll();
        foreach ($selectId as $id) {
            $db_pdo->queryInsertion("INSERT INTO identifiers (idpassword_client, password) VALUES (" . $id[0][0] . " , '$pass');");
        }
        header("location:../../panel/client.php");
    }catch(Exception $ex){
        print " Erreur : " . $ex->getMessage();
    }
    
}

if(isset($_POST['update-client'])){ // Formulaire de modification des permissions et check compte
    try{
        $id = $_POST['id'];
        $permission = $_POST['permission'];
        $check = $_POST['check'];
        $db_pdo->queryInsertion("UPDATE clients SET idpermission='$permission', check_account='$check' WHERE idclients='$id'; ");
        header("location:../../panel/client.php");
    }catch(Exception $ex){
        print " Erreur : " . $ex->getMessage();
    }
}

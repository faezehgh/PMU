<?php
session_start();
include '../classes/db_pdo.php'; // Classe PDO connection
include '../classes/panier.php';

$db_pdo = new db_pdo(); // connection base de données
if (isset($_POST['add'])) { // Formulaire d'ajout client
    try{
        $productID = $_POST['custId'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $panier = new panier();
        $panier->AddItems($productID, $quantity, $price);
        header("location:../../index.php");
    }catch(Exception $ex){
        die("Errer" + $ex);
    }
}

if(isset($_GET['test'])){
   // $id = array_keys($_SESSION['panier']);
    //var_dump($id);
    //var_dump($_SESSION['panier']);
}
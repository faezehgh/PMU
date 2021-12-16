<?php
class panier
{

    function __construct() // Constructeur de classe
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['productId'] = array();
            $_SESSION['panier']['quantity'] = array();
            $_SESSION['panier']['price'] = array();
        }
    }

    public function AddItems($productId, $quantity, $price)
    { // Ajouter l'id  article dans un tableau
        //$_SESSION['panier'][$productId] = 1;
        //$_SESSION['panier'][$quantity] = 1;
        array_push($_SESSION['panier']['productId'], $productId);
        array_push($_SESSION['panier']['quantity'], $quantity);
        array_push($_SESSION['panier']['price'], $price);
    }
}

function priceQuantity($quantity, $sellPrice)
{
    $calcul = 0;
    $calcul = ($quantity * $sellPrice);
    return number_format($calcul, 2, '.', ',');
}

function MontantGlobal(array $arrayArticles)
{
    $total = 0;
    for ($i = 0; $i < count($_SESSION['panier']['productId']); $i++) {
        $total += $_SESSION['panier']['quantity'][$i] * $_SESSION['panier']['price'][$i];
    }
    return number_format($total, 2, '.', ',');
}

function MontantGlobalTVA(array $arrayArticles, $tva)
{
    $totalTva = 0;
    for ($i = 0; $i < count($_SESSION['panier']['productId']); $i++) {
        $totalTva += $_SESSION['panier']['quantity'][$i] * $_SESSION['panier']['price'][$i];
    }
    $totalTva = $totalTva * (($tva/100)+1);
    return number_format($totalTva, 2, '.', ',');
}

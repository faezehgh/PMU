<?php
include '../classes/db_pdo.php';
$db_pdo = new db_pdo(); // connection base de données

// Ajout de nouveau article
if (isset($_POST['submit-article'])) {
    try {
        // données article 
        $ref = $_POST['ref'];
        $label = $_POST['label'];
        $desc = $_POST['desc'];
        $stock = $_POST['stock'];
        $stockAlterte = $_POST['stock-alerte'];
        $prix = $_POST['prix'];
        $categorie = $_POST['categorie'];

        $ref = strtoupper($ref); // $ref en Majuscule

        $selectRef = $db_pdo->queryExtraction("SELECT refarticles FROM articles WHERE refarticles = '" . $ref . "';");
        $selectRef = $selectRef->fetchAll();

        if (empty($selectRef)) { // vérifié si la référence n'existe pas
            $file = $_FILES['picture'];
            $fileName = $_FILES['picture']['name'];
            $fileTmpName = $_FILES['picture']['tmp_name'];
            $fileSize = $_FILES['picture']['size'];
            $fileError = $_FILES['picture']['error'];
            $fileType = $_FILES['picture']['type'];

            $file_ext = explode(".", strval($fileName[0]));
            $file_ext_file =  end($file_ext);

            $extension = array('jpg', 'png', 'gif', 'jpeg'); // Extension du fichier images 

            if (!in_array($file_ext_file, $extension)) {
                header("location:../../panel/article.php?ErrorExt= Extension du fichier incorrect");
            } else {
                if ($fileError[0] === 0) {
                    if ($fileSize[0] < 3000000) { // taille image 3Mo = 3000000
                        $img_dir = '../../images/' . $fileName[0];
                        move_uploaded_file($fileTmpName[0], $img_dir); // Upload l'image dans le dossier images
                        $db_pdo->queryInsertion("INSERT INTO picture (path_picture) VALUES ('images/" . $fileName[0] . "');");
                    } else {
                        header("location:../../panel/article.php?ErrorBig= Fichier trop volumineux");
                    }
                } else {
                    header("location:../../panel/article.php?ErrorUp= Une erreur s'est produite lors du téléchargement de votre fichier");
                }
            }

            $categorie = explode(" - ", strval($categorie)); //split

            $selectPicture = $db_pdo->queryExtraction("SELECT idpicture FROM picture WHERE path_picture = 'images/" . $fileName[0] . "';");
            $selectPicture = $selectPicture->fetchAll();

            $db_pdo->queryInsertion("INSERT INTO articles (refarticles, label, description, current_stock, alerte_stock, sell_price, idcategory, idpicture) VALUES ('" . $ref . "', '" . $label . "', '" . $desc . "', " . $stock . ", " . $stockAlterte . ", " . $prix . ", " . $categorie[0] . " , " . $selectPicture[0][0] . ");");
            header("location:../../panel/article.php?Valide= " . $ref);
            exit();
        } else {
            header("location:../../panel/article.php?ErrorRef= La reference produit existe deja");
        }
    } catch (Exception $ex) {
        print " Erreur : " . $ex->getMessage();
    }
}

// Modifiaction d'un article
if (isset($_POST['update-article'])) {

    // données article
    $ref = $_POST['custId'];
    $label = $_POST['label'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $stockAlerte = $_POST['alerte'];
    $categorie = $_POST['categorie'];
    $picture = $_POST['picture-existing'];

    $categorie = explode(" - ", strval($categorie)); //split

    // données image
    $file = $_FILES['picture'];
    $fileName = $_FILES['picture']['name'];
    $fileTmpName = $_FILES['picture']['tmp_name'];
    $fileSize = $_FILES['picture']['size'];
    $fileError = $_FILES['picture']['error'];
    $fileType = $_FILES['picture']['type'];

    if ((int)$fileSize[0] != 0) { // Modification article + image
        $file_ext = explode(".", strval($fileName[0]));
        $file_ext_file =  end($file_ext);

        $extension = array('jpg', 'png', 'gif', 'jpeg');

        if (!in_array($file_ext_file, $extension)) {
            header("location:../../panel/article.php?ErrorExt= Extension du fichier incorrect");
        } else {
            if ($fileError[0] === 0) {
                if ($fileSize[0] < 3000000) { // taille image 3Mo = 3000000
                    $img_dir = '../../images/' . $fileName[0];
                    move_uploaded_file($fileTmpName[0], $img_dir); // Upload l'image dans le dossier images
                    $db_pdo->queryInsertion("INSERT INTO picture (path_picture) VALUES ('images/" . $fileName[0] . "');");
                } else {
                    header("location:../../panel/article.php?ErrorBig= Fichier trop volumineux");
                }
            } else {
                header("location:../../panel/article.php?ErrorUp= Une erreur s'est produite lors du téléchargement de votre fichier");
            }
        }

        $selectPicture = $db_pdo->queryExtraction("SELECT idpicture FROM picture WHERE path_picture = 'images/" . $fileName[0] . "';");
        $selectPicture = $selectPicture->fetchAll();

        $db_pdo->queryInsertion("UPDATE articles SET label='" . $label . "', description='" . $desc . "', current_stock=" . $stock . ", alerte_stock=" . $stockAlerte . ", sell_price=" . $price . ", idcategory=" . $categorie[0] . ", idpicture=" . $selectPicture[0][0] . " WHERE refarticles = '" . $ref . "'");
        header("location:../../panel/article.php?Update= " . $ref);
    } else { // sinon
        if ($picture == "Garder l'image par défaut") { // Modification garder l'image qui était déjà attribué
            $db_pdo->queryInsertion("UPDATE articles SET label='" . $label . "', description='" . $desc . "', current_stock=" . $stock . ", alerte_stock=" . $stockAlerte . ", sell_price=" . $price . ", idcategory=" . $categorie[0] . " WHERE refarticles = '" . $ref . "';");
            header("location:../../panel/article.php?Update= " . $ref);
        } else { // Modification article + image existante en base
            $picture = explode(" - ", strval($picture)); //split
            $db_pdo->queryInsertion("UPDATE articles SET label='" . $label . "', description='" . $desc . "', current_stock=" . $stock . ", alerte_stock=" . $stockAlerte . ", sell_price=" . $price . ", idcategory=" . $categorie[0] . ", idpicture=" . $picture[0] . " WHERE refarticles = '" . $ref . "'");
            header("location:../../panel/article.php?Update= " . $ref);
        }
    }
} else {
    //header("location:".  $_SERVER['HTTP_REFERER']);
    header("location:../../panel/article.php");
}

// Suppression d'un article
if (isset($_POST['delete-article'])) {
    $ref = $_POST['custId'];
    $db_pdo->queryInsertion("DELETE FROM articles WHERE refarticles = '" . $ref . "';");
    header("location:../../panel/article.php?Delete= " . $ref);
} else {
    //header("location:".  $_SERVER['HTTP_REFERER']);
    header("location:../../panel/article.php");
}

<?php
include '../classes/db_pdo.php';
$db_pdo = new db_pdo(); // connection base de données

// Ajout de nouveau schéma 
if (isset($_POST['upload-plan'])) {
    if (empty($_POST['ref'])) {
        header("location:../../panel/assembly_diagram.php");
    } else {
        try {
            // données article 
            $ref = $_POST['ref'];
            $label = $_POST['label'];
            $desc = $_POST['desc'];
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

                $extension = array('jpg', 'png', 'gif', 'jpeg'); // Extension

                if (!in_array($file_ext_file, $extension)) {
                    header("location:../../panel/assembly_diagram.php?ErrorExt= Extension du fichier incorrect");
                } else {
                    if ($fileError[0] === 0) {
                        if ($fileSize[0] < 3000000) { // taille image 3Mo = 3000000
                            $img_dir = '../../images/schema/' . $fileName[0];
                            move_uploaded_file($fileTmpName[0], $img_dir); // Upload l'image dans le dossier images
                            $db_pdo->queryInsertion("INSERT INTO picture (path_picture) VALUES ('images/schema/" . $fileName[0] . "');");
                        } else {
                            header("location:../../panel/assembly_diagram.php?ErrorBig= Fichier trop volumineux");
                        }
                    } else {
                        header("location:../../panel/assembly_diagram.php?ErrorUp= Une erreur s'est produite lors du téléchargement de votre fichier");
                    }
                }


                $categorie = explode(" - ", strval($categorie)); //split

                $selectPicture = $db_pdo->queryExtraction("SELECT idpicture FROM picture WHERE path_picture = 'images/schema/" . $fileName[0] . "';");
                $selectPicture = $selectPicture->fetchAll();

                $db_pdo->queryInsertion("INSERT INTO articles (refarticles, label, description, current_stock, alerte_stock, sell_price, idcategory, idpicture) VALUES ('" . $ref . "', '" . $label . "', '" . $desc . "', 1 , 0 , 0.00 , 18 , " . $selectPicture[0][0] . ");");

                $file = $_FILES['document'];
                $fileName = $_FILES['document']['name'];
                $fileTmpName = $_FILES['document']['tmp_name'];
                $fileSize = $_FILES['document']['size'];
                $fileError = $_FILES['document']['error'];
                $fileType = $_FILES['document']['type'];

                $file_ext = explode(".", strval($fileName[0]));
                $file_ext_file =  end($file_ext);

                if ($file_ext_file != 'pdf') { // Extension accepter est .pdf
                    header("location:../../panel/assembly_diagram.php?ErrorExt= Extension du fichier incorrect");
                } else {
                    if ($fileError[0] === 0) {
                        if ($fileSize[0] < 7800000) { // taille image 7Mo = 7000000
                            $document_dir = '../../images/schema/' . $fileName[0];
                            move_uploaded_file($fileTmpName[0], $document_dir); // Upload le document dans le dossier images/schema
                            $db_pdo->queryInsertion("INSERT INTO assembly_diagram (refarticles_assembly, path_assembly) VALUES ( '" . $ref . "', 'images/schema/" . $fileName[0] . "');");
                            header("location:../../panel/assembly_diagram.php?Valide= " . $ref);
                            exit();
                        } else {
                            $db_pdo->queryInsertion("DELETE FROM picture WHERE idpicture = " . $selectPicture[0][0] . ";");
                            $db_pdo->queryInsertion("DELETE FROM articles WHERE refarticles = '" . $ref . "';");
                            header("location:../../panel/assembly_diagram.php?ErrorBig= Fichier trop volumineux");
                        }
                    } else {
                        $db_pdo->queryInsertion("DELETE FROM picture WHERE idpicture = " . $selectPicture[0][0] . ";");
                        $db_pdo->queryInsertion("DELETE FROM articles WHERE refarticles = '" . $ref . "';");
                        header("location:../../panel/assembly_diagram.php?ErrorUp= Une erreur s'est produite lors du téléchargement de votre fichier");
                    }
                }
            } else {
                $db_pdo->queryInsertion("DELETE FROM picture WHERE idpicture = " . $selectPicture[0][0] . ";");
                $db_pdo->queryInsertion("DELETE FROM articles WHERE refarticles = '" . $ref . "';");
                header("location:../../panel/assembly_diagram.php?ErrorRef= La reference produit existe deja");
            }
        } catch (Exception $ex) {
            print " Erreur : " . $ex->getMessage();
        }
    }
}

// Modifiaction d'un article
if (isset($_POST['update-assembly'])) {
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

    // données document pdf
    $fileDoc = $_FILES['document'];
    $fileNameDoc = $_FILES['document']['name'];
    $fileTmpNameDoc = $_FILES['document']['tmp_name'];
    $fileSizeDoc = $_FILES['document']['size'];
    $fileErrorDoc = $_FILES['document']['error'];
    $fileTypeDoc = $_FILES['document']['type'];


    if ((int)$fileSize[0] != 0 || (int)$fileSizeDoc[0] != 0) { // Modification article + image
        $file_ext = explode(".", strval($fileName[0]));
        $file_ext_file =  end($file_ext);

        $extension = array('jpg', 'png', 'gif', 'jpeg');

        if (!in_array($file_ext_file, $extension)) {
            header("location:../../panel/assembly_diagram.php?ErrorExt= Extension du fichier incorrect");
        } else {
            if ($fileError[0] === 0) {
                if ($fileSize[0] < 3000000) { // taille image 3Mo = 3000000
                    $img_dir = '../../images/' . $fileName[0];
                    move_uploaded_file($fileTmpName[0], $img_dir); // Upload l'image dans le dossier images
                    $db_pdo->queryInsertion("INSERT INTO picture (path_picture) VALUES ('images/" . $fileName[0] . "');");
                } else {
                    header("location:../../panel/assembly_diagram.php?ErrorBig= Fichier trop volumineux");
                }
            } else {
                header("location:../../panel/assembly_diagram.php?ErrorUp= Une erreur s'est produite lors du téléchargement de votre fichier");
            }
        }

        $selectPicture = $db_pdo->queryExtraction("SELECT idpicture FROM picture WHERE path_picture = 'images/" . $fileName[0] . "';");
        $selectPicture = $selectPicture->fetchAll();

        $db_pdo->queryInsertion("UPDATE articles SET label='" . $label . "', description='" . $desc . "', current_stock=" . $stock . ", alerte_stock=" . $stockAlerte . ", sell_price=" . $price . ", idcategory=" . $categorie[0] . ", idpicture=" . $selectPicture[0][0] . " WHERE refarticles = '" . $ref . "'");
        if ((int)$fileSizeDoc[0] != 0) {
            $file_ext = explode(".", strval($fileNameDoc[0]));
            $file_ext_file =  end($file_ext);

            if ($file_ext_file != 'pdf') {
                header("location:../../panel/assembly_diagram.php?ErrorExt= Extension du fichier incorrect");
            } else {
                if ($fileErrorDoc[0] === 0) {
                    if ($fileSizeDoc[0] < 7800000) { // Taille 7Mo
                        $document_dir = '../../images/schema/' . $fileNameDoc[0];
                        move_uploaded_file($fileTmpNameDoc[0], $document_dir); // Upload le document dans le dossier images/schema
                        $db_pdo->queryInsertion("UPDATE assembly_diagram SET path_assembly = 'images/schema/" . $fileNameDoc[0] . "' WHERE refarticles_assembly = '" . $ref . "';");
                        header("location:../../panel/assembly_diagram.php?Update= " . $ref);
                    }
                }
            }
        }
        header("location:../../panel/assembly_diagram.php?Update= " . $ref);
    } else { // sinon
        if ($picture == "Garder l'image par défaut") { // Modification garder l'image qui était déjà attribué
            if ((int)$fileSizeDoc[0] != 0) {
                $file_ext = explode(".", strval($fileNameDoc[0]));
                $file_ext_file =  end($file_ext);

                if ($file_ext_file != 'pdf') {
                    header("location:../../panel/assembly_diagram.php?ErrorExt= Extension du fichier incorrect");
                } else {
                    if ($fileErrorDoc[0] === 0) {
                        if ($fileSizeDoc[0] < 7800000) { // Taille 7Mo
                            $document_dir = '../../images/schema/' . $fileNameDoc[0];
                            move_uploaded_file($fileTmpNameDoc[0], $document_dir); // Upload le document dans le dossier images/schema
                            $db_pdo->queryInsertion("UPDATE assembly_diagram SET path_assembly = 'images/schema/" . $fileNameDoc[0] . "' WHERE refarticles_assembly = '" . $ref . "';");
                            $db_pdo->queryInsertion("UPDATE articles SET label='" . $label . "', description='" . $desc . "', current_stock=" . $stock . ", alerte_stock=" . $stockAlerte . ", sell_price=" . $price . ", idcategory=" . $categorie[0] . " WHERE refarticles = '" . $ref . "';");
                            header("location:../../panel/assembly_diagram.php?Update= " . $ref);
                        }
                    }
                }
            } else {
                $db_pdo->queryInsertion("UPDATE articles SET label='" . $label . "', description='" . $desc . "', current_stock=" . $stock . ", alerte_stock=" . $stockAlerte . ", sell_price=" . $price . ", idcategory=" . $categorie[0] . " WHERE refarticles = '" . $ref . "';");
                header("location:../../panel/assembly_diagram.php?Update= " . $ref);
            }
        } else { // Modification article + image existante en base
            if ((int)$fileSizeDoc[0] != 0) {
                $file_ext = explode(".", strval($fileNameDoc[0]));
                $file_ext_file =  end($file_ext);

                if ($file_ext_file != 'pdf') {
                    header("location:../../panel/assembly_diagram.php?ErrorExt= Extension du fichier incorrect");
                } else {
                    if ($fileErrorDoc[0] === 0) {
                        if ($fileSizeDoc[0] < 7800000) { // Taille 7Mo
                            $document_dir = '../../images/schema/' . $fileNameDoc[0];
                            move_uploaded_file($fileTmpNameDoc[0], $document_dir); // Upload le document dans le dossier images/schema
                            $db_pdo->queryInsertion("UPDATE assembly_diagram SET path_assembly = 'images/schema/" . $fileNameDoc[0] . "' WHERE refarticles_assembly = '" . $ref . "';");
                            $picture = explode(" - ", strval($picture)); //split
                            $db_pdo->queryInsertion("UPDATE articles SET label='" . $label . "', description='" . $desc . "', current_stock=" . $stock . ", alerte_stock=" . $stockAlerte . ", sell_price=" . $price . ", idcategory=" . $categorie[0] . ", idpicture=" . $picture[0] . " WHERE refarticles = '" . $ref . "'");
                            header("location:../../panel/assembly_diagram.php?Update= " . $ref);
                        }
                    }
                }
            } else {
                $picture = explode(" - ", strval($picture)); //split
                $db_pdo->queryInsertion("UPDATE articles SET label='" . $label . "', description='" . $desc . "', current_stock=" . $stock . ", alerte_stock=" . $stockAlerte . ", sell_price=" . $price . ", idcategory=" . $categorie[0] . ", idpicture=" . $picture[0] . " WHERE refarticles = '" . $ref . "'");
                header("location:../../panel/assembly_diagram.php?Update= " . $ref);
            }
        }
    }
    exit();
} else {
    //header("location:".  $_SERVER['HTTP_REFERER']);
    header("location:../../panel/assembly_diagram.php");
}

// Suppression d'un article
if (isset($_POST['delete-assembly'])) {
    $ref = $_POST['custId'];
    $db_pdo->queryInsertion("DELETE FROM articles WHERE refarticles = '" . $ref . "';");
    $db_pdo->queryInsertion("DELETE FROM assembly_diagram WHERE refarticles_assembly = '" . $ref . "';");
    header("location:../../panel/assembly_diagram.php?Delete= " . $ref);
    exit();
} else {
    //header("location:".  $_SERVER['HTTP_REFERER']);
    header("location:../../panel/assembly_diagram.php");
}
?>
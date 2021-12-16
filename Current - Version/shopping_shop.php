<?php
session_start();

include 'includes/classes/db_pdo.php';
include 'includes/classes/clients.php';
include 'includes/resources/decryptage.php';

if (isset($_SESSION['keyuser'])) {
    $keyuser = $_SESSION['keyuser'];
    $email = $_SESSION['email'];
}
?>

<?php require 'includes/html/header.php'; ?>

<body>

    <!--<div class="loader-pages"></div>-->

    <div id="page">
        <!-- Menu de navigation -->
        <nav class="menuN-nav" role="navigation">
            <div class="container">
                <div class="styleNeC-top-logo">
                    <div id="styleNeC-logo">
                        <a href="shopping_shop.php">P.M.U | Boutique</a>
                        <br>
                        <div id="styleNeC-logo-label">
                            <a href="shopping_shop.php">Pièce Mécano à l'Unité</a></div>
                    </div>
                </div>
                <div class="styleNeC-top-menu menu-1 text-center">
                    <ul>
                        <li><a href="shopping_shop.php">Magasin</a></li>
                        <li class="has-dropdown">
                            <a href="#">Menu Intéressant</a>
                            <ul class="dropdown">
                                <li><a href="#">Pièces détachées</a></li>
                                <li><a href="assembly.php">Shéma de construction</a></li>
                                <li><a href="promotion_shop.php">Promotion</a></li>
                                <li><a href="#">Evénement</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="about.php">Notre Entreprise</a></li>
                    </ul>
                </div>
                <div class="styleNeC-top-compte menu-1 text-right">
                    <ul class="styleNeC-social">
                        <li><a href="includes/resources/disconnection_clients.php"><i class="icon-login"></i></a></li>
                        <li><a href="about_me.php"><i class="icon-v-card"></i></a></li>
                        <li><a href="panier.php?view"><i class="icon-shopping-cart"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--End Menu de navigation -->

        <div id="styleNeC-work">
            <div class="container">
                <div class="row top-line animate-box">
                    <aside class="col-md-7">
                        <form class="navbar-form navbar-left" role="search" method="POST">
                            <div class="form-group">
                                <input type="text" id="searchdate" name="searchdate" class="form-control sm" placeholder="Recherche">
                            </div>
                            <div class="form-group">
                                <select class="form-control sm sm-select" id="searchoption" name="searchoption">
                                    <option value="1">Pertinent</option>
                                    <option value="2">Prix Croissant</option>
                                    <option value="3">Prix Décroissant</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control sm sm-select" id="category" name="category">
                                    <option value="0">Catégorie</option>
                                    <option value="1">Vis</option>
                                    <option value="2">Plaque</option>
                                    <option value="3">Roue</option>
                                    <option value="4">Outils</option>
                                    <option value="5">Barre</option>
                                    <option value="6">Ressort</option>
                                </select>
                            </div>
                            <button type="submit" id="search" name="search" class="btn btn-primary btn-sm-styleNeC-work">
                                <span class="icon-search"></span>
                            </button>
                        </form>
                    </aside>
                </div>
                <div class="row">
                    <?php
                    $db_pdo = new db_pdo(); // class database

                    if (isset($_POST['search'])) {
                        $data = $_POST['searchdate'];
                        $option = $_POST['searchoption'];
                        $category = $_POST['category'];

                        if ($category == 0) {
                            switch ($option) {
                                case 1:
                                    $selectS = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.sell_price, p.path_picture FROM articles AS a, picture AS p WHERE a.idpicture = p.idpicture AND a.label LIKE '" . $data . "%'"); // database function queryExtraction select + where
                                    ViewDataSelect($selectS);
                                    break;
                                case 2:
                                    $selectS = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.sell_price, p.path_picture FROM articles AS a, picture AS p WHERE a.idpicture = p.idpicture AND a.label LIKE '" . $data . "%' ORDER BY a.sell_price ASC"); // database function queryExtraction select + where
                                    ViewDataSelect($selectS);
                                    break;
                                case 3:
                                    $selectS = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.sell_price, p.path_picture FROM articles AS a, picture AS p WHERE a.idpicture = p.idpicture AND a.label LIKE '" . $data . "%' ORDER BY a.sell_price DESC"); // database function queryExtraction select + where
                                    ViewDataSelect($selectS);
                                    break;
                            }
                        }

                        switch ($category) {
                            case 1:
                                $selectS = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.sell_price, p.path_picture FROM articles AS a, picture AS p, category AS c WHERE a.idpicture = p.idpicture AND a.idcategory = c.idcategory AND a.idcategory = 0;"); // database function queryExtraction select + where
                                ViewDataSelect($selectS);
                                break;
                            case 2:
                                $selectS = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.sell_price, p.path_picture FROM articles AS a, picture AS p, category AS c WHERE a.idpicture = p.idpicture AND a.idcategory = c.idcategory AND a.idcategory = 4;"); // database function queryExtraction select + where
                                ViewDataSelect($selectS);
                                break;
                            case 3:
                                $selectS = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.sell_price, p.path_picture FROM articles AS a, picture AS p, category AS c WHERE a.idpicture = p.idpicture AND a.idcategory = c.idcategory AND a.idcategory = 8;"); // database function queryExtraction select + where
                                ViewDataSelect($selectS);
                                break;
                            case 4:
                                $selectS = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.sell_price, p.path_picture FROM articles AS a, picture AS p, category AS c WHERE a.idpicture = p.idpicture AND a.idcategory = c.idcategory AND a.idcategory = 13;"); // database function queryExtraction select + where
                                ViewDataSelect($selectS);
                                break;
                            case 5:
                                $selectS = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.sell_price, p.path_picture FROM articles AS a, picture AS p, category AS c WHERE a.idpicture = p.idpicture AND a.idcategory = c.idcategory AND a.idcategory = 15;"); // database function queryExtraction select + where
                                ViewDataSelect($selectS);
                                break;
                        }
                    } else {
                        $selectS = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.sell_price, p.path_picture FROM articles AS a, picture AS p WHERE a.idpicture = p.idpicture AND a.refarticles NOT IN (SELECT refarticles_assembly FROM assembly_diagram);"); // database function queryExtraction select
                        ViewDataSelect($selectS);
                    }

                    function ViewDataSelect($querySelect)
                    {
                        $querySelect = $querySelect->fetchAll(); //fectchAll() Retourne un tableau contenant toutes les lignes du jeu d'enregistrements 
                        foreach ($querySelect as $product) { // boucle foreach affiche contenue des lignes
                            echo '                     <div class="col-md-4 text-center animate-box">' . "\n";
                            echo '                        <a class="work" href="#" onClick="ViewItems(\'' . $product[0] . '\', \'' . $product[2] . '\')">' . "\n";
                            echo '                            <div class="work-grid" style="background-image:url(' . $product[3] . ');">' . "\n";
                            echo '                                <div class="inner">' . "\n";
                            echo '                                    <div class="desc">' . "\n";
                            echo '                                       <h3>' . $product[1] . '</h3>' . "\n";
                            echo '                                        <span class="cat">' . $product[2] . '€ </span>' . "\n";
                            echo '                                    </div></div></div></a></div>' . "\n";
                        }
                    }
                    ?>
                    <!--End Items list-->
                </div>

                <div id="styleNeC-started">
                    <div class="container">
                        <div class="row animate-box">
                            <div class="col-md-8 col-md-offset-2 text-center styleNeC-heading">
                                <h2>Voir les PROMOTIONS</h2>
                                <p>L'objectif d'une promotion vise à attirer davantage l'attention du consommateur en s'efforçant de faire mieux connaître, de faire mieux apprécier, et de faire acheter le produit.</p>
                                <p><a href="#" class="btn btn-primary">Aller voir</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'includes/html/footer.php'; ?>
    </div>

    <!-- Bouton pour retourner vers le haut de la page -->
    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>

    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="assets/js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <!-- Main -->
    <script src="assets/js/main.js"></script>

    <script>
        function ViewItems(id, price) {
            var data = {
                "id": id,
                "price": price
            };
            jQuery.ajax({
                url: '../includes/html/itemsDetails.php',
                method: "post",
                data: data,
                success: function(data) {
                    jQuery('body').append(data);
                    jQuery('#details-items').modal('toggle');
                },
                error: function() {
                    alert("error");
                }
            });
        }
    </script>

</body>

</html>
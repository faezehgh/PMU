<?php
include 'includes/classes/db_pdo.php';
require 'includes/html/header.php';

if (isset($_SESSION['keyuser'])) {
    $page = "shopping_shop.php";
    $account = '<a href="about_me.php"><i class="icon-v-card"></i></a>';
} else {
    $page = "index.php";
    $account = '<a href="login.php"><i class="icon-user"></i></a>';
}
?>

<body>

    <!--<div class="loader-pages"></div>-->

    <div id="page">
        <!-- Menu de navigation -->
        <nav class="menuN-nav" role="navigation">
            <div class="container">
                <div class="styleNeC-top-logo">
                    <div id="styleNeC-logo">
                        <a href="<?php echo $page ?>">P.M.U | Boutique</a>
                        <br>
                        <div id="styleNeC-logo-label">
                            <a href="<?php echo $page; ?>">Pièce Mécano à l'Unité</a></div>
                    </div>
                </div>
                <div class="styleNeC-top-menu menu-1 text-center">
                    <ul>
                        <li><a href="<?php echo $page; ?>">Magasin</a></li>
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
                        <li><?php echo $account; ?></li>
                        <li><a href="panier.php?view"><i class="icon-shopping-cart"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--End Menu de navigation -->

        <div id="styleNeC-work">
            <div class="container">
                <div class="row top-line animate-box">
                    <div class="col-md-7 col-md-push-5 text-left intro">
                        <h2 class="title-h2">Shéma de construction FREE <i class="icon-file"></i></h2>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $db_pdo = new db_pdo(); // class database
                    $selectP = $db_pdo->queryExtraction("SELECT a.label, p.path_picture, ad.path_assembly FROM articles AS a, picture AS p, assembly_diagram AS ad WHERE a.idpicture = p.idpicture AND a.refarticles = ad.refarticles_assembly;"); // database function queryExtraction select
                    $selectP = $selectP->fetchAll(); //fectchAll() Retourne un tableau contenant toutes les lignes du jeu d'enregistrements 
                    foreach ($selectP as $assembly) { // boucle foreach affiche contenue des lignes
                        echo '                     <div class="col-md-4 text-center animate-box">' . "\n";
                        echo '                        <a class="work" href="' . $assembly[2] . '" >' . "\n";
                        echo '                            <div class="work-grid" style="background-image:url(' . $assembly[1] . ');">' . "\n";
                        echo '                                <div class="inner">' . "\n";
                        echo '                                    <div class="desc">' . "\n";
                        echo '                                       <h3>' . $assembly[0] . '</h3>' . "\n";
                        echo '                                        <span class="cat"> Gratuit </span>' . "\n";
                        echo '                                    </div></div></div></a></div>' . "\n";
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

</body>

</html>
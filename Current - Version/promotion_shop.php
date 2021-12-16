<?php
session_start();

include 'includes/classes/db_pdo.php';
include 'includes/classes/clients.php';
include 'includes/classes/articles.php';

$db_pdo = new db_pdo(); // class database

if (isset($_SESSION['keyuser'])) {
    $page = "shopping_shop.php";
    $account = '<a href="about_me.php"><i class="icon-v-card"></i></a>';
} else {
    $page = "index.php";
    $account = '<a href="login.php"><i class="icon-user"></i></a>';
}


$selectS = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.sell_price, p.path_picture FROM articles AS a, picture AS p WHERE a.idpicture = p.idpicture AND current_stock < 100 AND a.refarticles NOT IN (SELECT refarticles_assembly FROM assembly_diagram);"); // database function queryExtraction select
$selectS = $selectS->fetchAll();
$i = 0;
foreach ($selectS as $product) {
    $article = new articles($product[0], $product[1], "null", "null", "null", $product[2]/2, "null", $product[3]);
    $arrayArticle[$i] = $article;
    $i++;
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
                        <a href="<?php echo $page ?>">P.M.U | Boutique</a>
                        <br>
                        <div id="styleNeC-logo-label">
                            <a href="<?php echo $page; ?>">Pièce Mécano à l'Unité</a></div>
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
                </div>
                <div class="row">
                    <?php
                    for ($i = 0; $i < count($arrayArticle); $i++) {
                        echo '                     <div class="col-md-4 text-center animate-box">' . "\n";
                        echo '                        <a class="work" href="#" onClick="ViewItems(\'' . $arrayArticle[$i]->getRefarticles() . '\', \'' . number_format($arrayArticle[$i]->getSellprice(), 2, '.', ',') . '\')">' . "\n";
                        echo '                            <div class="work-grid" style="background-image:url(' . $arrayArticle[$i]->getIdpicture() . ');">' . "\n";
                        echo '                                <div class="inner">' . "\n";
                        echo '                                    <div class="desc">' . "\n";
                        echo '                                       <h3>' . $arrayArticle[$i]->getLable() . '</h3>' . "\n";
                        echo '                                        <span class="cat stylePr" style="font-size: small; color: yellow;">' .  number_format($arrayArticle[$i]->getSellprice(), 2, '.', ','). '€ </span>' . "\n";
                        echo '                                    </div></div></div></a></div>' . "\n";
                    }
                    ?>
                    <!--End Items list-->
                </div>

                <div id="styleNeC-started" class="stylePr">
                    <div class="container">
                        <div class="row animate-box">
                            <div class="col-md-8 col-md-offset-2 text-center stylePr styleNeC-heading">
                                <h2>Les PROMOTIONS</h2>
                                <p style="color: #FFF;">
                                    <?php
                                    $today = time(); // Enregistre la date et l'heure du jour
                                    $event = mktime(0, 0, 0, 12, 25, 2020); //ENREGISTREMENT Date et heure de l'événement
                                    $countdown = round(($event - $today) / 86400); //CALCULE LES JOURS JUSQU'À L'ÉVÉNEMENT.
                                    echo $countdown .' Jours avant la fin des promotions';

                                    ?></p>
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
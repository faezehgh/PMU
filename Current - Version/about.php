<?php 
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
    <div class="loader-pages"></div>

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
                        <li><a href="index.php">Magasin</a></li>
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
        <div id="styleNeC-author">
            <div class="container">
                <div class="row top-line animate-box">
                    <div class="col-md-6 col-md-offset-3 col-md-push-2 text-left styleNeC-heading">
                        <h2 class="title-h2">À propos de nous</h2>
                        <p>P.M.U, société par actions simplifiée est en activité depuis 1 ans. Située à VALENCIENNES (59300), elle est spécialisée dans le secteur d'activité de la vente de pièces Meccano. Son effectif est de 3 salariés. </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="author">
                            <div class="author-inner animate-box" style="background-image: url(assets/pictures/pic-lot01.jpg);">
                            </div>
                            <div class="desc animate-box">
                                <span>Web e-commerce &amp; marketing</span>
                                <h3>P.M.U</h3>
                                <p>Pour définir le terme e-commerce, nous pouvons dire qu'il représente les différentes transactions commerciales qui se font à distance sur internet. Il est également connu sous le nom de commerce électronique. L'action d'acheter sur internet se fait au travers d’objets numériques et digitales.</p>
                                <p>L’achat peut se réaliser au travers de différents canaux et supports : ordinateurs, smartphones, tablettes, consoles, TV. Le e-commerce tend de plus en plus vers le m-commerce.</p>
                                <p> l’évolution du e-commerce, la vente par correspondance est dorénavant devenue la vente à distance.</p>
                                <ul class="styleNeC-social-icons">
                                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                                    <li><a href="#"><i class="icon-dribbble"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="title animate-box">Nos compétences</h3>
                                <div class="row">
                                    <div class="col-md-6 animate-box skills">
                                        <h3>Vente du mois</h3>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                                100%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 animate-box skills">
                                        <h3>Clients satisfait</h3>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width:95%">
                                                95%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 animate-box skills">
                                        <h3>Colis expédié ce mois</h3>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                                80%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 animate-box skills">
                                        <h3>Notre stock</h3>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%">
                                                90%
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
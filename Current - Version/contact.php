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
        <div id="styleNeC-contact">
            <div class="container">
                <div class="row top-line animate-box">
                    <div class="col-md-6 col-md-offset-3 col-md-push-2 text-left styleNeC-heading">
                        <h2 class="title-h2">Pour vous joindre</h2>
                        <p>Nous donnons de l’importance et répondons à toutes les demandes de nos clients. Nous serons ravis de traiter la vôtre ! </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="col-md-5 col-md-pull-1 animate-box">
                            <div class="styleNeC-contact-info">
                                <h3>Contact</h3>
                                <ul>
                                    <li class="address">Voirie Communale Université, <br> Val Mont Houy, 59300 Famars</li>
                                    <li class="phone"><a href="tel://0327511234">03 27 51 12 34</a></li>
                                    <li class="email"><a href="mailto:dimitri.filleux@etu.uphf.fr">Dimitri Filleux @</a></li>
                                    <li class="email"><a href="mailto:valentin.guerin@etu.uphf.fr">Valentin Guerin @</a></li>
                                    <li class="email"><a href="mailto:faezeh.ghasemi@etu.uphf.fr">Faezeh Ghasemi @</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-7 animate-box">
                            <h3>Entrer en contact</h3>
                            <form action="includes/resources/contact_email.php" method="POST">
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="fname">Votre nom</label>
                                        <input type="text" id="fname" name="fname" class="form-control">
                                    </div>

                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control">
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" name="message" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit-c" value="Envoyer le message" class="btn btn-primary">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'includes/html/footer.php'; ?>
    </div>

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
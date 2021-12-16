<?php require 'includes/html/header.php'; ?>

</head>

<body>

    <div class="loader-pages"></div>

    <div id="page">
        <!-- Menu de navigation -->
        <nav class="menuN-nav" role="navigation">
            <div class="container">
                <div class="styleNeC-top-logo">
                    <div id="styleNeC-logo">
                        <a href="index.php">P.M.U | Boutique</a>
                        <br>
                        <div id="styleNeC-logo-label">
                            <a href="index.php">Pièce Mécano à l'Unité</a></div>
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
            </div>
        </nav>
        <!--End Menu de navigation -->
        <div id="styleNeC-contact">
            <div class="container">
                <div class="col-md-6 col-md-offset-3 col-md-push-2 text-left styleNeC-heading">
                    <h2>Créer un compte</h2>
                    <p>En créant un compte, vous acceptez les Conditions générales de vente. Et la politique de confidentialité de P.M.U Boutique.</p>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="col-md-7 animate-box">
                            <h3>Inscrivez-vous</h3>
                            <form name="Formulaire" action="includes/resources/accountcheck.php" method="POST">
                            <?php
                                    if (@$_GET['Empty'] == true) { // Message d'erreur si dans l'url il y a Empty == retour message erreur
                                        $erreur = $_GET['Empty'];
                                        echo '<div class="alert-light text-danger text-center">' . $erreur . '</div>'; // Message récupéré par $_GET
                                    } else if (@$_GET['Invalid'] == true) {
                                        $erreur = $_GET['Password'];
                                        echo '<div class="alert-light text-danger text-center">' . $erreur . '</div>'; // Message récupéré par $_GET
                                    }
                                    ?>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="fname">Nom</label>
                                        <input type="text" id="fname" name="fname" class="form-control" required autofocus>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="lname">Prénom</label>
                                        <input type="text" id="lname" name="lname" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" id="password" name="password-1" class="form-control" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="password">Confirmer mot de passe</label>
                                        <input type="password" id="password" name="password-2" class="form-control" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="email">Téléphone</label>
                                        <input type="tel" id="phone" name="phone" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="email">Adresse</label>
                                        <input type="text" id="address" name="address" class="form-control" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="email">Ville</label>
                                        <input type="text" id="city" name="city" class="form-control" required>
                                    </div>


                                    <div class="col-md-12">
                                        <label for="email">Code postal</label>
                                        <input type="text" id="codepostal" name="codepostal" class="form-control" required>
                                    </div>
                                </div>
                                <div clas="form-group">
                                    <button class="btn btn-lg btn-primary btn-block text-uppercase" name="signups" type="submit">Valider les informations</button>
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
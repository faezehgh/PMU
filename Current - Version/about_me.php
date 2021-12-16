<?php
session_start();

include 'includes/classes/db_pdo.php';
include 'includes/classes/clients.php';
include 'includes/resources/decryptage.php';
include 'includes/resources/cryptage_data.php';

if (isset($_SESSION['keyuser'])) {
    $keyuser = $_SESSION['keyuser'];
    $email = $_SESSION['email'];

    $db_pdo = new db_pdo();

    $selectUser = $db_pdo->queryExtraction("SELECT c.idclients, c.last_name, c.first_name, c.email, c.phone, c.city, c.postal_code, c.address, c.idpermission FROM clients AS c, identifiers AS i WHERE c.idclients = i.idpassword_client AND c.use_key = '$keyuser';");
    $selectUser = $selectUser->fetchAll();
    $clients = new clients($selectUser[0][0], DecodeData($selectUser[0][1]), DecodeData($selectUser[0][2]), DecodeData($email),  DecodeData($selectUser[0][4]), $selectUser[0][5], $selectUser[0][6], DecodeData($selectUser[0][7]), $selectUser[0][8], NULL);
}
?>
<?php require 'includes/html/header.php'; ?>

<body>

    <div class="loader-pages"></div>
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
                        <li><a href="panier.php?view"><i class="icon-shopping-cart"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--End Menu de navigation -->
        <div id="styleNeC-author">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="row" id="menu-button">
                            <div class="col-md-12">
                                <h3 class="title animate-box"><?php echo "Bienvenu : " . $clients->getLname() . "  " . $clients->getFname(); ?> | Vos services</h3>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="feature-center animate-box" data-animate-effect="fadeIn">
                                    <span class="icon">
                                        <i class="icon-brush"></i>
                                    </span>
                                    <h3>Mes commandes</h3>
                                    <p>Vous pouvez consulter à tout moment le suivi de vos commandes de votre compte.</p>
                                    <p><a onclick="HideShowOrders()" class="btn btn-primary btn-outline">Commande</a></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="feature-center animate-box" data-animate-effect="fadeIn">
                                    <span class="icon">
                                        <i class="icon-cog"></i>
                                    </span>
                                    <h3>Paramètres du comtpe</h3>
                                    <p>Informations personnelles. Mettez à jour les informations générales dans votre compte.</p>
                                    <p><a onclick="HideShowSetting()" class="btn btn-primary btn-outline">Paramètre</a></p>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="feature-center animate-box" data-animate-effect="fadeIn">
                                    <span class="icon">
                                        <i class="icon-briefcase"></i>
                                    </span>
                                    <h3>Mode de paiement</h3>
                                    <p>Si vous payez votre commande avec une carte de paiement, il vous sera demandé de saisir les détails de cette carte</p>
                                    <p><a onclick="HideShowPayment()" class="btn btn-primary btn-outline">Mode</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7 animate-box" id="setting-clients" style="display: none;">
                            <a href="about_me.php" class="btn btn-primary btn-outline">Retour</a>
                            <h3>Vos informations</h3>
                            <form name="Formulaire-Modification" action="" method="POST">
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
                                        <input type="text" id="fname" name="fname" class="form-control" value="<?php echo $clients->getLname(); ?>" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="lname">Prénom</label>
                                        <input type="text" id="lname" name="lname" class="form-control" value="<?php echo $clients->getFname(); ?>" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $clients->getEmail(); ?>" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" id="password" name="password-1" class="form-control" value="*******************" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="password">Confirmer mot de passe</label>
                                        <input type="password" id="password" name="password-2" class="form-control" value="*******************" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="email">Téléphone</label>
                                        <input type="tel" id="phone" name="phone" class="form-control" value="<?php echo $clients->getPhone(); ?>" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="email">Adresse</label>
                                        <input type="text" id="address" name="address" class="form-control" value="<?php echo $clients->getAddress(); ?>" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="email">Ville</label>
                                        <input type="text" id="city" name="city" class="form-control" value="<?php echo $clients->getCity(); ?>" required>
                                    </div>


                                    <div class="col-md-12">
                                        <label for="email">Code postal</label>
                                        <input type="text" id="codepostal" name="codepostal" class="form-control" value="<?php echo $clients->getPostalcode(); ?>" required>
                                    </div>
                                </div>
                                <div clas="form-group">
                                    <!--<button class="btn btn-lg btn-primary btn-block text-uppercase" name="update" type="submit" onclick="HideShowSetting()">Modifier les informations</button>-->
                                    <button class="btn btn-lg btn-primary-update btn-block text-uppercase" name="update" type="submit">Modifier les informations</button>
                                    <button class="btn btn-lg btn-primary-delete btn-block text-uppercase" name="delete" type="submit">Supprimer le compte</button>
                                </div>
                            </form>
                        </div>
                        <?php

                        // Modifier compte
                        if (isset($_POST['update'])) {

                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $address = $_POST['address'];
                            $city = $_POST['city'];
                            $cp = $_POST['codepostal'];
                            $email = $_POST['email'];
                            $phone = $_POST['phone'];
                            $password = $_POST['password-1'];

                            // Crytage des données 
                            $userArray = array($fname, $lname, $address, $phone);
                            $encodeData = EncodeMultiDatas($userArray);
                            $email = CryptageEmail($email);
                            $pass = CryptagePassword($password);

                            if (($_POST['password-1'] != "*******************")  && ($_POST['password-2'] != "*******************")) {
                                if ($_POST['password-1'] == $_POST['password-2']) {
                                    $db_pdo->queryInsertion("UPDATE clients SET last_name = '$encodeData[1]', first_name = '$encodeData[0]', email = '$email', phone='$encodeData[3]', city='$city', postal_code='$cp', address='$encodeData[2]' WHERE idclients = " . $clients->getID() . ";");
                                    $db_pdo->queryInsertion("UPDATE identifiers SET password = '$pass' WHERE idpassword_client = " . $clients->getID() . ";");
                                } else {
                                    echo "Erreur";
                                }
                            } else {
                                $db_pdo->queryInsertion("UPDATE clients SET last_name = '$encodeData[1]', first_name = '$encodeData[0]', email = '$email', phone = '$encodeData[3]', city ='$city', postal_code='$cp', address='$encodeData[2]' WHERE idclients = " . $clients->getID() . ";");
                            }
                        }

                        // Supprimer compte
                        if (isset($_POST['delete'])) {
                            echo "<script type='text/javascript'>alert('Vous êtes sur le point de supprimer votre compte. Souhaitez-vous le supprimer ?');</script>";
                            $db_pdo->queryInsertion("DELETE FROM identifiers WHERE idpassword_client = " . $clients->getID() . ";");
                            $db_pdo->queryInsertion("UPDATE clients SET last_name = 'delete', first_name = 'delete', email = '$email', phone= null, city= 'Aucune', postal_code = '00000', address = 'Aucune', idpermission = 0 WHERE idclients = " . $clients->getID() . ";");
                            header("includes/resources/disconnection_clients.php");
                        }
                        ?>

                        <div class="col-md-7 animate-box" id="orders-clients" style="display: none;">
                            <a href="about_me.php" class="btn btn-primary btn-outline">Retour</a>
                            <h3>Commandes</h3>

                            <?php
                            $i = 0;
                            $selectOrder = $db_pdo->queryExtraction("SELECT o.idorders, o.dates, h.refarticles, h.amount, a.label FROM clients AS c, orders AS o, invoice AS i, historic AS h, articles AS a WHERE c.idclients = o.idclients AND o.idorders = i.idorders AND i.idinvoice = h.idinvoice AND h.refarticles = a.refarticles AND c.idclients = " . $clients->getID() . ";");
                            $selectOrder = $selectOrder->fetchAll();
                            foreach ($selectOrder as $product) {
                                $content = '<table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">' . $product[0] . '</th>
                                        <th scope="col">----</th>
                                        <th scope="col">----</th>
                                        <th scope="col">' . $product[1] . '</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">' . $i . '</th>
                                        <td>' . $product[2] . '</td>
                                        <td>' . $product[4] . '</td>
                                        <td>' . $product[3] . '</td>
                                    </tr>
                                    </tbody>
                            </table>
                            <br>' . "\n";
                                echo $content;
                            }

                            if(count($selectOrder) == 0){
                                echo "<p>Aucune commande</p>";
                            }
                            ?>
                        </div>

                        <div class="col-md-7 animate-box" id="mode-clients" style="display: none;">
                            <a href="about_me.php" class="btn btn-primary btn-outline">Retour</a>
                            <h3>Mode de paiement</h3>

                            
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>
            function HideShowSetting() {
                var x = document.getElementById("setting-clients");
                var y = document.getElementById("menu-button");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.display = "none";
                } else {
                    x.style.display = "none";
                    y.style.display = "block";
                }
            }

            function HideShowOrders() {
                var x = document.getElementById("orders-clients");
                var y = document.getElementById("menu-button");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.display = "none";
                } else {
                    x.style.display = "none";
                    y.style.display = "block";
                }
            }

            function HideShowPayment() {
                var x = document.getElementById("mode-clients");
                var y = document.getElementById("menu-button");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.display = "none";
                } else {
                    x.style.display = "none";
                    y.style.display = "block";
                }
            }
        </script>

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
<?php
session_start();
require 'includes/html/header.php';
include 'includes/classes/db_pdo.php';
include 'includes/classes/panier.php';
include 'includes/classes/articles.php';

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
                        <li><a href="panier.php?test"><i class="icon-shopping-cart"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--End Menu de navigation -->
        <div id="styleNeC-author">
            <div class="container">
                <div class="row">
                    <?php
                    if (!isset($_SESSION['panier'])) {
                        echo '<h4 class="media-heading">Panier vide</h4>';
                    } else {
                    ?>
                    <!-- Table shopping -->
                        <div class="col-sm-12 col-md-10 col-md-offset-1">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Produits</th>
                                        <th>Quantité</th>
                                        <th class="text-center">Prix</th>
                                        <th class="text-center">Total</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $db_pdo = new db_pdo();
                                    for ($i = 0; $i < count($_SESSION['panier']['productId']); $i++) {
                                        $selectArticles = $db_pdo->queryExtraction("SELECT  a.label, a.description, a.current_stock, a.alerte_stock, a.sell_price, c.label, p.path_picture FROM articles AS a, category AS c, picture AS p WHERE a.refarticles LIKE '". $_SESSION['panier']['productId'][$i] ."' AND a.idcategory = c.idcategory AND a.idpicture = p.idpicture ;");
                                        $selectArticles = $selectArticles->fetchAll();
                                            $articles = new articles($_SESSION['panier']['productId'][$i], $selectArticles[0][0], $selectArticles[0][1], $selectArticles[0][2], $selectArticles[0][3], $selectArticles[0][4], $selectArticles[0][5], $selectArticles[0][6]);
                                            $arrayArticles[$i] = $articles;
                                    ?>
                                        <tr>
                                            <td class="col-sm-8 col-md-6">
                                                <div class="media">
                                                    <img class="media-object pull-left" src="<?php echo $arrayArticles[$i]->getIdpicture(); ?>" width="72">
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><?php echo $arrayArticles[$i]->getLable(); ?></h4>
                                                        <span>Status: </span><span class="text-success"><strong>En stock</strong></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="col-sm-1 col-md-1">
                                                <input type="number" id="quantity" name="quantity" min="1" max="800" value="<?php echo $_SESSION['panier']['quantity'][$i]; ?>">
                                            </td>
                                            <td class="col-sm-1 col-md-1 text-center"><strong><?php echo $_SESSION['panier']['price'][$i]; ?></strong></td>
                                            <td class="col-sm-1 col-md-1 text-center"><strong><?php echo priceQuantity($_SESSION['panier']['quantity'][$i], $_SESSION['panier']['price'][$i]); ?>€</strong></td>
                                            <td class="col-sm-1 col-md-1">
                                                <button type="button" class="btn btn-danger">
                                                    <span class="icon-trash"></span>
                                                </button></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>
                                            <h5>HT : </h5>
                                        </td>
                                        <td class="text-right">
                                            <h5><strong><?php echo MontantGlobal($arrayArticles); ?>€</strong></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>
                                            <h5>TVA : </h5>
                                        </td>
                                        <td class="text-right">
                                            <h5><strong>20%</strong></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>
                                            <h4>TTC : </h4>
                                        </td>
                                        <td class="text-right">
                                            <h4><strong><?php echo MontantGlobalTVA($arrayArticles, 20); ?>€</strong></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>
                                            <a type="button" class="btn btn-default" href="<?php echo $page ?>"><span class="glyphicon glyphicon-shopping-cart"></span>Continuer vos achats</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success">Valider le panier <span class="glyphicon glyphicon-play"></span></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                    <!-- End Table shopping -->
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
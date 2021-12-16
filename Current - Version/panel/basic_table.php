<?php
ob_start();
session_start();
include '../includes/classes/db_pdo.php';
include '../includes/resources/decryptage.php';
include '../includes/classes/clients.php';
include '../includes/classes/articles.php';
include '../includes/classes/invoice.php';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    header("location:../includes/resources/disconnection_clients.php");
}

$db_pdo = new db_pdo();

$selectClients = $db_pdo->queryExtraction("SELECT idclients, last_name, first_name, email, phone, city, postal_code, address, idpermission, check_account FROM clients ;");
$selectClients = $selectClients->fetchAll();
$i = 0;
foreach ($selectClients as $data) {
    $clients = new clients($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9]);
    $arrayClients[$i] = $clients;
    $i++;
}

$selectPermission = $db_pdo->queryExtraction("SELECT * FROM permissions ;");
$selectPermission = $selectPermission->fetchAll();
$i = 0;
$arrayPermission = array();
foreach ($selectPermission as $data) {
    $arrayPermission[$i] = $data;
    $i++;
}

$selectArticles = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.description, a.current_stock, a.alerte_stock, a.sell_price, c.label, p.path_picture FROM articles AS a, category AS c, picture AS p WHERE a.idcategory = c.idcategory AND a.idpicture = p.idpicture ;");
$selectArticles = $selectArticles->fetchAll();
$i = 0;
foreach ($selectArticles as $data) {
    $articles = new articles($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]);
    $arrayArticles[$i] = $articles;
    $i++;
}

$selectCategory = $db_pdo->queryExtraction("SELECT * FROM category ;");
$selectCategory = $selectCategory->fetchAll();
$i = 0;
$arrayCategory = array();
foreach ($selectCategory as $data) {
    $arrayCategory[$i] = $data;
    $i++;
}

$selectImages = $db_pdo->queryExtraction("SELECT * FROM picture ;");
$selectImages = $selectImages->fetchAll();
$i = 0;
$arrayImages = array();
foreach ($selectImages as $data) {
    $arrayImages[$i] = $data;
    $i++;
}

$selectOrders = $db_pdo->queryExtraction("SELECT o.idorders, c.last_name, c.first_name, o.dates, o.statue_orders FROM orders AS o, clients AS c WHERE o.idclients = c.idclients;");
$selectOrders = $selectOrders->fetchAll();
$i = 0;
$arrayOrders = array();
foreach ($selectOrders as $data) {
    $arrayOrders[$i] = $data;
    $i++;
}

$selectInvoice = $db_pdo->queryExtraction("SELECT i.idinvoice, i.idorders, i.tva FROM invoice AS i, orders AS o WHERE i.idorders = o.idorders;");
$selectInvoice = $selectInvoice->fetchAll();
$i = 0;
foreach ($selectInvoice as $data) {
    $invoice = new invoice($data[0], $data[1], $data[2]);
    $arrayInvoice[$i] = $invoice;
    $i++;
}

$selectHistoric = $db_pdo->queryExtraction("SELECT h.refarticles, h.idinvoice, h.amount, h.unit_price FROM historic AS h, articles AS a, invoice AS i WHERE h.refarticles = a.refarticles AND h.idinvoice = i.idinvoice;");
$selectHistoric = $selectHistoric->fetchAll();
$i = 0;
$arrayhistoric = array();
foreach ($selectHistoric as $data) {
    $arrayhistoric[$i] = $data;
    $i++;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Admin - PMU</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <link rel="icon" href="favicon.ico" sizes="128x128">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">

    <!-- Custom styles css -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <script src="assets/js/chart-master/Chart.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <section id="container">
        <!--header start-->
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="dashboard_pmu.php" class="logo"><b>TABLEAU DE BORD</b></a>
            <!--logo end-->
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="../includes/resources/disconnection_clients.php">Déconnexion</a></li>
                </ul>
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">

                    <p class="centered">
                        <a href="dashboard_pmu.php"><img src="assets/img/admin.png" class="img-circle" width="60"></a>
                    </p>
                    <h5 class="centered"><?php echo DecodeData($email); ?></h5>

                    <li class="mt">
                        <a href="dashboard_pmu.php">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-cogs"></i>
                            <span>Composantes</span>
                        </a>
                        <ul class="sub">
                            <li><a href="gallery.php">Galerie</a></li>
                            <li><a href="article.php">Gestion Produit</a></li>
                            <li><a href="client.php">Gestion Client</a></li>
                            <li><a href="assembly_diagram.php">Gestion Schéma de montage</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-th"></i>
                            <span>Tableaux de donnée</span>
                        </a>
                        <ul class="sub">
                            <li><a class="active" href="basic_table.php">Tables</a></li>
                            <!--<li><a href="responsive_table.php">Table réactive</a></li>-->
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class=" fa fa-bar-chart-o"></i>
                            <span>Graphiques</span>
                        </a>
                        <ul class="sub">
                            <li><a href="chartjs.php">Chartjs</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Tables</h3>
                <div class="row">

                    <!-- Client -->
                    <div class="col-md-12 mt">
                        <div class="content-panel">
                            <table class="table table-hover">
                                <h4><i class="fa fa-angle-right"></i> Table Produits</h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom de famille</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Ville</th>
                                        <th>adresse</th>
                                        <th>Compte vérifier</th>
                                        <th>permission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($arrayClients); $i++) {
                                        echo "<tr> \n";
                                        echo " <td>" . $arrayClients[$i]->getID() . "</td> \n";
                                        echo " <td>" . DecodeData($arrayClients[$i]->getLname()) . "</td> \n";
                                        echo " <td>" . DecodeData($arrayClients[$i]->getFname()) . "</td> \n";
                                        echo " <td>" . $arrayClients[$i]->getEmail() . "</td> \n";
                                        echo " <td>" . DecodeData($arrayClients[$i]->getPhone()) . "</td> \n";
                                        echo " <td>" . $arrayClients[$i]->getCity() . "</td> \n";
                                        echo " <td>" . DecodeData($arrayClients[$i]->getAddress()) . "</td> \n";
                                        echo " <td>" . $arrayClients[$i]->getCheckAccount() . "</td> \n";
                                        echo " <td>" . $arrayClients[$i]->getIDPermission() . "</td> \n";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Client -->
                    <!-- Permission -->
                    <div class="col-md-12 mt">
                        <div class="content-panel">
                            <table class="table table-hover">
                                <h4><i class="fa fa-angle-right"></i> Table Permission</h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Permission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($arrayPermission); $i++) {
                                        echo "<tr> \n";
                                        echo " <td>" . $arrayPermission[$i][0] . "</td> \n";
                                        echo " <td>" . $arrayPermission[$i][1] . "</td> \n";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Permission -->
                    <!-- Produits -->
                    <div class="col-md-12 mt">
                        <div class="content-panel">
                            <table class="table table-hover">
                                <h4><i class="fa fa-angle-right"></i> Table Produits</h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th>Référence</th>
                                        <th>Label</th>
                                        <th>Description</th>
                                        <th>Stock</th>
                                        <th>Stock minimal</th>
                                        <th>Prix</th>
                                        <th>Categorie</th>
                                        <th>Nom de l'image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($arrayArticles); $i++) {
                                        echo "<tr> \n";
                                        echo " <td>" . $arrayArticles[$i]->getRefarticles() . "</td> \n";
                                        echo " <td>" . $arrayArticles[$i]->getLable() . "</td> \n";
                                        echo " <td>" . $arrayArticles[$i]->getDescription() . "</td> \n";
                                        echo " <td>" . $arrayArticles[$i]->getCurrentstock() . "</td> \n";
                                        echo " <td>" . $arrayArticles[$i]->getAlertestock() . "</td> \n";
                                        echo " <td>" . $arrayArticles[$i]->getSellprice() . "€</td> \n";
                                        echo " <td>" . $arrayArticles[$i]->getIdcategory() . "</td> \n";
                                        echo " <td>" . $arrayArticles[$i]->getIdpicture() . "</td> \n";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Produits -->
                    <!-- Catégorie -->
                    <div class="col-md-12 mt">
                        <div class="content-panel">
                            <table class="table table-hover">
                                <h4><i class="fa fa-angle-right"></i> Table Catégorie</h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Catégorie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($arrayCategory); $i++) {
                                        echo "<tr> \n";
                                        echo " <td>" . $arrayCategory[$i][0] . "</td> \n";
                                        echo " <td>" . $arrayCategory[$i][1] . "</td> \n";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--END  Catégorie -->
                    <!-- images -->
                    <div class="col-md-12 mt">
                        <div class="content-panel">
                            <table class="table table-hover">
                                <h4><i class="fa fa-angle-right"></i> Table images</h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>chemin images</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($arrayImages); $i++) {
                                        echo "<tr> \n";
                                        echo " <td>" . $arrayImages[$i][0] . "</td> \n";
                                        echo " <td>" . $arrayImages[$i][1] . "</td> \n";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END images -->
                    <!-- Commandes -->
                    <div class="col-md-12 mt">
                        <div class="content-panel">
                            <table class="table table-hover">
                                <h4><i class="fa fa-angle-right"></i> Table Commandes</h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th>Commande</th>
                                        <th>Client</th>
                                        <th>date</th>
                                        <th>Statue commande</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($arrayOrders); $i++) {
                                        echo "<tr> \n";
                                        echo " <td>" . $arrayOrders[$i][0] . "</td> \n";
                                        echo " <td>" . DecodeData($arrayOrders[$i][1]) . ' ' . DecodeData($arrayOrders[$i][2]) . "</td> \n";
                                        echo " <td>" . $arrayOrders[$i][3] . "</td> \n";
                                        echo '<td><span class="label label-info label-mini">' . $arrayOrders[$i][4] . "</span></td> \n";
                                        echo ' <td>' . "\n" . '<select class="browser-default custom-select" id="statuecommande" name="statuecommande"> <option value="en cours">en cours</option> <option value="livrée">livrée</option> <option value="terminée">terminée</option> <option value="annulée">annulée</option> </select>' . "\n" . '<a class="btn btn-success btn-xs" onclick="ReturnValueOrderUpdate(\'' . $arrayOrders[$i][0] . '\')"><i class="fa fa-check"></i></a>' . "\n" . '<a class="btn btn-danger btn-xs" href="basic_table.php?del=' . $arrayOrders[$i][0] . '"><i class="fa fa-trash-o "></i></a>' . "\n" . '</td>';
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <script>
                            function ReturnValueOrderUpdate(id) {
                                var statue = document.getElementById("statuecommande");
                                var statue = statue.value;
                                var idOrder = id;
                                var data = idOrder + "|" + statue;
                                window.location.href = "basic_table.php?updateOrder=" + data;
                            }
                        </script>

                        <?php
                        if (isset($_GET['updateOrder']) && !empty($_GET['updateOrder'])) {
                            $data = explode('|', $_GET['updateOrder']);
                            $db_pdo->queryInsertion("UPDATE orders SET statue_orders='" . $data[1] . "' WHERE idorders = '" . $data[0] . "';");
                            ob_end_clean();
                            header("location:../../panel/basic_table.php");
                        }
                        ?>
                        <?php
                        if (isset($_GET['del']) && !empty($_GET['del'])) {
                            $data = $_GET['del'];
                            $selectIdInvoice = $db_pdo->queryExtraction("SELECT idinvoice FROM invoice WHERE idorders='" . $data . "';");
                            $selectIdInvoice = $selectIdInvoice->fetchAll();

                            $db_pdo->queryInsertion("DELETE FROM historic WHERE idinvoice='" . $selectIdInvoice[0][0] . "'");
                            $db_pdo->queryInsertion("DELETE FROM invoice WHERE idorders='" . $data . "';");
                            $db_pdo->queryInsertion("DELETE FROM orders WHERE idorders='" . $data . "';");

                            ob_end_clean();
                            header("location:../../panel/basic_table.php");
                        }
                        ?>
                    </div>
                    <!--END Commandes -->
                    <!-- images -->
                    <div class="col-md-12 mt">
                        <div class="content-panel">
                            <table class="table table-hover">
                                <h4><i class="fa fa-angle-right"></i> Table Factures</h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th>Factures</th>
                                        <th>ID Commande</th>
                                        <th>TVA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($arrayInvoice) != 1) {
                                        for ($i = 0; $i < count($arrayInvoice); $i++) {
                                            echo "<tr> \n";
                                            echo " <td>" . $arrayInvoice[$i]->getId_invoice() . "</td> \n";
                                            echo " <td>" . $arrayInvoice[$i]->getId_order() . "</td> \n";
                                            echo " <td>" . $arrayInvoice[$i]->getTva() . "%</td> \n";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END images -->
                    <!-- images -->
                    <div class="col-md-12 mt">
                        <div class="content-panel">
                            <table class="table table-hover">
                                <h4><i class="fa fa-angle-right"></i> Table Historiques</h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th>Ref Article</th>
                                        <th>ID Factures</th>
                                        <th>Quantité</th>
                                        <th>Prix unitaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($arrayhistoric); $i++) {
                                        echo "<tr> \n";
                                        echo " <td>" . $arrayhistoric[$i][0] . "</td> \n";
                                        echo " <td>" . $arrayhistoric[$i][1] . "</td> \n";
                                        echo " <td>" . $arrayhistoric[$i][2] . "</td> \n";
                                        echo " <td>" . $arrayhistoric[$i][3] . "€</td> \n";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END images -->
                </div>
                <!-- row -->
            </section>
            <! --/wrapper -->
        </section>
        <!-- /MAIN CONTENT -->

        <!--main content end-->
        <!--footer start-->
        <footer class="site-footer">
            <div class="text-center">
            </div>
        </footer>
        <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->

    <script>
        //custom select box

        $(function() {
            $('select.styled').customSelect();
        });
    </script>

</body>

</html>
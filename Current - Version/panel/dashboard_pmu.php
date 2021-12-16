<?php
session_start();
include '../includes/classes/db_pdo.php';
include '../includes/resources/decryptage.php';

if (isset($_SESSION['keyuser'])) {
    $keyuser = $_SESSION['keyuser'];
    $email = $_SESSION['email'];
} else {
    header("location:../includes/resources/disconnection_clients.php");
}

$db_pdo = new db_pdo();
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
                        <a class="active" href="dashboard_pmu.php">
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
                            <span>Tableaux de données</span>
                        </a>
                        <ul class="sub">
                            <li><a href="basic_table.php">Table de base</a></li>
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

                <div class="row">
                    <div class="col-lg-9 main-chart">

                        <div class="row mtbox">
                            <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                                <div class="box1">
                                    <span class="li_user"></span>
                                    <?php
                                    $countClient = $db_pdo->queryExtraction("SELECT COUNT(check_account) FROM clients;");
                                    $countClient = $countClient->fetchAll();
                                    echo '<h3>' . $countClient[0][0] . '</h3>';
                                    ?>
                                </div>
                                <p>Utilisateur enregistré</p>
                            </div>
                            <div class="col-md-2 col-sm-2 box0">
                                <div class="box1">
                                    <span class="li_tag"></span>
                                    <?php
                                    $countArticles = $db_pdo->queryExtraction("SELECT COUNT(refarticles) FROM articles;");
                                    $countArticles = $countArticles->fetchAll();
                                    echo '<h3>' . $countArticles[0][0] . '</h3>';
                                    ?>
                                </div>
                                <p>Produit dans la base de données</p>
                            </div>
                            <div class="col-md-2 col-sm-2 box0">
                                <div class="box1">
                                    <span class="li_news"></span>
                                    <?php
                                    $countInvoices = $db_pdo->queryExtraction("SELECT COUNT(idinvoice) FROM invoice;");
                                    $countInvoices = $countInvoices->fetchAll();
                                    echo '<h3>' . $countInvoices[0][0] . '</h3>';
                                    ?>
                                </div>
                                <p>Factures</p>
                            </div>
                            <div class="col-md-2 col-sm-2 box0">
                                <div class="box1">
                                    <span class="li_data"></span>
                                    <h3>Connecter</h3>
                                </div>
                                <?php
                                $version = $db_pdo->Version();
                                (float)$version = mb_substr($version, 0, 6);
                                ?>
                                <p> <?php echo "Version MySql : " . $version; ?></p>
                            </div>

                        </div>
                        <!-- /row mt -->
                        <div class="row mt">
                            <!-- SERVER STATUS PANELS -->
                            <div class="col-md-4 col-sm-4 mb">
                                <div class="white-panel pn donut-chart">
                                    <div class="white-header">
                                        <h5>SERVEUR</h5>
                                        <?php
                                    $test = $db_pdo->queryExtraction('SELECT table_schema , sum( data_length + index_length ) / 1024 / 1024 "Taille en Mo", sum( data_free )/ 1024 / 1024 "Espace libre en Mo" FROM information_schema.TABLES WHERE table_schema LIKE "ecommerce_data" GROUP BY table_schema');
                                    $test = $test->fetchAll();
                                    ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6 goleft">
                                            <p><i class="fa fa-database"></i><?php  echo $test[0][1] * 100; ?>%</p>
                                        </div>
                                    </div>
                                    <canvas id="serverstatus01" height="120" width="120"></canvas>
                                    <script>
                                        var doughnutData = [{
                                            value: <?php  echo $test[0][1] * 100; ?>,
                                            color: "#9e0255"
                                        }, {
                                            value: 100,
                                            color: "#fdfdfd"
                                        }];
                                        var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
                                    </script>
                                </div>
                                <! --/grey-panel -->
                            </div>
                            <!-- /col-md-4-->
                            <div class="col-md-4 col-sm-4 mb">
                                <div class="white-panel pn">
                                    <div class="white-header">
                                        <h5>TOP PRODUIT</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6 goleft">
                                            <p><i class="fa fa-heart"></i> 122</p>
                                        </div>
                                        <div class="col-sm-6 col-xs-6"></div>
                                    </div>
                                    <div class="centered">
                                        <?php
                                        $selectPicture = $db_pdo->queryExtraction("SELECT path_picture FROM picture; ");
                                        $selectPicture = $selectPicture->fetchAll();
                                        echo '<img src="../' . $selectPicture[0][0] . '" width="120">';
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /col-md-4 -->
                        </div>
                        <!-- /row -->
                        <div class="row">
                            <!-- TWITTER PANEL -->
                            <div class="col-md-4 mb">
                                <div class="darkblue-panel pn">
                                    <div class="darkblue-header">
                                        <h5>Serveur</h5>
                                    </div>
                                    <canvas id="serverstatus02" height="120" width="120"></canvas>
                                    <script>
                                        var doughnutData = [{
                                            value: <?php echo disk_free_space("/"); ?>,
                                            color: "#98ddb5"
                                        }, {
                                            value:<?php echo disk_total_space ("/"); ?>,
                                            color: "#444c57"
                                        }];
                                        var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
                                    </script>
                                    <p><?php echo "date : " . date("m/d/y"); ?></p>
                                    <footer>
                                        <div class="pull-left">
                                            <h5><i class="fa fa-hdd-o"></i><?php echo " Octets libre : " .  disk_free_space("/"); ?></h5>
                                        </div>
                                        <div class="pull-right">
                                            <h5>Disque</h5>
                                        </div>
                                    </footer>
                                </div>
                                <! -- /darkblue panel -->
                            </div>
                            <!-- /col-md-4 -->
                            <div class="col-md-4 col-sm-4 mb">
                                <!-- REVENUE PANEL -->
                                <div class="darkblue-panel pn">
                                    <div class="darkblue-header">
                                        <h5>REVENU</h5>
                                    </div>
                                    <div class="chart mt">
                                        <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
                                    </div>
                                    <p class="mt"><b>17,980 €</b><br />Revenu mensuel</p>
                                </div>
                            </div>
                            <!-- /col-md-4 -->

                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /col-lg-9 END SECTION MIDDLE -->
                </div>
                <! --/row -->
            </section>
        </section>

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
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>
    <script src="assets/js/zabuto_calendar.js"></script>

    <script type="application/javascript">
        $(document).ready(function() {
            $("#date-popover").popover({
                html: true,
                trigger: "manual"
            });
            $("#date-popover").hide();
            $("#date-popover").click(function(e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function() {
                    return myDateFunction(this.id, false);
                },
                action_nav: function() {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [{
                    type: "text",
                    label: "Special event",
                    badge: "00"
                }, {
                    type: "block",
                    label: "Regular event",
                }]
            });
        });

        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
</body>

</html>
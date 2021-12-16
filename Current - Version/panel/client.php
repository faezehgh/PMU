<?php
ob_start();
session_start();
include '../includes/classes/db_pdo.php';
include '../includes/resources/decryptage.php';
include '../includes/resources/cryptage_data.php';

if (isset($_SESSION['email'])) {
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
                            <li><a href="article.php">Gestion produit</a></li>
                            <li><a class="active" href="client.php">Gestion Client</a></li>
                            <li><a href="assembly_diagram.php">Gestion Schéma de montage</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-th"></i>
                            <span>Tableaux de donnée</span>
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
                <h3><i class="fa fa-angle-right"></i> Gestion Clients</h3>

                <!-- COMPLEX TO DO LIST -->
                <div class="row mt">
                    <div class="col-md-12">
                        <section class="task-panel tasks-widget">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h5><i class="fa fa-tasks"></i> Ajouter d'un client</h5>
                                </div>
                                <br>
                            </div>
                            <div class="panel-body">
                                <div class="task-content">
                                    <form action="../includes/resources/management_client.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nom">Nom</label>
                                            <input type="text" class="form-control" id="lname" name="lname" require autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label for="prenom">Prénom</label>
                                            <input type="text" class="form-control" id="fname" name="fname" require>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" require>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Téléphone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" require>
                                        </div>
                                        <div class="form-group">
                                            <label for="city">Ville</label>
                                            <input type="text" class="form-control" id="city" name="city" require>
                                        </div>
                                        <div class="form-group">
                                            <label for="cp">Code postal</label>
                                            <input type="text" class="form-control" id="cp" name="cp" require>
                                        </div>
                                        <div class="form-group">
                                            <label for="adresse">Adresse</label>
                                            <input type="text" class="form-control" id="adresse" name="adresse" require>
                                        </div>
                                        <div class="form-group">
                                            <label for="permission">Permission</label>
                                            <input type="number" class="form-control" id="permission" name="permission" require>
                                        </div>
                                        <div class="form-group">
                                            <label for="check">Check compte</label>
                                            <input type="number" class="form-control" id="check" name="check" require>
                                        </div>
                                        <div class="form-group">
                                            <label for="pass">Mot de passe</label>
                                            <input type="text" class="form-control" id="pass" name="pass" require>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-sm" id="submit-client" name="submit-client">Valider l'ajout du Client</button>
                                        </div>
                                    </form>
                                </div>
                        </section>
                    </div>
                    <!-- /col-md-12-->
                </div>

                <div class="row mt mb">
                    <div class="col-md-12">
                        <section class="task-panel tasks-widget">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h5><i class="fa fa-tasks"></i> Modifiaction et Suppression Client</h5>
                                </div>
                                <br>
                            </div>
                            <div class="panel-body">
                                <div class="task-content">
                                    <ul id="sortable" class="task-list">
                                        <?php
                                        $selectClient = $db_pdo->queryExtraction("SELECT idclients, last_name, first_name, email, phone, city, postal_code, address, idpermission, check_account, use_key FROM clients;");
                                        $selectClient = $selectClient->fetchAll();
                                        foreach ($selectClient as $client) {
                                        ?>
                                            <li class="list-primary">
                                                <i class=" fa fa-ellipsis-v"></i>
                                                <div class="task-title">
                                                    <span class="task-title-sp"><?php echo $client[0] . ' - ' . DecodeData($client[1]) . ' ' . DecodeData($client[2]) . ' ' . $client[3] ?></span>
                                                    <?php
                                                    if ($client[8] != 0) {
                                                        echo '<span class="badge bg-info"> Permission : ' . $client[8] . ' Check : ' . $client[9] . '</span>' . "\n";
                                                    } else {
                                                        echo '<span class="badge bg-warning"> Permission : ' . $client[8] . ' Check : ' . $client[9] . '</span>' . "\n";
                                                    }
                                                    ?>
                                                    <div class="pull-right hidden-phone">
                                                        <button class="btn btn-primary btn-xs fa fa-pencil" onclick="updateitems('<?php echo $client[0] ?>')"></button>
                                                        <a class="btn btn-danger btn-xs fa fa-trash-o" href="client.php?del=<?php echo $client[0] ?>"></a>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </section>
                        <?php
                        if (isset($_GET['del']) && !empty($_GET['del'])) {
                            $id = $_GET['del'];
                            echo "<script type='text/javascript'>alert('Vous êtes sur le point de supprimer un client. Souhaitez-vous le supprimer ?');</script>";
                            $data = EncodeMultiDatas(array("delete", "Aucune"));
                            $db_pdo->queryInsertion("DELETE FROM identifiers WHERE idpassword_client = " . $id . ";");
                            $db_pdo->queryInsertion("UPDATE clients SET last_name = '" . $data[0] . "', first_name = '" . $data[0] . "', phone= null, city= 'Aucune', postal_code = '00000', address = '" . $data[1] . "', idpermission = 0 WHERE idclients = " . $id . ";");
                            ob_end_clean();
                            header("location:../../panel/client.php");
                        }
                        ?>
                    </div>
                    <!--/col-md-12 -->
                </div>
                <!-- /row -->
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
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="assets/js/tasks.js" type="text/javascript"></script>

    <script>
        jQuery(document).ready(function() {
            TaskList.initTaskWidget();
        });

        $(function() {
            $("#sortable").sortable();
            $("#sortable").disableSelection();
        });

        function updateitems(id) {
            var data = {
                "id": id
            };
            jQuery.ajax({
                url: '../includes/html/clientsUpdates.php',
                method: "post",
                data: data,
                success: function(data) {
                    jQuery('body').append(data);
                    jQuery('#client-update').modal('toggle');
                },
                error: function() {
                    alert("error");
                }
            });
        }
    </script>
</body>

</html>
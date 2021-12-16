<?php
ob_start();
session_start();
include '../includes/classes/db_pdo.php';
include '../includes/resources/decryptage.php';
include '../includes/classes/articles.php';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    header("location:../includes/resources/disconnection_clients.php");
}

$db_pdo = new db_pdo();
$selectArticle = $db_pdo->queryExtraction("SELECT refarticles, label, current_stock FROM articles WHERE refarticles IN (SELECT refarticles_assembly FROM assembly_diagram);");
$selectArticle = $selectArticle->fetchAll();
$i = 0;
foreach ($selectArticle as $article) {
    $articles = new articles($article[0], $article[1], "Aucune", $article[2], 0, 0, 18, 0);
    $arrayArticles[$i] = $articles;
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
                            <li><a class="active" href="article.php">Gestion produit</a></li>
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
                <h3><i class="fa fa-angle-right"></i> Gestion Shéma de construction</h3>
                <div class="row mt">
                    <div class="col-md-12">
                        <div class="white-panel pn">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h5><i class="fa fa-tasks"></i> liste de notifications</h5>
                                </div>
                                <br>
                            </div>
                            <div class="custom-check goleft mt">
                                <table id="todo" class="table table-hover custom-check">
                                    <tbody>
                                        <?php
                                        if (@$_GET['Valide'] == true) { // Message d'erreur et succes
                                            $add = $_GET['Valide'];
                                            echo "<tr>
                                        <td> \n";
                                            echo '<span class="check"><input type="checkbox" class="checked"></span>' . "\n";
                                            echo '<a href="#" class="text-success"> Article ' . $add . ' Ajouter </a></span>' . "\n";
                                            echo '<button class="close" aria-hidden="true" data-dismiss="alert" type="button" onClick="window.location.replace(\'../../panel/assembly_diagram.php\');">×</button>' . "\n";
                                            echo "</td>
                                        </tr> \n";
                                        } else if (@$_GET['Delete'] == true) {
                                            $delete = $_GET['Delete'];
                                            echo "<tr>
                                        <td> \n";
                                            echo '<span class="check"><input type="checkbox" class="checked"></span>' . "\n";
                                            echo '<a href="#" class="text-success"> L\'article ' . $delete . ' a bien été supprimé</a></span>' . "\n";
                                            echo '<button class="close" aria-hidden="true" data-dismiss="alert" type="button" onClick="window.location.replace(\'../../panel/assembly_diagram.php\');">×</button>' . "\n";
                                            echo "</td>
                                        </tr> \n";
                                        } else if (@$_GET['Update'] == true) {
                                            $update = $_GET['Update'];
                                            echo "<tr>
                                        <td> \n";
                                            echo '<span class="check"><input type="checkbox" class="checked"></span>' . "\n";
                                            echo '<a href="#" class="text-success"> Modification de l\'article ' . $update . ' succès</a></span>' . "\n";
                                            echo '<button class="close" aria-hidden="true" data-dismiss="alert" type="button" onClick="window.location.replace(\'../../panel/assembly_diagram.php\');">×</button>' . "\n";
                                            echo "</td>
                                        </tr> \n";
                                        } else if (@$_GET['ErrorExt'] == true) {
                                            $erreur = $_GET['ErrorExt'];
                                            echo "<tr>
                                        <td> \n";
                                            echo '<span class="check"><input type="checkbox" class="checked"></span>' . "\n";
                                            echo '<a href="#" class="text-danger">' . $erreur . '</a></span>' . "\n";
                                            echo '<button class="close" aria-hidden="true" data-dismiss="alert" type="button" onClick="window.location.replace(\'../../panel/assembly_diagram.php\');">×</button>' . "\n";
                                            echo "</td>
                                        </tr> \n";
                                        } else if (@$_GET['ErrorBig'] == true) {
                                            $erreur = $_GET['ErrorBig'];
                                            echo "<tr>
                                        <td> \n";
                                            echo '<span class="check"><input type="checkbox" class="checked"></span>' . "\n";
                                            echo '<a href="#" class="text-danger">' . $erreur . '</a></span>' . "\n";
                                            echo '<button class="close" aria-hidden="true" data-dismiss="alert" type="button" onClick="window.location.replace(\'../../panel/assembly_diagram.php\');">×</button>' . "\n";
                                            echo "</td>
                                        </tr> \n";
                                        } else if (@$_GET['ErrorUp'] == true) {
                                            $erreur = $_GET['ErrorUp'];
                                            echo "<tr>
                                        <td> \n";
                                            echo '<span class="check"><input type="checkbox" class="checked"></span>' . "\n";
                                            echo '<a href="#" class="text-danger">' . $erreur . '</a></span>' . "\n";
                                            echo '<button class="close" aria-hidden="true" data-dismiss="alert" type="button" onClick="window.location.replace(\'../../panel/assembly_diagram.php\');">×</button>' . "\n";
                                            echo "</td>
                                        </tr> \n";
                                        } else if (@$_GET['ErrorRef'] == true) {
                                            $erreur = $_GET['ErrorRef'];
                                            echo "<tr>
                                        <td> \n";
                                            echo '<span class="check"><input type="checkbox" class="checked"></span>' . "\n";
                                            echo '<a href="#" class="text-danger">' . $erreur . '</a></span>' . "\n";
                                            echo '<button class="close" aria-hidden="true" data-dismiss="alert" type="button" onClick="window.location.replace(\'../../panel/assembly_diagram.php\');">×</button>' . "\n";
                                            echo "</td>
                                        </tr> \n";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /table-responsive -->
                        </div>
                        <!--/ White-panel -->
                    </div>
                </div>
                <!-- COMPLEX TO DO LIST -->
                <div class="row mt">
                    <div class="col-md-12">
                        <section class="task-panel tasks-widget">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h5><i class="fa fa-tasks"></i> Ajouter un nouveau article</h5>
                                </div>
                                <br>
                            </div>
                            <div class="panel-body">
                                <div class="task-content">
                                    <form action="../includes/resources/management_articles_assembly.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="ref">Référence de l'article</label>
                                            <input type="text" class="form-control" id="ref" name="ref" placeholder="DOC01" require autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label for="label">Label</label>
                                            <input type="text" class="form-control" id="label" name="label" placeholder="Plan de construction voiture" require>
                                        </div>
                                        <div class="form-group">
                                            <label for="desc">Description</label>
                                            <input type="text" class="form-control" id="desc" name="desc" placeholder="Schéma gratuit" require>
                                        </div>

                                        <div class="form-group">
                                            <label for="picture">Choisir une image</label>
                                            <input type="file" class="btn btn-primary btn-xs" id="picture" name="picture[]">
                                        </div>

                                        <div class="form-group">
                                            <label for="document">Choisir Le schéma</label>
                                            <input type="file" class="btn btn-primary btn-xs" id="document" name="document[]">
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-sm" id="upload-plan" name="upload-plan">Valider l'ajout du nouveau article</button>
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
                                    <h5><i class="fa fa-tasks"></i> Modifiaction et Suppression article</h5>
                                </div>
                                <br>
                            </div>
                            <div class="panel-body">
                                <div class="task-content">
                                    <ul id="sortable" class="task-list">
                                        <?php
                                        for ($i = 0; $i < count($arrayArticles); $i++) {
                                        ?>
                                            <li class="list-primary">
                                                <i class=" fa fa-ellipsis-v"></i>
                                                <div class="task-title">
                                                    <span class="task-title-sp"><?php echo $arrayArticles[$i]->getRefarticles() . " - " . $arrayArticles[$i]->getLable(); ?> </span>
                                                    <span class="badge bg-important"><?php echo "En Stock : " . $arrayArticles[$i]->getCurrentstock(); ?></span>
                                                    <div class="pull-right hidden-phone">
                                                        <button class="btn btn-success btn-xs fa fa-check" onClick="window.location.replace('../../panel/assembly_diagram.php');"></button>
                                                        <button class="btn btn-primary btn-xs fa fa-pencil" onclick="updateitems('<?php echo $arrayArticles[$i]->getRefarticles(); ?>')"></button>
                                                        <a class="btn btn-danger btn-xs fa fa-trash-o" href="assembly_diagram.php?del=<?php echo $arrayArticles[$i]->getRefarticles(); ?>"></a>
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
                            $ref = $_GET['del'];
                            $db_pdo->queryInsertion("DELETE FROM assembly_diagram WHERE refarticles_assembly = '" . $ref . "';");
                            $db_pdo->queryInsertion("DELETE FROM articles WHERE refarticles = '" . $ref . "';");
                            ob_end_clean();
                            header("location:../../panel/assembly_diagram.php");
                        }
                        ?>
                    </div>
                    <!--/col-md-12 -->
                </div>
                <!-- /row -->
            </section>
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
                url: '../includes/html/itemsAssemblyUpdates.php',
                method: "post",
                data: data,
                success: function(data) {
                    jQuery('body').append(data);
                    jQuery('#item-update-assembly').modal('toggle');
                },
                error: function() {
                    alert("error");
                }
            });
        }
    </script>
</body>

</html>
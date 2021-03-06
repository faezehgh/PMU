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
        <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
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
                    <li><a class="logout" href="includes/resources/disconnection_clients.php">D??connexion</a></li>
                </ul>
            </div>
        </header>
        <!--header end-->
        <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">

                    <p class="centered">
                        <a href="dashboard_pmu.php"><img src="assets/img/admin.png" class="img-circle" width="60"></a>
                    </p>
                    <h5 class="centered">Nom pr??nom</h5>

                    <li class="mt">
                        <a href="dashboard_pmu.php">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-cogs"></i>
                            <span>Components</span>
                        </a>
                        <ul class="sub">
                            <li><a href="gallery.php">Gallery</a></li>
                            <li><a href="article.php">Gestion Produit</a></li>
                            <li><a href="#">Gestion Client</a></li>
                            <li><a href="assembly_diagram.php">Gestion Sch??ma de montage</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-th"></i>
                            <span>Tableaux de donn??es</span>
                        </a>
                        <ul class="sub">
                            <li><a href="basic_table.php">Tables</a></li>
                            <li><a class="active" href="responsive_table.php">Table r??active</a></li>
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
        <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Responsive Table Examples</h3>
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Responsive Table</h4>
                            <section id="unseen">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Company</th>
                                            <th class="numeric">Price</th>
                                            <th class="numeric">Change</th>
                                            <th class="numeric">Change %</th>
                                            <th class="numeric">Open</th>
                                            <th class="numeric">High</th>
                                            <th class="numeric">Low</th>
                                            <th class="numeric">Volume</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>AAC</td>
                                            <td>AUSTRALIAN AGRICULTURAL COMPANY LIMITED.</td>
                                            <td class="numeric">$1.38</td>
                                            <td class="numeric">-0.01</td>
                                            <td class="numeric">-0.36%</td>
                                            <td class="numeric">$1.39</td>
                                            <td class="numeric">$1.39</td>
                                            <td class="numeric">$1.38</td>
                                            <td class="numeric">9,395</td>
                                        </tr>
                                        <tr>
                                            <td>AAD</td>
                                            <td>ARDENT LEISURE GROUP</td>
                                            <td class="numeric">$1.15</td>
                                            <td class="numeric"> +0.02</td>
                                            <td class="numeric">1.32%</td>
                                            <td class="numeric">$1.14</td>
                                            <td class="numeric">$1.15</td>
                                            <td class="numeric">$1.13</td>
                                            <td class="numeric">56,431</td>
                                        </tr>
                                        <tr>
                                            <td>AAX</td>
                                            <td>AUSENCO LIMITED</td>
                                            <td class="numeric">$4.00</td>
                                            <td class="numeric">-0.04</td>
                                            <td class="numeric">-0.99%</td>
                                            <td class="numeric">$4.01</td>
                                            <td class="numeric">$4.05</td>
                                            <td class="numeric">$4.00</td>
                                            <td class="numeric">90,641</td>
                                        </tr>
                                        <tr>
                                            <td>ABC</td>
                                            <td>ADELAIDE BRIGHTON LIMITED</td>
                                            <td class="numeric">$3.00</td>
                                            <td class="numeric"> +0.06</td>
                                            <td class="numeric">2.04%</td>
                                            <td class="numeric">$2.98</td>
                                            <td class="numeric">$3.00</td>
                                            <td class="numeric">$2.96</td>
                                            <td class="numeric">862,518</td>
                                        </tr>
                                        <tr>
                                            <td>ABP</td>
                                            <td>ABACUS PROPERTY GROUP</td>
                                            <td class="numeric">$1.91</td>
                                            <td class="numeric">0.00</td>
                                            <td class="numeric">0.00%</td>
                                            <td class="numeric">$1.92</td>
                                            <td class="numeric">$1.93</td>
                                            <td class="numeric">$1.90</td>
                                            <td class="numeric">595,701</td>
                                        </tr>
                                        <tr>
                                            <td>ABY</td>
                                            <td>ADITYA BIRLA MINERALS LIMITED</td>
                                            <td class="numeric">$0.77</td>
                                            <td class="numeric"> +0.02</td>
                                            <td class="numeric">2.00%</td>
                                            <td class="numeric">$0.76</td>
                                            <td class="numeric">$0.77</td>
                                            <td class="numeric">$0.76</td>
                                            <td class="numeric">54,567</td>
                                        </tr>
                                        <tr>
                                            <td>ACR</td>
                                            <td>ACRUX LIMITED</td>
                                            <td class="numeric">$3.71</td>
                                            <td class="numeric"> +0.01</td>
                                            <td class="numeric">0.14%</td>
                                            <td class="numeric">$3.70</td>
                                            <td class="numeric">$3.72</td>
                                            <td class="numeric">$3.68</td>
                                            <td class="numeric">191,373</td>
                                        </tr>
                                        <tr>
                                            <td>ADU</td>
                                            <td>ADAMUS RESOURCES LIMITED</td>
                                            <td class="numeric">$0.72</td>
                                            <td class="numeric">0.00</td>
                                            <td class="numeric">0.00%</td>
                                            <td class="numeric">$0.73</td>
                                            <td class="numeric">$0.74</td>
                                            <td class="numeric">$0.72</td>
                                            <td class="numeric">8,602,291</td>
                                        </tr>
                                        <tr>
                                            <td>AGG</td>
                                            <td>ANGLOGOLD ASHANTI LIMITED</td>
                                            <td class="numeric">$7.81</td>
                                            <td class="numeric">-0.22</td>
                                            <td class="numeric">-2.74%</td>
                                            <td class="numeric">$7.82</td>
                                            <td class="numeric">$7.82</td>
                                            <td class="numeric">$7.81</td>
                                            <td class="numeric">148</td>
                                        </tr>
                                        <tr>
                                            <td>AGK</td>
                                            <td>AGL ENERGY LIMITED</td>
                                            <td class="numeric">$13.82</td>
                                            <td class="numeric"> +0.02</td>
                                            <td class="numeric">0.14%</td>
                                            <td class="numeric">$13.83</td>
                                            <td class="numeric">$13.83</td>
                                            <td class="numeric">$13.67</td>
                                            <td class="numeric">846,403</td>
                                        </tr>
                                        <tr>
                                            <td>AGO</td>
                                            <td>ATLAS IRON LIMITED</td>
                                            <td class="numeric">$3.17</td>
                                            <td class="numeric">-0.02</td>
                                            <td class="numeric">-0.47%</td>
                                            <td class="numeric">$3.11</td>
                                            <td class="numeric">$3.22</td>
                                            <td class="numeric">$3.10</td>
                                            <td class="numeric">5,416,303</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                        <!-- /content-panel -->
                    </div>
                    <!-- /col-lg-4 -->
                </div>
                <!-- /row -->

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> No More Table</h4>
                            <section id="no-more-tables">
                                <table class="table table-bordered table-striped table-condensed cf">
                                    <thead class="cf">
                                        <tr>
                                            <th>Code</th>
                                            <th>Company</th>
                                            <th class="numeric">Price</th>
                                            <th class="numeric">Change</th>
                                            <th class="numeric">Change %</th>
                                            <th class="numeric">Open</th>
                                            <th class="numeric">High</th>
                                            <th class="numeric">Low</th>
                                            <th class="numeric">Volume</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-title="Code">AAC</td>
                                            <td data-title="Company">AUSTRALIAN AGRICULTURAL COMPANY LIMITED.</td>
                                            <td class="numeric" data-title="Price">$1.38</td>
                                            <td class="numeric" data-title="Change">-0.01</td>
                                            <td class="numeric" data-title="Change %">-0.36%</td>
                                            <td class="numeric" data-title="Open">$1.39</td>
                                            <td class="numeric" data-title="High">$1.39</td>
                                            <td class="numeric" data-title="Low">$1.38</td>
                                            <td class="numeric" data-title="Volume">9,395</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Code">AAD</td>
                                            <td data-title="Company">ARDENT LEISURE GROUP</td>
                                            <td class="numeric" data-title="Price">$1.15</td>
                                            <td class="numeric" data-title="Change"> +0.02</td>
                                            <td class="numeric" data-title="Change %">1.32%</td>
                                            <td class="numeric" data-title="Open">$1.14</td>
                                            <td class="numeric" data-title="High">$1.15</td>
                                            <td class="numeric" data-title="Low">$1.13</td>
                                            <td class="numeric" data-title="Volume">56,431</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Code">AAX</td>
                                            <td data-title="Company">AUSENCO LIMITED</td>
                                            <td class="numeric" data-title="Price">$4.00</td>
                                            <td class="numeric" data-title="Change">-0.04</td>
                                            <td class="numeric" data-title="Change %">-0.99%</td>
                                            <td class="numeric" data-title="Open">$4.01</td>
                                            <td class="numeric" data-title="High">$4.05</td>
                                            <td class="numeric" data-title="Low">$4.00</td>
                                            <td class="numeric" data-title="Volume">90,641</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Code">ABC</td>
                                            <td data-title="Company">ADELAIDE BRIGHTON LIMITED</td>
                                            <td class="numeric" data-title="Price">$3.00</td>
                                            <td class="numeric" data-title="Change"> +0.06</td>
                                            <td class="numeric" data-title="Change %">2.04%</td>
                                            <td class="numeric" data-title="Open">$2.98</td>
                                            <td class="numeric" data-title="High">$3.00</td>
                                            <td class="numeric" data-title="Low">$2.96</td>
                                            <td class="numeric" data-title="Volume">862,518</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Code">ABP</td>
                                            <td data-title="Company">ABACUS PROPERTY GROUP</td>
                                            <td class="numeric" data-title="Price">$1.91</td>
                                            <td class="numeric" data-title="Change">0.00</td>
                                            <td class="numeric" data-title="Change %">0.00%</td>
                                            <td class="numeric" data-title="Open">$1.92</td>
                                            <td class="numeric" data-title="High">$1.93</td>
                                            <td class="numeric" data-title="Low">$1.90</td>
                                            <td class="numeric" data-title="Volume">595,701</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Code">ABY</td>
                                            <td data-title="Company">ADITYA BIRLA MINERALS LIMITED</td>
                                            <td class="numeric" data-title="Price">$0.77</td>
                                            <td class="numeric" data-title="Change"> +0.02</td>
                                            <td class="numeric" data-title="Change %">2.00%</td>
                                            <td class="numeric" data-title="Open">$0.76</td>
                                            <td class="numeric" data-title="High">$0.77</td>
                                            <td class="numeric" data-title="Low">$0.76</td>
                                            <td class="numeric" data-title="Volume">54,567</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Code">ACR</td>
                                            <td data-title="Company">ACRUX LIMITED</td>
                                            <td class="numeric" data-title="Price">$3.71</td>
                                            <td class="numeric" data-title="Change"> +0.01</td>
                                            <td class="numeric" data-title="Change %">0.14%</td>
                                            <td class="numeric" data-title="Open">$3.70</td>
                                            <td class="numeric" data-title="High">$3.72</td>
                                            <td class="numeric" data-title="Low">$3.68</td>
                                            <td class="numeric" data-title="Volume">191,373</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Code">ADU</td>
                                            <td data-title="Company">ADAMUS RESOURCES LIMITED</td>
                                            <td class="numeric" data-title="Price">$0.72</td>
                                            <td class="numeric" data-title="Change">0.00</td>
                                            <td class="numeric" data-title="Change %">0.00%</td>
                                            <td class="numeric" data-title="Open">$0.73</td>
                                            <td class="numeric" data-title="High">$0.74</td>
                                            <td class="numeric" data-title="Low">$0.72</td>
                                            <td class="numeric" data-title="Volume">8,602,291</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Code">AGG</td>
                                            <td data-title="Company">ANGLOGOLD ASHANTI LIMITED</td>
                                            <td class="numeric" data-title="Price">$7.81</td>
                                            <td class="numeric" data-title="Change">-0.22</td>
                                            <td class="numeric" data-title="Change %">-2.74%</td>
                                            <td class="numeric" data-title="Open">$7.82</td>
                                            <td class="numeric" data-title="High">$7.82</td>
                                            <td class="numeric" data-title="Low">$7.81</td>
                                            <td class="numeric" data-title="Volume">148</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Code">AGK</td>
                                            <td data-title="Company">AGL ENERGY LIMITED</td>
                                            <td class="numeric" data-title="Price">$13.82</td>
                                            <td class="numeric" data-title="Change"> +0.02</td>
                                            <td class="numeric" data-title="Change %">0.14%</td>
                                            <td class="numeric" data-title="Open">$13.83</td>
                                            <td class="numeric" data-title="High">$13.83</td>
                                            <td class="numeric" data-title="Low">$13.67</td>
                                            <td class="numeric" data-title="Volume">846,403</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Code">AGO</td>
                                            <td data-title="Company">ATLAS IRON LIMITED</td>
                                            <td class="numeric" data-title="Price">$3.17</td>
                                            <td class="numeric" data-title="Change">-0.02</td>
                                            <td class="numeric" data-title="Change %">-0.47%</td>
                                            <td class="numeric" data-title="Open">$3.11</td>
                                            <td class="numeric" data-title="High">$3.22</td>
                                            <td class="numeric" data-title="Low">$3.10</td>
                                            <td class="numeric" data-title="Volume">5,416,303</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                        <!-- /content-panel -->
                    </div>
                    <!-- /col-lg-12 -->
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


</body>

</html>
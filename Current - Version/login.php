<?php require 'includes/html/header.php'; ?>

<?php
$link = "http://" . $_SERVER['HTTP_HOST'] . "" . $_SERVER['PHP_SELF'];
$linkActuel = "http://" .  $_SERVER['HTTP_HOST'] . "/login.php";
if ($link != $linkActuel) {
    header("location:error/404.html");
}
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
                <img class="mb-4 center-block" src="assets/pictures/logo.png" alt="logo PMU">
                <h5 class="card-title text-center">Se connecter</h5>
                <form class="form-signin" method="POST" action="connection.php">
                    <div class="form-label-group">
                        <label for="inputEmail">Adresse Email</label>
                        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
                    </div>

                    <div class="form-label-group">
                        <label for="inputPassword">Mot de passe</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                    </div>

                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Se souvenir du mot de passe</label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" name="logins" type="submit">Se connecter</button>
                    <?php
                    if (@$_GET['Empty'] == true) { // Message d'erreur si dans l'url il y a Empty == retour message erreur
                        $erreur = $_GET['Empty'];
                        echo '<div class="alert-light text-danger text-center">' . $erreur . '</div>'; // Message récupéré par $_GET
                    } else if (@$_GET['Invalid'] == true) {
                        $erreur = $_GET['Invalid'];
                        echo '<div class="alert-light text-danger text-center">' . $erreur . '</div>'; // Message récupéré par $_GET
                    }
                    ?>
                    <hr>
                </form>
                <div class="btn-group center-block"">
                    <button class=" btn btn-lg pull-left text-uppercase" onclick="window.location.href='accountcreation.php'"><i class="fab fa-google mr-2"></i> Créer un compte</button>
                    <button class="btn btn-lg  pull-right text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Mot de passe perdu </button>
                </div>
            </div>
        </div>
    </div>
    <?php require 'includes/html/footer.php'; ?>
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
<?php
include '../classes/db_pdo.php';
$db_pdo = new db_pdo();

$ref = $_POST['id'];
$price = $_POST['price'];

$selectArticle = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.description, a.current_stock, a.sell_price, c.label, p.path_picture FROM articles AS a, category AS c, picture AS p WHERE a.idcategory = c.idcategory AND a.idpicture = p.idpicture AND  refarticles = '" . $ref . "'");
$selectArticle = $selectArticle->fetchAll();
?>
<?php ob_start(); ?>
<!-- Details Items -->
<div class="modal fade details-1" id="details-items" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" onclick="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-center"><?php echo $selectArticle[0][1]; ?></h4>
            </div>
            <form action="../includes/resources/add_cart.php" method="POST">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="center-block">
                                    <img src="<?php echo $selectArticle[0][6]; ?>" alt="<?php echo $selectArticle[0][1]; ?>" class="details img-responsive">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4>Description</h4>
                                <p><?php echo $selectArticle[0][2]; ?></p>
                                <hr>
                                <p>Prix : <?php echo $price; ?> €</p>
                                <input type="hidden" id="price" name="price" value="<?php echo $price; ?>">
                                <p>Référence : <?php echo $selectArticle[0][0]; ?> &nbsp; &nbsp; Marque : Meccano</p>
                                <p>Disponible : <?php echo $selectArticle[0][3]; ?></p>
                                <input type="hidden" id="custId" name="custId" value="<?php echo $selectArticle[0][0]; ?>">
                                <div class="form-group">
                                    <div class="col-xs-4">
                                        <label for="quantity">Quantité :</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="800" value="1">
                                    </div>
                                    <div class="col-xs-7">
                                        <label for="pays">Livraison :</label>
                                        <select name="pays" id="pays" class="form-control">
                                            <option value="pays">pays de livraison</option>
                                            <option value="CHINE">CHINE</option>
                                            <option value="FRANCE">FRANCE</option>
                                            <option value="ALLEMAGNE">ALLEMAGNE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" onclick="closeModal()">Fermer</button>
                    <button class="btn btn-warning" type=submit id="add" name="add"><span class="icon-shopping-cart"></span> Ajouter au panier</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function closeModal() {
        jQuery('#details-items').modal('hide');
        setTimeout(function() {
            jQuery('#details-items').remove();
            jQuery('.modal-backdrop').remove();
        }, 500);
    }
</script>
<?php echo ob_get_clean(); ?>
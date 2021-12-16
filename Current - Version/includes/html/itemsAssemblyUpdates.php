<?php
include '../classes/db_pdo.php';
include '../classes/articles.php';
$db_pdo = new db_pdo();

$ref = $_POST['id'];

$selectArticle = $db_pdo->queryExtraction("SELECT a.refarticles, a.label, a.description, a.current_stock, a.alerte_stock, a.sell_price, a.idcategory, a.idpicture, c.label, p.path_picture FROM articles AS a, category AS c, picture AS p WHERE a.idcategory = c.idcategory AND a.idpicture = p.idpicture AND refarticles = '" . $ref . "'");
$selectArticle = $selectArticle->fetchAll();
$articles = new articles($selectArticle[0][0], $selectArticle[0][1], $selectArticle[0][2], $selectArticle[0][3], $selectArticle[0][4], $selectArticle[0][5], $selectArticle[0][6], $selectArticle[0][7]);
$selectAssembly = $db_pdo->queryExtraction("SELECT refarticles_assembly, path_assembly FROM assembly_diagram WHERE refarticles_assembly = '" . $ref . "'");
$selectAssembly = $selectAssembly->fetchAll();
?>
<?php ob_start(); ?>
<div class="modal fade details-1" id="item-update-assembly" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="../includes/resources/management_articles_assembly.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" onclick="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center"><?php echo $articles->getLable(); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="center-block">
                                    <img src="<?php echo  "../../" . $selectArticle[0][9] ?>" alt="<?php echo $selectArticle[0][7] ?>" class="details img-responsive">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4>Details</h4>
                                <?php echo '<p> Référence : ' . $articles->getRefarticles() . '</p>'; ?>
                                <hr>
                                <div class="form-group">
                                    <div class="col-xs-7">
                                        <input type="hidden" id="custId" name="custId" value="<?php echo $articles->getRefarticles(); ?>">
                                        <label for="quantity">Label :</label>
                                        <input type="text" class="form-control" id="label" name="label" value="<?php echo $articles->getLable(); ?>">
                                    </div>
                                    <div class="col-xs-12">
                                        <label for="quantity">Description :</label>
                                        <input type="text" class="form-control" id="desc" name="desc" value="<?php echo $articles->getDescription(); ?>">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="quantity">Prix :</label>
                                        <input type="number" step="any" class="form-control" id="price" name="price" value="<?php echo $articles->getSellprice(); ?>">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="quantity">Stock actuel :</label>
                                        <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $articles->getCurrentstock(); ?>" min="0" max="800">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="quantity">Alerte stock :</label>
                                        <input type="number" class="form-control" id="alerte" name="alerte" value="<?php echo $articles->getAlertestock(); ?>" min="0" max="800">
                                    </div>
                                    <div class="col-xs-7">
                                        <label for="size">categorie :</label>
                                        <select class="form-control" id="categorie" name="categorie">
                                            <?php echo '<option>' . $selectArticle[0][6] . ' - ' . $selectArticle[0][8] . '</option>'; ?>
                                            <?php
                                            $categorie = $db_pdo->queryExtraction("SELECT idcategory, label FROM category;");
                                            $categorie = $categorie->fetchAll();
                                            foreach ($categorie as $id) {
                                                echo '<option>' . $id[0] . ' - ' . $id[1] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-7">
                                        <label for="picture">Choisir une image</label>
                                        <input type="file" class="btn btn-primary btn-xs" id="picture" name="picture[]">
                                    </div>
                                    <br>
                                    <div class="col-xs-7">
                                            <label for="document">Choisir Le schéma</label>
                                            <input type="file" class="btn btn-primary btn-xs" id="document" name="document[]">
                                            <a class="btn btn-info" href="<?php echo '../' .$selectAssembly[0][1]; ?>" target="_blank">Voir le PDF</a>
                                    </div>
                                    <br>
                                    <div class="col-xs-9">
                                        <label for="size">Images existante :</label>
                                        <select class="form-control" id="picture-existing" name="picture-existing">
                                            <option>Garder l'image par défaut</option>
                                            <?php
                                            $picture = $db_pdo->queryExtraction("SELECT idpicture, path_picture FROM picture;");
                                            $picture = $picture->fetchAll();
                                            foreach ($picture as $pictures) {
                                                echo '<option>' . $pictures[0] . ' - ' . $pictures[1] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button class="btn btn-default" onclick="closeModal()">Fermer</button>
                        <button class="btn btn-warning" type="submit" id="update-assembly" name="update-assembly"><span class="icon-shopping-cart"></span> Modifier</button>
                        <button class="btn btn-danger" type="submit" id="delete-assembly" name="delete-assembly"><span class="icon-shopping-cart"></span> Supprimer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function closeModal() {
        jQuery('#item-update-assembly').modal('hide');
        setTimeout(function() {
            jQuery('#item-update-assembly').remove();
            jQuery('.modal-backdrop').remove();
        }, 500);
    }
</script>
<?php echo ob_get_clean(); ?>
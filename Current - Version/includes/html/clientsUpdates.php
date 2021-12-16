<?php
include '../classes/db_pdo.php';
include '../resources/decryptage.php';
$db_pdo = new db_pdo();

$id = $_POST['id'];

$selectClient = $db_pdo->queryExtraction("SELECT idclients, last_name, first_name, idpermission, check_account, use_key FROM clients WHERE idclients = '" . $id . "';");
$selectClient = $selectClient->fetchAll();
?>
<?php ob_start(); ?>
<div class="modal fade details-1" id="client-update" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="../includes/resources/management_client.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" onclick="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center"><?php echo "ID client : " . $selectClient[0][0];?></h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>Information</h4>
                                <?php echo '<p> Nom : '.DecodeData($selectClient[0][1]).' | Prénom : '.DecodeData($selectClient[0][2]).'<br>Key : ' .$selectClient[0][5]. ' </p>' ?>
                                <hr>
                                <div class="form-group">
                                <input type="hidden" id="id" name="id" value="<?php echo $selectClient[0][0] ?>">
                                    <div class="col-xs-4">
                                        <label for="permission">Permission :</label>
                                        <input type="number" class="form-control" id="permission" name="permission" value="<?php echo $selectClient[0][3]; ?>" min="0" max="4">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="check">Check Compte :</label>
                                        <input type="number" class="form-control" id="check" name="check" value="<?php echo $selectClient[0][4]; ?>" min="0" max="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button class="btn btn-default" onclick="closeModal()">Fermer</button>
                        <button class="btn btn-warning" type="submit" id="update-client" name="update-client"><span class="icon-shopping-cart"></span> Modifier</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function closeModal() {
        jQuery('#client-update').modal('hide');
        setTimeout(function() {
            jQuery('#client-update').remove();
            jQuery('.modal-backdrop').remove();
        }, 500);
    }
</script>
<?php echo ob_get_clean(); ?>
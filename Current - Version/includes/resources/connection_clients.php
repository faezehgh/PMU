<?php
class connection_clients
{
    private $bddPdo;

    public function __construct($_bddPdo)
    {
        $this->bddPdo = $_bddPdo;
    }

    public function ConnectionUser($email)
    {

        $selectUser = $this->bddPdo->queryExtraction("SELECT c.use_key, c.check_account, c.idpermission, i.password FROM clients AS c, identifiers AS i WHERE c.idclients = i.idpassword_client AND c.email = '$email';");
        $selectUser = $selectUser->fetchAll();
        if ($selectUser) {
            return $selectUser;
        } else {
            header("location:../login.php?Invalid= Information incorrecte");
        }
    }
}
?>
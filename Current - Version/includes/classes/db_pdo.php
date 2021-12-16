<?php
class db_pdo
{
     private $adress = "mysql:dbname=ecommerce_data;host=localhost"; // Base de données Mysql 
     private $user = "root";
     private $password = "root";

     /*private $adress = "mysql:dbname=id15099080_ecommerce_data;host=localhost"; // Base de données Mysql 
     private $user = "id15099080_lpuser";
     private $password = "=7MX*bE=CM}q%B?B";*/

     private $pdo;

     /*
     * constructeur de la classe db_pdo
     */
     public function __construct() 
     {
         $this->pdo = $this->connectDB();
     }

     /*
     *Fonction de connection a la base de données
     */
    private function connectDB(){
        try{
            $pdo = new PDO($this->adress, $this->user, $this->password);
            return $pdo;
       }catch(PDOException $ex){
           print " Connexion échouée : " . $ex->getMessage();
           return $ex;
       }
    }

    /*
     *Fonction pour exécuter les requetes select.
     * $request : Requete en type string
     */
    public function queryExtraction($request){
        try{
            if(! $this->pdo){
                print("Erreur Base de données");
            }else{
                $result = $this->pdo->query($request);
                return $result;
            }
        }catch(Exception $ex){
            return null;
        }
    }

    /*
     *Fonction pour exécuter les requetes Insert Update Delete.
     * $request : Requete en type string
     */
    public function queryInsertion($request){
        try{
            if(! $this->pdo){
                print("Erreur Base de données");
            }else{
                $this->pdo->exec($request);
                return 0;
            }
        }catch(Exception $ex){
            return -1;
        }
    }

    /*
     * Fonction qui retourne la version de mysql
     */
    public function Version(){
        $version = $this->pdo->query('select version()')->fetchColumn();
        return $version;
    }
}

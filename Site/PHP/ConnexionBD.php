<?php
    class Database{
        private $bdd;
        
        public function __construct($host, $dbName, $user, $password){
            try{
                $this->bdd = new PDO('mysql:host='.$host.';dbname='.$dbName.'', ''.$user.'', ''.$password.'' ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            }
            catch(Exception $e){
                die('Erreur : ' .$e->getMessage());
            }
        }
        
        //Éxecute une requete SQL et retourne un objet du type de la classe passée en paramètre.
        public function Request($query, $parametres, $classe){     
            $query = $this->bdd->prepare($query);
            $query->execute($parametres);
            $result = $query->fetchAll(PDO::FETCH_CLASS, $classe);
            
            return $result;
        }
        
        public function getPDO(){
            return $this->bdd;
        }
    }

    $bdd = new Database("localhost", "bdprojet_equipe2v2", "root", "");
    //$bdd = new Database("dicj.info", "cegepjon_p2017_2_dev", "cegepjon_p2017_2", "madfpfadshdb");

?>
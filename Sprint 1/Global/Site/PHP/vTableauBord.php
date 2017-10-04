<?php
    
    try
	{
        $bdd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_prod', 'cegepjon_p2017_2', 'madfpfadshdb',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

    $id = $_GET["idStagiaire"];

	$query = $bdd->prepare("SELECT * FROM vTableauBord WHERE Id = :idStagiaire");

    $query->execute(array('idStagiaire'=>$id));
    $profils = $query->fetchAll();
    
    foreach($profils as $profil){
        $idStagiaire = $profil["Id"];
        $prenomStagiaire = $profil["Prenom"];
        $nomStagiaire = $profil["Nom"];
        $telPerso = $profil["NumTelPersonnel"];

        $idSup = $profil["Id Superviseur"];
        $nomSup = $profil["Nom Superviseur"];
        $prenomSup = $profil["Prenom Superviseur"];
        $cellSup = $profil["Cell Superviseur"];

        $idProf = $profil["Id Enseignant"];
        $prenomProf = $profil["Prenom Enseignant"];
        $nomProf = $profil["Nom Enseignant"];
        $telProf = $profil["Tel Enseignant"];
    }

?>
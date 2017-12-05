<?php
    
    include 'ConnexionBD.php';

    $id = $_SESSION["idConnecte"];
    $where = "";
    
    switch($_SESSION["IdRole"]){
        case 2: $where = "IdResponsable";
            break;
        case 4: $where = "IdSuperviseur";
            break;
        case 5: $where = "Id";
            break;
    }

	$query = $bdd->prepare("SELECT * FROM vTableauBord WHERE $where = :id");

    $query->execute(array('id'=>$id));
    $profils = $query->fetchAll();

    foreach($profils as $profil)
    {
        $idStagiaire = $profil["Id"];
        $prenomStagiaire = $profil["Prenom"];
        $nomStagiaire = $profil["Nom"];
        $telPerso = $profil["NumTel"];

        $idSup = $profil["IdSuperviseur"];
        $nomSup = $profil["NomSuperviseur"];
        $prenomSup = $profil["PrenomSuperviseur"];
        $cellSup = $profil["TelSuperviseur"];

        $idProf = $profil["IdEnseignant"];
        $prenomProf = $profil["PrenomEnseignant"];
        $nomProf = $profil["NomEnseignant"];
        $telProf = $profil["TelEnseignant"];
    }

?>
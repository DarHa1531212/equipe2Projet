<?php

    include 'ConnexionBD.php';
if (verifyTimeout())

{
    $id = $_SESSION["idConnecte"];

    $query = $bdd->prepare("SELECT * FROM vTableauBord WHERE Id = :idStagiaire");

    $query->execute(array('idStagiaire'=>$id));
    $profils = $query->fetchAll();
    
    foreach($profils as $profil){
        $idStagiaire = $profil["Id"];
        $prenomStagiaire = $profil["Prenom"];
        $nomStagiaire = $profil["Nom"];
        $telPerso = $profil["NumTel"];

        $idSup = $profil["Id Superviseur"];
        $nomSup = $profil["Nom Superviseur"];
        $prenomSup = $profil["Prenom Superviseur"];
        $cellSup = $profil["Tel Superviseur"];

        $idProf = $profil["Id Enseignant"];
        $prenomProf = $profil["Prenom Enseignant"];
        $nomProf = $profil["Nom Enseignant"];
        $telProf = $profil["Tel Enseignant"];
    }
    
}
    

?>
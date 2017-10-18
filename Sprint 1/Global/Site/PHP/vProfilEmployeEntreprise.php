<?php

    if(!isset($_POST['idSuperviseur']))
    {
    	$id = $_SESSION['idConnecte'];
    }
    else
    {
    	$id = $_POST["idSuperviseur"];
    }

    $query = $bdd->prepare("SELECT Prenom, Emp.Nom, Ent.Nom AS 'Nom Entreprise', NumTelCell, CourrielPersonnel, NumTelEntreprise, Poste, Emp.CourrielEntreprise
                            FROM vEmploye AS Emp
                            INNER JOIN vEntreprise AS Ent
                            ON Emp.IdEntreprise = Ent.Id
                            WHERE Emp.Id = :idSuperviseur");

    $query->execute(array('idSuperviseur'=>$id));
    $superviseurs = $query->fetchAll();
    
    foreach($superviseurs as $superviseur){
        $prenomSup = $superviseur["Prenom"]; //Initialisation des variables a afficher dans les balises.
        $nomSup = $superviseur["Nom"];
        $nomEntrepriseSup = $superviseur["Nom Entreprise"];
        $numTelCellSup = $superviseur["NumTelCell"];
        $courrielPersonnelSup = $superviseur["CourrielPersonnel"];
        $numTelEntrepriseSup = $superviseur["NumTelEntreprise"];
        $posteSup = $superviseur["Poste"];
        $courrielEntrepriseSup = $superviseur["CourrielEntreprise"];
    }

?>
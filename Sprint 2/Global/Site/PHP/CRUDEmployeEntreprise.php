<?php
/********************************************************************************************************************
*	Nom: Hans Darmstadt-Bélanger																					*
*	Date: 01 Novembre 2017																							*
*	But: recevoir les données de création ou de modification d'un stageiaire via un post et les entrer dans la BD 	*
*********************************************************************************************************************/
	
	/* Données à recevoir pour la création d'un stage: 
	prenomStagiaire, nomStagiaire, courrielScholaire*/

	include 'connexionBD.php';

	$data = $_POST ['tabValues'];
	$dataArray = (json_decode($data, false));
	$functionToExecute =  $dataArray[0]->value;

	switch ($functionToExecute) {
		case "1":
			creationEmployeEntreprise($bdd, $dataArray);
			break;
		case "2": 
			return (afficherInfos($bdd, $dataArray));
			break;
	}


	//ajouter un stagiaire dans la base de données
	function creationEmployeEntreprise($bdd, $dataArray)
	{
	$prenom = $dataArray[1]->value;
	$nom = $dataArray[2]->value;
	$courrielEmploye = $dataArray[3]->value;
	$telEmploye = $dataArray[4]->value;
	$posteTelEmploye = $dataArray[5]->value;
	$idEntreprise = $dataArray[6]->value;


	$query = $bdd->prepare("INSERT IGNORE INTO tblEmploye (CourrielEntreprise,Nom,Prenom,NumTelEntreprise,Poste,IdEntreprise)VALUES($courrielEmploye,$nom,$prenom,$telEmploye,$posteTelEmploye,$idEntreprise);");
    $query->execute();
	}

	
	function afficherInfos($bdd, $dataArray)
	{
		$idStagiaire =  intval ($dataArray[1]->value);
		$returnData = array();

		$query = $bdd->prepare("select 
    vStagiaire.Nom as 'NomStagiaire', 
    vStagiaire.Prenom as 'PrenomStagiaire'  , 
    vStagiaire.CourrielScolaire as 'CourrieScolaire', 
    vStagiaire.NumTelEntreprise as 'NumTelEntreprise',
    vStagiaire.Poste as 'Poste',
    vStagiaire.CourrielEntreprise as 'CourrielEntreprise', 
    vStagiaire.CodePermanent as 'CodePermanent', 
    vStagiaire.CourrielPersonnel as 'CourrielPersonnel', 
    vStagiaire.NumTel as 'NumTelStagiaire', 
    vEntreprise.Nom as 'NomEntreprise'
    from vStagiaire 
    join vStage on vStage.idStagiaire = vStagiaire.IdUtilisateur 
    join vSuperviseur on vStage.IdSuperviseur = vSuperviseur.IdUtilisateur 
    join vEntreprise on vEntreprise.Id = vSuperviseur.IdEntreprise 
    where vStagiaire.IdUtilisateur like :idStagiaire");

		$query->execute(array('idStagiaire'=> $idStagiaire));     
		$entrees = $query->fetchAll();

	foreach($entrees as $entree){


		$NomStagiaire = $entree["NomStagiaire"];
		$PrenomStagiaire = $entree["PrenomStagiaire"];
		$CourrieScolaire = $entree["CourrieScolaire"];
		$NumTelEntreprise = $entree["NumTelEntreprise"];
		$Poste = $entree["Poste"];
		$CourrielEntreprise = $entree["CourrielEntreprise"];
		$CodePermanent = $entree["CodePermanent"];
		$CourrielPersonnel = $entree["CourrielPersonnel"];
		$NumTelStagiaire = $entree["NumTelStagiaire"];
		$NomEntreprise = $entree["NomEntreprise"];

		$returnData [0] = $NomStagiaire;
		$returnData [1] = $PrenomStagiaire;
		$returnData [2] = $CourrieScolaire;
		$returnData [3] = $NumTelEntreprise;
		$returnData [4] = $Poste;
		$returnData [5] = $CourrielEntreprise;
		$returnData [6] = $CodePermanent;
		$returnData [7] = $CourrielPersonnel;
		$returnData [8] = $NumTelStagiaire;
		$returnData [9] = $NomEntreprise;  
	}

	return $returnData;

	}

?>
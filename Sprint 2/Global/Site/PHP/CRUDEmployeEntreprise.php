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
		$idEmploye =  intval ($dataArray[1]->value);
		$returnData = array();

		$query = $bdd->prepare("select 
		concat (Prenom, ' ' , vEmploye.Nom) as 'NomEmploye', 
		vEmploye.CourrielEntreprise as 'CourrielEmploye' , 
		vEmploye.NumTel as 'NumTelEmploye', 
		Poste as 'PosteEmploye',
		vEntreprise.Nom as 'NomEntreprise'
		from vEmploye
		join vEntreprise on vEmploye.IdEntreprise = vEntreprise.Id 
		where IdUtilisateur like :idEmploye");

		$query->execute(array('idEmploye'=> $idEmploye));     
		$entrees = $query->fetchAll();

	foreach($entrees as $entree){


		$NomEmploye = $entree["NomEmploye"];
		$CourrielEmploye = $entree["CourrielEmploye"];
		$NumTelEmploye = $entree["NumTelEmploye"];
		$PosteEmploye = $entree["PosteEmploye"];
		$NomEntreprise = $entree["NomEntreprise"];
	
		$returnData [0] = $NomEmploye;
		$returnData [1] = $CourrielEmploye;
		$returnData [2] = $NumTelEmploye;
		$returnData [3] = $PosteEmploye;
		$returnData [4] = $NomEntreprise;

	}

	return $returnData;

	}

?>
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
	
	$nomEntreprise = $dataArray[0]->value;
	$numCiviqueEntreprise = $dataArray[1]->value;
	$rueEntreprise = $dataArray[2]->value;
	$villeEntreprise = $dataArray[3]->value;
	$provinceEntreprise = $dataArray[4]->value;
	$codePostalEntreprise = $dataArray[5]->value;
	$noTelEntreprise = $dataArray[6]->value;
	$descEntreprise = $dataArray[7]->value;	
	$courrielEtreprise = $dataArray[8]->value;	
	
	/* /!\AJOUTER LA DescriptionEntreprise DANS L'INSERTION /!\, DescriptionEntreprise  , '$descEntreprise' */

	$query = $bdd->prepare("insert into tblEntreprise (Nom, NumCivique, Rue, Ville, Province, CodePostal, NumTel, CourrielEntreprise) Values  ('$nomEntreprise' , '$numCiviqueEntreprise' , '$rueEntreprise', '$villeEntreprise', '$provinceEntreprise', '$codePostalEntreprise', '$noTelEntreprise', '$courrielEtreprise');");
    $query->execute();



?>
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
	
	$prenom = $dataArray[0]->value;
	$nom = $dataArray[1]->value;
	$courrielScolaire = $dataArray[2]->value;

	$query = $bdd->prepare("insert into tblStagiaire (Prenom, Nom, CourrielScolaire) Values  ('$prenom' , '$nom' , '$dcourrielScolaire');");
    $query->execute();


?>
<?php
/********************************************************************************************************************
*	Nom: Hans Darmstadt-Bélanger																					*
*	Date: 01 Novembre 2017																							*
*	But: recevoir les données de création ou de modification d'un stageiaire via un post et les entrer dans la BD 	*
*********************************************************************************************************************/
	
	/* Données à recevoir pour la création d'un stage: 
	prenomStagiaire, nomStagiaire, courrielScholaire*/



	$data = $_POST ['tabValues'];
	$query = $bdd->prepare("insert into tblStagiaire (Prenom, Nom, CourrielScolaire) Values  ('$data[0]' , '$data[1]' , '$data[2]');");
    $query->execute();


?>
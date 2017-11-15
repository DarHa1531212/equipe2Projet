<?php
/****************************************************************************************************************
*	Nom: Hans Darmstadt-Bélanger																				*
*	Date: 01 Novembre 2017																						*
*	But: recevoir les données de création ou de modification d'un stage via un post et les entrer dans la BD 	*
*****************************************************************************************************************/
	
	/* Données à recevoir pour la création d'un stage: 
	idEntreprise, idResponsable, idSuperviseur, idStagiaire, idEnseignant, 
	descriptionStage, competencesRecherche, horaireTravail, nbreHeuresSemaine, 
	Remunere, salaireHoraire, dateDebut, dateFin*/
function ajouterStage()
{

//DERNIÈRE VERSION
}
include 'connexionBD.php'; 
	$data = $_POST ['tabValues'];
	$dataArray = (json_decode($data, false));

	//toutes les variables du dataArray sont converties avant d'être mises dans la BD
	$idStagiaire = intval ($dataArray[0]->value);
	$idEntreprise = intval ($dataArray[1]->value);
	$idResponsable = intval ($dataArray[2]->value);
	$idSuperviseur = intval ($dataArray[3]->value);
	$idEnseignant = intval ($dataArray[4]->value);
	$descriptionStage = $dataArray[5]->value;
	$competencesRecherche = $dataArray[6]->value;
	$horaireTravail = $dataArray[7]->value;
	$nbreHeuresSemaine = intval ($dataArray[8]->value);
	$salaireHoraire = intval ($dataArray[9]->value);
	$dateDebut = date ('d-m-Y', strtotime($dataArray[10]->value));
	$dateFin = date ('d-m-Y', strtotime($dataArray[11]->value));

//   CompetencesRecherchees - HoraireTravail -      NbreHeuresSemaine -            SalaireHoraire -                dateDebut -                                    dateFin
	$query = $bdd->prepare("INSERT INTO tblStage 	(	idStagiaire	, 	idResponsable	,	idSuperviseur	,  	idEnseignant	, 	descriptionStage	, 	CompetenceRecherche	, 	horaireTravail	, 	NbHeureSemaine	, 	salaireHoraire	,	 	dateDebut		, 	dateFin 		) 
	Values	(	'$idStagiaire','$idResponsable','$idSuperviseur','$idEnseignant','$descriptionStage','$competencesRecherche','$horaireTravail','$nbreHeuresSemaine','$salaireHoraire','$dateDebut','$dateFin'); ");

    $query->execute();


?>
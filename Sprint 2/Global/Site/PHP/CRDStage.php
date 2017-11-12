<?php
/****************************************************************************************************************
*	Nom: Hans Darmstadt-Bélanger																				*
*	Date: 01 Novembre 2017																						*
*	But: recevoir les données de création ou de modification d'un stage via un post et les entrer dans la BD 	*
*****************************************************************************************************************/
	


include 'connexionBD.php'; 
	$data = $_POST ['tabValues'];
	$dataArray = (json_decode($data, false));


	$functionToExecute = intval $dataArray[0]->value;
switch ($functionToExecute)
{

case "1": insertToDB($bdd, $dataArray);
	break;
case "2": returnSuperviseursAndResponsables($bdd);
	break;

}

	

function insertToDB($bdd, $dataArray)
{

	//toutes les variables du dataArray sont converties avant d'être mises dans la BD
	$idStagiaire = intval ($dataArray[1]->value);
	$idEntreprise = intval ($dataArray[2]->value);
	$idResponsable = intval ($dataArray[3]->value);
	$idSuperviseur = intval ($dataArray[4]->value);
	$idEnseignant = intval ($dataArray[5]->value);
	$descriptionStage = $dataArray[6]->value;
	$competencesRecherche = $dataArray[7]->value;
	$horaireTravail = $dataArray[8]->value;
	$nbreHeuresSemaine = intval ($dataArray[9]->value);
	$salaireHoraire = intval ($dataArray[10]->value);
	$dateDebut = date ('Y-m-d', strtotime($dataArray[11]->value));
	$dateFin = date ('Y-m-d', strtotime($dataArray[12]->value));

	$query = $bdd->prepare("INSERT INTO tblStage 	(IdStagiaire,IdResponsable,IdSuperviseur,IdEnseignant,DescriptionStage,CompetenceRecherche,HoraireTravail,NbHeureSemaine,SalaireHoraire,DateDebut,DateFin) 
	Values	('$idStagiaire','$idResponsable','$idSuperviseur','$idEnseignant','$descriptionStage','$competencesRecherche','$horaireTravail','$nbreHeuresSemaine','$salaireHoraire','$dateDebut','$dateFin'); ");

	$query->execute();

}

function returnSuperviseursAndResponsables($bdd, $dataArray)
{
	$idEntreprise = intval ($dataArray[1]->value);
	$return = "";
	$query = $bdd->prepare("select concat (Prenom, ' ',  Nom) as NomEmploye, IdUtilisateur from tblEmploye where IdEntreprise like '$idEntreprise'");

	$query->execute(array());     
	$entrees = $query->fetchAll();

	foreach($entrees as $entree){
		  $NomEmploye = $entree["NomEmploye"];
		  $IdUtilisateur = $entree["IdUtilisateur"];

		  $return += '<option value= "' . $IdUtilisateur . '">' . $NomEmploye . '</option>';
	}

	echo json_encode($return);

	//json encode $return

}

?>
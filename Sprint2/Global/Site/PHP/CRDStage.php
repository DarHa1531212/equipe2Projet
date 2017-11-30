<?php

/****************************************************************************************************************
*	Nom: Hans Darmstadt-Bélanger																				*
*	Date: 01 Novembre 2017																						*
*	But: recevoir les données de création ou de modification d'un stage via un post et les entrer dans la BD 	*
*****************************************************************************************************************/

	include 'connexionBD.php'; 
	$data = $_POST ['tabValues'];
	$dataArray = (json_decode($data, false));


	$functionToExecute =intval($dataArray[0]->value) ;

	switch ($functionToExecute)
		{
		case "1": ajouterStage($bdd, $dataArray);
			break;
		case "2": return returnSuperviseursAndResponsables($bdd, $dataArray);
			break;
		case "3": return afficherInfos($bdd, $dataArray);
			break;
		}


function ajouterStage($bdd, $dataArray)
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

	   $query = $bdd->prepare("INSERT INTO tblStage (IdResponsable, IdSuperviseur, IdStagiaire, IdEnseignant, DescriptionStage, CompetenceRecherche, HoraireTravail, NbHeureSemaine, SalaireHoraire, DateDebut, DateFin ) VALUES ($idResponsable, $idSuperviseur, $idStagiaire, $idEnseignant, '$descriptionStage', '$competencesRecherche', '$horaireTravail', '$nbreHeuresSemaine', '$salaireHoraire', '$dateDebut', '$dateFin');;");
    $query->execute();
}


function returnSuperviseursAndResponsables($bdd, $dataArray)
{
	$idEntreprise = intval ($dataArray[1]->value);
	$valeurRetour = '<select id="responsableStage" name = "responsableStage" class = "infosStage">';
	$query = $bdd->prepare("select concat (Prenom, ' ',  Nom) as NomEmploye, IdUtilisateur from tblEmploye where IdEntreprise like '$idEntreprise'");

	$query->execute(array());     
	$entrees = $query->fetchAll();

	foreach($entrees as $entree){
		  $NomEmploye = $entree["NomEmploye"];
		  $IdUtilisateur = $entree["IdUtilisateur"];

		  $valeurRetour = $valeurRetour . "<option value='". $IdUtilisateur . "'>" . $NomEmploye . "</option>";
	}
$valeurRetour = $valeurRetour . '</select>';

	return $valeurRetour;


}

function afficherInfos($bdd, $dataArray)
{
	$idStage =  intval ($dataArray[1]->value);
	$returnData = array();
	$query = $bdd->prepare("select vStage.DescriptionStage as 'DescriptionStage', vStage.CompetenceRecherche as 'CompetenceRecherche', vStage.HoraireTravail as 'HoraireTravail', vStage.SalaireHoraire as 'SalaireHoraire', vStage.NbHeureSemaine as 'NbHeureSemaine' , vEntreprise.Nom as 'NomEntreprise' , concat(vStagiaire.Prenom, ' ' , vStagiaire.Nom)  as 'NomStagiaire' , concat (vSuperviseur.Prenom, ' ', vSuperviseur.Nom) as 'NomSuperviseur', concat (vResponsable.Prenom, ' ', vResponsable.Nom) as'NomResponsable', concat (vEnseignant.Prenom, ' ', vEnseignant.Nom) as 'NomEnseignant' from vStage 	left join vSuperviseur on  vSuperviseur.IdUtilisateur = vStage.IdSuperviseur 	left join vEntreprise on vEntreprise.Id = vSuperviseur.IdEntreprise     left join vStagiaire on vStagiaire.IdUtilisateur = vStage.IdStagiaire     left join vResponsable on vResponsable.IdUtilisateur = vStage.IdResponsable     left join vEnseignant on vEnseignant.IdUtilisateur = vStage.IdEnseignant where vStage.Id like :idStage");




	$query->execute(array('idStage'=> $idStage));     
	$entrees = $query->fetchAll();

	foreach($entrees as $entree){
		$DescriptionStage = $entree["DescriptionStage"];
		$CompetenceRecherche = $entree["CompetenceRecherche"];
		$HoraireTravail = $entree["HoraireTravail"];
		$SalaireHoraire = $entree["SalaireHoraire"];
		$NbHeureSemaine = $entree["NbHeureSemaine"];
		$NomEntreprise = $entree["NomEntreprise"];
		$NomStagiaire = $entree["NomStagiaire"];
		$NomSuperviseur = $entree["NomSuperviseur"];
		$NomResponsable = $entree["NomResponsable"];
		$NomEnseignant = $entree["NomEnseignant"];

		$returnData [0] = $DescriptionStage;
		$returnData [1] = $CompetenceRecherche;
		$returnData [2] = $HoraireTravail;
		$returnData [3] = $SalaireHoraire;
		$returnData [4] = $NbHeureSemaine;
		$returnData [5] = $NomEntreprise;
		$returnData [6] = $NomSuperviseur;
		$returnData [7] = $NomStagiaire;
		$returnData [8] = $NomResponsable;
		$returnData [9] = $NomEnseignant;  



	}

	return $returnData;

}




?>
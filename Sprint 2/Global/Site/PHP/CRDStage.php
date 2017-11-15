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

$idResponsable = $_POST['idResponsable'];
$idSuperviseur = $_POST['idSuperviseur'];
$idStagiaire = $_POST['idStagiaire'];
$idEnseignant = $_POST['idEnseignant'];
$descriptionStage = $_POST['descriptionStage'];
$competencesRecherche = $_POST['competencesRecherche'];
$horaireTravail = $_SESSION['horaireTravail'];
$nbreHeuresSemaine = $_SESSION['nbreHeuresSemaine'];
$salaireHoraire = $_SESSION['salaireHoraire'];
$dateDebut = $_SESSION['dateDebut'];
$dateFin = $_SESSION['dateFin'];

function ajouterStage($bdd, $idResponsable, $idSuperviseur, $idStagiaire, $idEnseignant, $descriptionStage, $competencesRecherche, $horaireTravail, $nbreHeuresSemaine, $salaireHoraire, $dateDebut, $dateFin)
{
    $query = $bdd->prepare("INSERT INTO tblStage (idResponsable, idSuperviseur, idStagiaire, idEnseignant, descriptionStage, competencesRecherche, horaireTravail, nbreHeuresSemaine, salaireHoraire, dateDebut, dateFin ) VALUES ('$idResponsable' , '$idSuperviseur' , '$idStagiaire', '$idEnseignant', '$descriptionStage', '$competencesRecherche', '$horaireTravail', '$nbreHeuresSemaine' , '$salaireHoraire', '$dateDebut', '$dateFin');");
    $query->execute();
}

ajouterStage($bdd, $idResponsable, $idSuperviseur, $idStagiaire, $idEnseignant, $descriptionStage, $competencesRecherche, $horaireTravail, $nbreHeuresSemaine, $salaireHoraire, $dateDebut, $dateFin);

?>
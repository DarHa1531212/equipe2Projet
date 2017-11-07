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


}
include 'connexionBD.php'; 

echo "accès au CRDStage";

	$data = $_POST ['tabValues'];

	$query = $bdd->prepare("INSERT INTO tblStage (idStagiaire, idEntreprise, idResponsable, idSuperviseur,  idEnseignant, descriptionStage, competencesRecherche, horaireTravail, nbreHeuresSemaine, salaireHoraire, dateDebut, dateFin ) VALUES ('$data[0]' , '$data[1]' , '$data[2]', '$data[3]', $data[4]', '$data[5]', '$data[6]', '$data[7]' , '$data[8]', '$data[9]', '$data[10]', '$data[11]');");
    $query->execute();


?>
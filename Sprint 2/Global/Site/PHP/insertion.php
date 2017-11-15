<?php

include 'connexionBD.php'; 

$query = $bdd->prepare("INSERT INTO tblStage (idStagiaire,idResponsable,idSuperviseur,idEnseignant,descriptionStage,CompetenceRecherche,horaireTravail,NbHeureSemaine,salaireHoraire,dateDebut,dateFin) VALUES (12,12,12,12,'insertionStatique','comp','plein','12','12','2017-08-11','2019-08-11');");
$query->execute();
include 'CreationStage.php';



?>
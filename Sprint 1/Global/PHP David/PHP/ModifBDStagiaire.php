<?php

include 'connexionBDTest.php';

$aNom = $_POST['nom'];
$aPrenom = $_POST['prenom'];
$aNumTelPersonnel = $_POST['numTelPersonnel'];
$aNumTelMaison = $_POST['numTelMaison'];
$aNumTelEntreprise = $_POST['numTelEntreprise'];
$aPoste = $_POST['poste'];
$aCourrielEntreprise = $_POST['courrielEntreprise'];
$aCourrielPersonnel = $_POST['courrielPersonnel'];

	try 
	{
		if($aNom != "" AND $aPrenom != "" OR $aNumTelPersonnel != "" OR $aNumTelMaison != "" OR $aNumTelEntreprise != "" OR $aPoste != "" OR $aCourrielEntreprise != "")
		{
			$sql = "UPDATE vStagiaire SET Nom = '$aNom', Prenom = '$aPrenom', NumTelPersonnel = '$aNumTelPersonnel', NumTelMaison = '$aNumTelMaison', NumTelEntreprise = '$aNumTelEntreprise', Poste = '$aPoste', CourrielEntreprise = '$aCourrielEntreprise', CourrielPersonnel = '$aCourrielPersonnel' WHERE CourrielScolaire = 'Tremblay.Olimpia@etu.cegepjonquiere.ca'";
			$bdd->query($sql);
		}
		else
		{
			echo 'Certaines informations ne correspondent pas aux critères demandés...';
		}
	} 
	catch (Exception $e) 
	{
		die('Erreur : ' .$e->getMessage());
	}

	include 'ProfilStagiaire.php';

	?> 
<?php

include 'connexionBDTest.php';

$aNumTelPersonnel = $_POST['numTelPersonnel'];
$aNumTelMaison = $_POST['numTelMaison'];
$aNumTelEntreprise = $_POST['numTelEntreprise'];
$aPoste = $_POST['poste'];
$aCourrielEntreprise = $_POST['courrielEntreprise'];
$aCourrielPersonnel = $_POST['courrielPersonnel'];
$idStagiaire = $_POST['idStagiaire'];
	try 
	{
		if($aNumTelPersonnel != "" OR $aNumTelMaison != "" OR $aNumTelEntreprise != "" OR $aPoste != "" OR $aCourrielEntreprise != "")
		{
<<<<<<< HEAD
			$sql = "UPDATE vStagiaire SET NumTelPersonnel = '$aNumTelPersonnel', NumTelMaison = '$aNumTelMaison', NumTelEntreprise = '$aNumTelEntreprise', Poste = '$aPoste', CourrielEntreprise = '$aCourrielEntreprise', CourrielPersonnel = '$aCourrielPersonnel' WHERE id = $idStagiaire";
=======
			$sql = "UPDATE vStagiaire SET NumTelPersonnel = '$aNumTelPersonnel', NumTelMaison = '$aNumTelMaison', NumTelEntreprise = '$aNumTelEntreprise', Poste = '$aPoste', CourrielEntreprise = '$aCourrielEntreprise', CourrielPersonnel = '$aCourrielPersonnel' WHERE CourrielScolaire = 'Tremblay.Olimpia@etu.cegepjonquiere.ca'";
>>>>>>> 2eab736c45c47d1d130320a4d72aea76897f0b6d
			$bdd->query($sql);
			include 'ProfilStagiaire.php';
		}
		else
		{
			?><script>alert("Les informations ne correspondent pas aux critères demandées...")</script><?php
		}
	} 
	catch (Exception $e) 
	{
		die('Erreur : ' .$e->getMessage());
	}

?> 
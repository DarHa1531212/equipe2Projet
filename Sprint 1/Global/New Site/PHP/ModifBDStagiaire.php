<?php

include 'ConnexionBD.php';

$aNumTelPersonnel = $_POST['NumTelPersonnel'];
$aNumTelMaison = $_POST['NumTelMaison'];
$aNumTelEntreprise = $_POST['NumTelEntreprise'];
$aPoste = $_POST['Poste'];
$aCourrielEntreprise = $_POST['CourrielEntreprise'];
$aCourrielPersonnel = $_POST['CourrielPersonnel'];
$idStagiaire = $_POST['IdStagiaire'];
	try 
	{
		if($aNumTelPersonnel != "" OR $aNumTelMaison != "" OR $aNumTelEntreprise != "" OR $aPoste != "" OR $aCourrielEntreprise != "")
		{
			$sql = "UPDATE vStagiaire SET NumTelPersonnel = '$aNumTelPersonnel', NumTelMaison = '$aNumTelMaison', NumTelEntreprise = '$aNumTelEntreprise', Poste = '$aPoste', CourrielEntreprise = '$aCourrielEntreprise', CourrielPersonnel = '$aCourrielPersonnel' WHERE id = $idStagiaire";

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
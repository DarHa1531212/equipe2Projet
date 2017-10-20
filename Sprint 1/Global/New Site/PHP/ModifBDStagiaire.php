<?php

include 'ConnexionBD.php';

$aNumTelPersonnel = $_REQUEST['NumTelPersonnel'];
$aNumTelMaison = $_REQUEST['NumTelMaison'];
$aNumTelEntreprise = $_REQUEST['NumTelEntreprise'];
$aPoste = $_REQUEST['Poste'];
$aCourrielEntreprise = $_REQUEST['CourrielEntreprise'];
$aCourrielPersonnel = $_REQUEST['CourrielPersonnel'];
$idStagiaire = $_REQUEST['IdStagiaire'];
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
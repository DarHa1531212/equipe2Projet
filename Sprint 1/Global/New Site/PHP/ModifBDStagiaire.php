<?php

include 'ConnexionBD.php';

$aNumTelMaison = $_REQUEST['NumTel'];
$aNumTelEntreprise = $_REQUEST['NumTelEntreprise'];
$aPoste = $_REQUEST['Poste'];
$aCourrielEntreprise = $_REQUEST['CourrielEntreprise'];
$aCourrielPersonnel = $_REQUEST['CourrielPersonnel'];
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
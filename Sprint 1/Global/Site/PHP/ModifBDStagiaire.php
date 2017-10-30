<?php
session_start();
include 'ConnexionBD.php';

$aNumTelPersonnel = $_POST['numTelPersonnel'];
$aNumTelEntreprise = $_POST['numTelEntreprise'];
$aPoste = $_POST['poste'];
$aCourrielEntreprise = $_POST['courrielEntreprise'];
$aCourrielPersonnel = $_POST['courrielPersonnel'];
$newPassword = $_POST['newPwd'];
$idStagiaire = $_SESSION['idConnecte'];
	try 
	{
		if($aNumTelPersonnel != "" OR $aNumTelEntreprise != "" OR $aPoste != "" OR $aCourrielEntreprise != "")
		{
			$query = $bdd->prepare("UPDATE vStagiaire SET NumTel = '$aNumTelPersonnel', NumTelEntreprise = '$aNumTelEntreprise', Poste = '$aPoste', CourrielEntreprise = '$aCourrielEntreprise', CourrielPersonnel = '$aCourrielPersonnel' WHERE IdUtilisateur = :idStagiaire");
			$query->execute(array('idStagiaire'=>$idStagiaire));
			
			include 'hash.php';
			SetPassword ($newPassword, $bdd);

			include 'Profil.php';
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
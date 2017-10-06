<?php
	include 'connexionBDTest.php';
	//$userName = $_POST['email'];
	//include 'ici le php pour savoir quel utilisateur c'est connecter 
	$user = 'Stagiaire';

	session_start(); //Démarrage de la session NB. toujours l'écrire avant la balise DOCTYPE HTML

	if($user == 'Stagiaire')
	{
		$_POST['idStagiaire'] = 1;
		include 'vProfilStagiaire.php';
		$_SESSION['PrenomConnecte'] = $prenomStagiaire;
		$_SESSION['NomConnecte'] = $prenomStagiaire;
		$_SESSION['PrenomStag'] = $prenomStagiaire;
		$_SESSION['NomStag'] = $nomStagiaire;
		$_SESSION['NumTelMaisonStag'] = $numTelMaisonStagiaire;
		$_SESSION['NumTelPersonnelStag'] = $numTelPersonnelStagiaire;
		$_SESSION['CourrielPersonnelStag'] = $courrielPersonnelStagiaire;
		$_SESSION['NumTelEntrepriseStag'] = $numTelEntrepriseStagiaire;
		$_SESSION['PosteStag'] = $posteStagiaire;
		$_SESSION['CourrielEntrepriseStag'] = $courrielEntrepriseStagiaire;
		$_SESSION['CourrielScolaireStag'] = $courrielScolaireStagiaire;
	}
	else
	{
		if($user == 'Superviseur')
		{

		}
	}
?>
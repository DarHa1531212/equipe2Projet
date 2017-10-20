<?php
	include 'connexionBD.php';
	//$userName = $_POST['email'];
	//include 'ici le php pour savoir quel utilisateur c'est connecter 
	$user = 'Stagiaire';

	session_start(); //Démarrage de la session NB. toujours l'écrire avant la balise DOCTYPE HTML

	$_SESSION['PrenomConnecte'] = $prenomStagiaire;
	$_SESSION['NomConnecte'] = $nomStagiaire; //Pt que ce sera a changer quand la connexion sera active avec la sécurité et la hashage de mdp...
	
	if($user == 'Stagiaire')
	{
		$_POST['idStagiaire'] = 2;
		$_SESSION['idConnecter'] = $_POST['idStagiaire'];
		include 'vProfilStagiaire.php';
		//$_SESSION['PrenomStag'] = $prenomStagiaire;
		//$_SESSION['NomStag'] = $nomStagiaire;
		//$_SESSION['NumTelMaisonStag'] = $numTelMaisonStagiaire;
		//$_SESSION['NumTelPersonnelStag'] = $numTelPersonnelStagiaire;
		//$_SESSION['CourrielPersonnelStag'] = $courrielPersonnelStagiaire;
		//$_SESSION['NumTelEntrepriseStag'] = $numTelEntrepriseStagiaire;
		//$_SESSION['PosteStag'] = $posteStagiaire;
		//$_SESSION['CourrielEntrepriseStag'] = $courrielEntrepriseStagiaire;
		//$_SESSION['CourrielScolaireStag'] = $courrielScolaireStagiaire;
	}
	else
	{
		if($user == 'Superviseur')
		{

		}
	}
?>
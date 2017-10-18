<?php //recherche de connexion dans la bd
	session_start();
	include 'ConnexionBD.php';

	$query = $bdd->prepare("SELECT * FROM vUtilisateur WHERE Courriel = :username");
	$query->execute(array('username'=>$username));
	$connecte = $query->fetchAll();

	foreach ($connecte as $user) 
	{
		$_SESSION['idConnecte'] = $user['Id'];
	}

	$query = $bdd->prepare("SELECT *
							FROM vRole AS Role 
							LEFT JOIN vUtilisateurRole AS utilRole 
								ON utilRole.IdRole = Role.Id 
							WHERE utilRole.IdUtilisateur = :idConnecte");
	$query->execute(array('idConnecte'=>$_SESSION['idConnecte']));
	$connecte = $query->fetchAll();

	foreach ($connecte as $user) 
	{
		$_SESSION['roleConnecte'] = $user['Titre'];
	}

	//switch($_SESSION[''])
	if($_SESSION['roleConnecte'] == "Stagiaire")
	{
		$query = $bdd->prepare("SELECT * FROM vStagiaire WHERE IdUtilisateur = :id");
		$query->execute(array('id'=>$_SESSION['idConnecte']));
		$connecte = $query->fetchAll();

		foreach ($connecte as $user)
		{
			$_SESSION['PrenomConnecte'] = $user['Prenom'];
			$_SESSION['NomConnecte'] = $user['Nom'];
		}

		include 'TableauBordStagiaire.php';
	}
	else
	{
		
	}
?>
<?php //recherche de connexion dans la bd
	session_start();
	include 'connexionBD.php';

	$query =  $bdd->prepare("SELECT * FROM vStagiaire WHERE CourrielScolaire = '$_SESSION['Username']'");
	$query->execute(array());
	$result = $query->fetchAll();


	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$_SESSION['PrenomConnecte'] = $row['Prenom'];
			$_SESSION['NomConnecte'] = $row['Nom'];
			$_SESSION['idConnecte'] = $row['Id'];
			$_SESSION['RoleConnecte'] = "Stagiaire";
			
			include'TableauBordStagiaire.php';
		}
	}
	else
	{
		$query =  $bdd->prepare("SELECT * FROM vEmployeEntreprise WHERE CourrielEntreprise = '$_SESSION['Username']'");
	    $query->execute(array());
		$result = $query->fetchAll();


		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$_SESSION['PrenomConnecte'] = $row['Prenom'];
				$_SESSION['NomConnecte'] = $row['Nom'];
				$_SESSION['idConnecte'] = $row['Id'];
				$_SESSION['RoleConnecte'] = "Entreprise";
				include 'TBEntreprise.php';
			}
		}
		else
		{
			echo 'Connexion incorrect!';
		}
	} //Le mot de passe devra etre verifier a quelque part dsans ce fichier pour etre sur que la personne ce doit bien connecter
?>
<?php //recherche de connexion dans la bd
	session_start();
	include 'connexionBD.php';
    
	$query = $bdd->prepare("SELECT * FROM vStagiaire WHERE CourrielScolaire = :username");
    $query->execute(array('username'=>$username));
	$result = $query->fetchAll();

	if($result != null)
	{
		foreach($result as $stagiaire)
		{
			$_SESSION['PrenomConnecte'] = $stagiaire['Prenom'];
			$_SESSION['NomConnecte'] = $stagiaire['Nom'];
			$_SESSION['idConnecte'] = $stagiaire['Id'];
			$_SESSION['RoleConnecte'] = "Stagiaire";
			include'TableauBordStagiaire.php';
		}
	}
	else
	{
		$query = "SELECT * FROM vEmployeEntreprise WHERE CourrielEntreprise = '$username'";
		$result = $bdd->query($query);

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
<?php

<<<<<<< HEAD
    $id = $_SESSION['idConnecte'];
=======
    $id = $_POST["idStagiaire"];
>>>>>>> 2eab736c45c47d1d130320a4d72aea76897f0b6d
	$sql = "SELECT * FROM vStagiaire WHERE Id=$id";//Query de la vue Stagiaire
	$result = $bdd->query($sql);

	if($result->num_rows > 0) //Permet de voir s'il y a des résultats.
	{
		while($row = $result->fetch_assoc()) //Boucle qui va chercher automatiquement le stagiaire
		{
            $idStagiaire = $id;
			$prenomStagiaire = $row["Prenom"]; //Initialisation des variables a afficher dans les balises de la page profil.
			$nomStagiaire = $row["Nom"];
			$numTelMaisonStagiaire = $row["NumTelMaison"];
			$numTelPersonnelStagiaire = $row["NumTelPersonnel"];
			$courrielPersonnelStagiaire = $row["CourrielPersonnel"];
			$numTelEntrepriseStagiaire = $row["NumTelEntreprise"];
			$posteStagiaire = $row["Poste"];
			$courrielEntrepriseStagiaire = $row["CourrielEntreprise"];
			$courrielScolaireStagiaire = $row["CourrielScolaire"];
		}
	}
	else
	{
		?><script>alert("Le stagiaire n'a pas été trouvé...");</script><?php //Renvoi un alerte que le stagiaire n'a pas été trouvé.
	}

?>
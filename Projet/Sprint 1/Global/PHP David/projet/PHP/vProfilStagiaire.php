<?php

	$sql = "SELECT Prenom, Nom, NumTelMaison, NumTelPerosnnel, CourrielPersonnel, NumTelEntreprise, Poste, CourrielEntreprise FROM vStagiaire WHERE /*champs a chercher pour le stagiaire*/ = /*Stagiaire connecté*/"; //Query de la vue Stagiaire
	$result = $bdd->query($sql);

	if($result->num_rows > 0) //Permet de voir s'il y a des résultats.
	{
		while($row = $result->fetch_assoc()) //Boucle qui va chercher automatiquement le stagiaire
		{
			$prenom = $row["Prenom"]; //Initialisation des variables a afficher dans les balises de la page profil.
			$nom = $row["nom"];
			$numTelMaison = $row["NumTelMaison"];
			$numTelPersonnel = $row["NumTelPerosnnel"];
			$courrielPersonnel = $row["CourrielPersonnel"];
			$numTelEntreprise = $row["NumTelEntreprise"];
			$poste = $row["Poste"];
			$courrielEntreprise = $row["CourrielEntreprise"];
		}
	}
	else
	{
		?><script>alert("Le stagiaire n'a pas été trouvé...");</script><?php //Renvoi un alerte que le stagiaire n'a pas été trouvé.
	}

?>
<?php

	$sql = "SELECT Prenom, Nom, NumTelCell, CourrielPersonnel, NumTelEntreprise, Poste, CourrielEntreprise FROM vEmployeEntreprise WHERE CourrielEntreprise = 'Sophisticated@entreprise.com'";//Query de la vue employe
	$result = $bdd->query($sql);

	if($result->num_rows > 0) //Permet de voir s'il y a des résultats.
	{
		while($row = $result->fetch_assoc()) //Boucle qui va chercher automatiquement le employe.
		{
			//$logo = $row["Logo"];
			$prenom = $row["Prenom"]; //Initialisation des variables a afficher dans les balises.
			$nom = $row["nom"];
			//$nomEntreprise = $row["NomEntreprise"];
			$numTelCell = $row["NumTelCell"];
			$courrielPersonnel = $row["CourrielPersonnel"];
			$numTelEntreprise = $row["NumTelEntreprise"];
			$poste = $row["Poste"];
			$courrielEntreprise = $row["CourrielEntreprise"];
		}
	}
	else
	{
		?><script>alert("Le superviseur n'a pas été trouvé...");</script><?php //Renvoi un alerte que le employe n'a pas été trouvé.
	}

?>
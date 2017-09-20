<?php

	$sql = "SELECT Prenom, Nom, NumTelCell, CourrielPersonnel, NumTelEntreprise, Poste, CourrielEntreprise FROM vEmployeEntreprise WHERE CourrielEntreprise = 'Sophisticated@entreprise.com'";//Query de la vue employe
	$result = $bdd->query($sql);

	if($result->num_rows > 0) //Permet de voir s'il y a des résultats.
	{
		while($row = $result->fetch_assoc()) //Boucle qui va chercher automatiquement le employe.
		{
			//$logo = $row["Logo"];
			$prenomSup = $row["Prenom"]; //Initialisation des variables a afficher dans les balises.
			$nomSup = $row["Nom"];
			//$nomEntrepriseSup = $row["NomEntreprise"];
			$numTelCellSup = $row["NumTelCell"];
			$courrielPersonnelSup = $row["CourrielPersonnel"];
			$numTelEntrepriseSup = $row["NumTelEntreprise"];
			$posteSup = $row["Poste"];
			$courrielEntrepriseSup = $row["CourrielEntreprise"];
		}
	}
	else
	{
		?><script>alert("Le superviseur n'a pas été trouvé...");</script><?php //Renvoi un alerte que le employe n'a pas été trouvé.
	}

?>
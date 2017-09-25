<?php

	$sql = "SELECT Logo, Nom, NumTel, CourrielEntreprise, NumCivique, Rue, Ville, Province FROM vEmployeEntreprise WHERE Nom = /*Entreprise connecté*/";//Query de la vue entreprise
	$result = $bdd->query($sql);

	if($result->num_rows > 0) //Permet de voir s'il y a des résultats.
	{
		while($row = $result->fetch_assoc()) //Boucle qui va chercher automatiquement le entreprise.
		{
			$logo = $row["Logo"]; //Initialisation des variables a afficher dans les balises.
			$nom = $row["Nom"]; //Nom de l'entreprise.
			$numTel = $row["NumTel"];
			$courrielEntreprise = $row["CourrielEntreprise"];
			$numCivique = $row["NumCivique"];
			$rue = $row["Rue"];
			$ville = $row["Ville"];
			$province = $row["Province"];
		}
	}
	else
	{
		?><script>alert("L'entreprise n'a pas été trouvé...");</script><?php //Renvoi un alerte que l'entreprise n'a pas été trouvé.
	}
?>
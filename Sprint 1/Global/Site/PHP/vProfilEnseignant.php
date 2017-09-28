<?php
    
    $id = $_POST["idEnseignant"];

	$sql = "SELECT * FROM vEmployeCegep WHERE Id = $id";//Query de la vue employe
	$result = $bdd->query($sql);

	if($result->num_rows > 0) //Permet de voir s'il y a des résultats.
	{
		while($row = $result->fetch_assoc()) //Boucle qui va chercher automatiquement le employe.
		{
			$prenom = $row["Prenom"]; //Initialisation des variables a afficher dans les balises.
			$nom = $row["Nom"];
			$numTelCell = $row["NumTelCell"];
			$courrielPersonnel = $row["CourrielPersonnel"];
			$courrielCegep = $row["CourrielCegep"];
            $codePermanent = $row["CodePermanent"];
		}
	}
	else
	{
		?><script>alert("Le superviseur n'a pas été trouvé...");</script><?php //Renvoi un alerte que le employe n'a pas été trouvé.
	}

?>
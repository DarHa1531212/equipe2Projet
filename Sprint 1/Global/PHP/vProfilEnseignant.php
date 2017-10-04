<?php
    
    $id = $_POST["idProf"];

	$sql = "SELECT * FROM vEmployeCegep WHERE Id=$id";//Query de la vue Stagiaire
	$result = $bdd->query($sql);

	if($result->num_rows > 0) //Permet de voir s'il y a des résultats.
	{
		while($row = $result->fetch_assoc()) //Boucle qui va chercher automatiquement le stagiaire
		{
            $prenom = $row["Prenom"];
			$nom = $row["Nom"];
            $numTelPerso = $row["NumTelCell"];
            $courrielPerso = $row["CourrielPersonnel"];
            $codePermanent = $row["CodePermanent"];
            $courrielProf = $row["CourrielCegep"];
		}
	}
	else
	{
		?><script>alert("Le stagiaire n'a pas été trouvé...");</script><?php //Renvoi un alerte que le stagiaire n'a pas été trouvé.
	}
?>
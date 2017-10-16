<?php
    
<<<<<<< HEAD
    if(!isset($_POST['idSuperviseur']))
    {
    	$id = $_SESSION['idConnecte'];
    }
    else
    {
    	$id = $_POST["idSuperviseur"];
    }

=======
    $id = $_POST["idSuperviseur"];
>>>>>>> 2eab736c45c47d1d130320a4d72aea76897f0b6d
	$sql = "SELECT Prenom, Emp.Nom, Ent.Nom AS 'Nom Entreprise', NumTelCell, CourrielPersonnel, NumTelEntreprise, Poste, Emp.CourrielEntreprise
            FROM vEmployeEntreprise AS Emp
            JOIN vEntreprise AS Ent
            ON Emp.IdEntreprise = Ent.Id
            WHERE Emp.Id = $id";//Query de la vue employe
	$result = $bdd->query($sql);

	if($result->num_rows > 0) //Permet de voir s'il y a des résultats.
	{
		while($row = $result->fetch_assoc()) //Boucle qui va chercher automatiquement le employe.
		{
			//$logo = $row["Logo"];
			$prenomSup = $row["Prenom"]; //Initialisation des variables a afficher dans les balises.
			$nomSup = $row["Nom"];
			$nomEntrepriseSup = $row["Nom Entreprise"];
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
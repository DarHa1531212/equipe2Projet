<?php //recherche de connexion dans la bd


	foreach ($connecte as $user) 
	{
		$_SESSION['idConnecte'] = $user['Id'];
	}

	if (Login($username, $MDP, $bdd))
	{
		switch ($_SESSION['IdRole'])
		{
			case 1: //case 1 is an administrator
					echo "I am a teacher";
			break;

			case 2: //case 2 is a Responsible
					//add employeID to session variable
					header("Location: TBEntreprise.php");
			break;

			case 3: //case 3 is a Teacher
					echo "I am a teacher";
			break;

			case 4:
					$query = $bdd->prepare("SELECT * FROM vEmploye WHERE IdUtilisateur = :id");
					header("Location: TBEntreprise.php");
					break;

			case 5: //case 5 is an intern
					$query = $bdd->prepare("SELECT * FROM vStagiaire WHERE IdUtilisateur = :id");
					header("Location: TableauBordStagiaire.php");
					break;

			default: echo "error unknown IdRole";
		}

		$query->execute(array('id'=>$_SESSION['idConnecte']));
        $connecte = $query->fetchAll();
 
        foreach ($connecte as $user)
        {
             $_SESSION['PrenomConnecte'] = $user['Prenom'];
             $_SESSION['NomConnecte'] = $user['Nom'];
        }
  }
  else
  {
    header("Location: /equipe2Projet/Sprint%201/Global/Site/");
  }
 
?>
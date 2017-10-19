<?php //recherche de connexion dans la bd

	$query = $bdd->prepare("SELECT * FROM vUtilisateur WHERE Courriel = :username");
	$query->execute(array('username'=>$username));
	$connecte = $query->fetchAll();

	//Vérif mdp ajout d'un if LALA

	foreach ($connecte as $user) 
	{
		$_SESSION['idConnecte'] = $user['Id'];
	}

	//switch($_SESSION[''])
	if (Login($username, $MDP, $bdd))
	{
		switch ($_SESSION['IdRole'])
		{
			case 1:
			//call page using header("Location: path");
			echo "I am a teacher";
			break;

			case 2:
			header("Location: TBEntreprise.php");
			break;

			case 3:
			//call page using header("Location: path");
			echo "I am a teacher";
			break;

			case 4:
			header("Location: TBEntreprise.php");
			//call page using header("Location: path");
			break;

			case 5:
					$query = $bdd->prepare("SELECT * FROM vStagiaire WHERE IdUtilisateur = :id");
					header("Location: TableauBordStagiaire.php");

			//call page using header("Location: path");
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
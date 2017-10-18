<?php
	session_start();
	include 'ConnexionBD.php';
	include 'hash.php';
	$username = $_POST['Username'];
	$MDP = $_POST['Password'];p

	/*try
	{
		include 'Recherche.php';
	}
	catch(Exception $e){echo "HO NO " . $e;}
*/
	if (Login ($username, $MDP, $bdd) ==  true)
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
					header("Location: TableauBordStagiaire.php");

			//call page using header("Location: path");
			break;

			default: echo "error unknown IdRole";
		}


		

	}
	else
	{
		header("Location: /Site");
	}
?>
<?php
	session_start();
	include 'ConnexionBD.php';
	include 'hash.php';
	$username = $_POST['Username'];
	$MDP = $_POST['Password'];

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
			break;

			case 2:
			//call page using header("Location: path");
			break;

			case 3:
			//call page using header("Location: path");
			break;

			case 4:
			//call page using header("Location: path");
			break;

			case 5:
			//call page using header("Location: path");
			break;

			default: echo "error unknown IdRole";
	}


		}

		header("Location: TableauBordStagiaire.php");
	}
	else
	{
		header("Location: /Site");
	}
?>
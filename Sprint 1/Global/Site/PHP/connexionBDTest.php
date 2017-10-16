<?php
	try
	{
<<<<<<< HEAD
		$bdd = new mysqli("dicj.info","cegepjon_p2017_2","madfpfadshdb","cegepjon_p2017_2_tests"); //Connexion a la bd au serveur.
        $bdd->set_charset("utf8");
=======
		$bdd = new mysqli("dicj.info","cegepjon_p2017_2","madfpfadshdb","cegepjon_p2017_2_prod"); //Connexion a la bd au serveur.
>>>>>>> 2eab736c45c47d1d130320a4d72aea76897f0b6d
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
?>
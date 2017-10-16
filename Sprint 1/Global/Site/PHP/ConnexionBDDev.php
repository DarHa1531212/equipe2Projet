<?php
	try
	{
		$bdd = new mysqli("dicj.info","cegepjon_p2017_2","madfpfadshdb","cegepjon_p2017_2_dev"); //Connexion a la bd au serveur.
        $bdd->set_charset("utf8");
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
?>
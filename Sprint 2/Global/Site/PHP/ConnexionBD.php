<?php
	try
	{
        $bdd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_dev', 'cegepjon_p2017_2', 'madfpfadshdb' ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        // $bdd = new PDO('mysql:host=localhost;dbname=BDProjet_equipe2V2', 'root', '' ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

        //BD locale Hans
        //$bdd = new PDO('mysql:host=localhost;dbname=cegepjon_p2017_2_dev', 'root', '' ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}

	catch(Exception $e)
	{
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=BDProjet_equipe2V2', 'root', '' ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        catch(Exception $e)
        {
            die('Erreur : ' .$e->getMessage());
        }
	}
?>
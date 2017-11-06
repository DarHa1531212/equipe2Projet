<?php
	try
	{
<<<<<<< HEAD
        $bdd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_dev', 'cegepjon_p2017_2', 'madfpfadshdb' ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        //$bdd = new PDO('mysql:host=localhost;dbname=BDProjet_equipe2V2', 'root', '' ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
=======
        //$bdd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_dev', 'cegepjon_p2017_2', 'madfpfadshdb' ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        $bdd = new PDO('mysql:host=localhost;dbname=BDProjet_equipe2V2', 'root', '' ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
>>>>>>> f919533d5dcf2dba0255e78eeaae3b5a83a12642
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
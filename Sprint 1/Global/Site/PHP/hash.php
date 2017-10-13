
<?php

 try{
    $bdd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_prod;', 'cegepjon_p2017_2', 'madfpfadshdb'/*array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')*/);
    $bdd->exec("SET NAMES 'utf8';");
    }
    catch(Exception $e)
    {
    	die('Erreur : ' .$e->getMessage());
    }


$mdpHashe = password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
echo $mdpHashe;

if (password_verify('rasmuslerdorf', $mdpHashe)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

void SetPassword ($userEmail, $password)
{

}

void Login ($userEmail, $password)
{
	$query = $bdd->prepare("SELECT Dates AS DateComplete FROM vJournalDeBord WHERE IdStagiaire LIKE $idStagiaire ORDER BY datecomplete DESC LIMIT 1;");


}

?>

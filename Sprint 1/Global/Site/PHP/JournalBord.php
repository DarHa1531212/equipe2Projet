<?php
try
{
    $bdd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_prod', 'cegepjon_p2017_2', 'madfpfadshdb',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $bdd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_tests', 'cegepjon_p2017_2', 'madfpfadshdb',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch(Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}

if(isset($_POST["idStagiaire"]))
    $idStagiaire = $_POST["idStagiaire"];

$date = date('Y-m-d h:i:s', time());
$stringShowAll = "false";
	
//si la page a été appelée pour insérer une entrée 
if ( !empty($_POST['contenu']) )  
    {
       	$entree = array();
        $entree = array(htmlspecialchars($_POST['contenu']));
        $text = $entree[0];

        if ($text != "")
        {
            $query = $bdd->prepare("INSERT INTO tblJournalDeBord (Entree, idStagiaire, Dates) VALUES (:text, :id,'$date');");
            $query->bindValue( 'text', $text, PDO::PARAM_STR );
            $query->bindValue( 'id', $idStagiaire, PDO::PARAM_INT);
            $query->execute();
        }
    }
//si la page a été appelée pour afficher toutes les entrées
if ( !empty($_POST['afficher']))
    {
       	$showAll = array();
        $showAll = array($_POST['afficher']);
        $stringShowAll = $showAll[0];
    }
             	
if ($stringShowAll == "true")
    include ('JournalBordShow=ALL.php');
else
    include ('JournalBord2.php');

?>
<?php

include 'ConnexionBD.php';

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
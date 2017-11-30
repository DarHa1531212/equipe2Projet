<?php

include 'ConnexionBD.php';
include 'Session.php';

if($_SESSION['IdRole'] == '5')
{
    $idStagiaire = $_SESSION['idConnecte'];
}
else
{
    //mettre ici la personne qui s'occupera de consulter le journal de bord stagiaire mais ne pourra en aucun cas le modifier.
}

$date = date('Y-m-d h:i:s', time());
$stringShowAll = "false";
	
//si la page a été appelée pour insérer une entrée 
if ( !empty($_POST['contenu']) )  
    {
        include 'UploadFile.php';
       	$entree = array();
        $entree = array(htmlspecialchars($_POST['contenu']));
        $text = $entree[0];

        if($verif)
        {
            if ($text != "" && isset($_FILES['fichier']) && $_FILES['fichier']['name'] != "")
            {
                $query = $bdd->prepare("INSERT INTO tblJournalDeBord (Entree, idStagiaire, Dates, Documents) VALUES (:text, :id,'$date', :file);");
                $query->bindValue( 'text', $text, PDO::PARAM_STR );
                $query->bindValue( 'id', $idStagiaire, PDO::PARAM_INT);
                $query->bindValue( 'file', $fichier, PDO::PARAM_STR);
                $query->execute();
            }
            else
            {
                if($text != "")
                {
                    $query = $bdd->prepare("INSERT INTO tblJournalDeBord (Entree, idStagiaire, Dates) VALUES (:text, :id,'$date');");
                    $query->bindValue( 'text', $text, PDO::PARAM_STR );
                    $query->bindValue( 'id', $idStagiaire, PDO::PARAM_INT);
                    $query->execute();
                }
            }
        }
        else
        {
            //$_SESSION['textJournal'] = $text;
            ?><script>alert("Test concluant");</script><?php
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
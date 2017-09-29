

<?php

$date = date('Y-m-d h:i:s', time());
$stringShowAll = "false";
$link = mysqli_connect("dicj.info", "cegepjon_p2017_2", "madfpfadshdb", "cegepjon_p2017_2_tests");
if (mysqli_connect_errno()) {
		/* check connection */
        printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
    }
	
   //si la page a été appelée pour insérer une entrée 
if ( !empty($_POST['contenu']) )  
    {
       	$entree = array();
        $entree = array(htmlspecialchars($_POST['contenu']));
        $text = mysqli_real_escape_string($link, $entree[0]);
        if ($text != "")
            mysqli_query($link, "INSERT into tblJournalDeBord (	Entree	, idStagiaire, Dates  ) VALUES ('$text', 17, '$date');");

    }
//si la page a été appelée pour afficher toutes les entrées
if ( !empty($_POST['afficher']) ) 
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


<?php
$host="dicj.info";
$user="cegepjon_p2017_2";
$password="madfpfadshdb";
$dbname="cegepjon_p2017_2_tests";
$date = date('Y-m-d h:i:s', time());
$stringShowAll = "false";
$con = new mysqli($host, $user, $password, $dbname)
                            or die ('Could not connect to the database server' . mysqli_connect_error());
	
   //si la page a été appelée pour insérer une entrée 
if ( !empty($_POST['contenu']) )  
    {
       	$entree = array();
        $entree = array(htmlspecialchars($_POST['contenu']));
        $text = mysqli_real_escape_string($con, $entree[0]);
        echo $text;
        if ($text != "")
        {
            $query = "INSERT into vJournalDeBord (  Entree  , idStagiaire, Dates  ) VALUES ('$text', 17, '$date');";
            $con->query($query);
        }

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
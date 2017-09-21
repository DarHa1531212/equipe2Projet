

<?php
$entree = array();


$entree = array(htmlspecialchars($_POST['contenu']));
    	$date = date('Y-m-d h:i:s', time());

	try
	{
		//                        Hôte/serever        nom de bd                          nom de connexion    mot de passe
		$bdd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_tests;charset=utf8','cegepjon_p2017_2','madfpfadshdb');
         // $sql = "INSERT INTO tblJournalDeBord (Entree) VALUES (" . $entree[0] . ");";
         $sql = "INSERT INTO 
         tblJournalDeBord (Entree,IdStagiaire, Dates ) VALUES ('" . $entree[0] . "',17,'". $date.  "');";
         $bdd->exec($sql);          
    }
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
    

/*
$link = mysqli_connect("host=dicj.info", "cegepjon_p2017_2", "madfpfadshdb", "cegepjon_p2017_2_tests");
if(mysqli_query($link, $sql)){

    echo "Records inserted successfully.";

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

}*/


include ('JournalBord2.php');
?>
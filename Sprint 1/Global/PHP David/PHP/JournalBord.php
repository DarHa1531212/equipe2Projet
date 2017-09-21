

<?php
$entree = array();


//$entree = array(htmlspecialchars($_POST['contenu']));
$textContinu = "";

/*

$i = 0;
while(isset($entree[$i]))
{
   
    echo $entree[$i];
    $textContinu += $entree[$i];
    echo $textContinu;
    $i++;
    
    echo "la boucle a rou;ée";
}
echo "voici texte continu";?></br><?php
echo $textContinu;

*/

	try
	{
		//                        Hôte/serever        nom de bd                          nom de connexion    mot de passe
		$bdd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_tests;charset=utf8','cegepjon_p2017_2','madfpfadshdb');
    
         // $sql = "INSERT INTO tblJournalDeBord (Entree) VALUES (" . $entree[0] . ");";
         $sql = "INSERT INTO tblJournalDeBord (Entree) VALUES ('" . $entree[0] . "');";
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


include ('JournalBord.php');
?>
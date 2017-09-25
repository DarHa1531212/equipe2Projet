

<?php



	$entree = array();
	$entree = array(htmlspecialchars($_POST['contenu']));
	$date = date('Y-m-d h:i:s', time());
    $link = mysqli_connect("dicj.info", "cegepjon_p2017_2", "madfpfadshdb", "cegepjon_p2017_2_tests");

		/* check connection */
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
		
		$text = mysqli_real_escape_string($link, $entree[0]);
    	//$text = str_replace("\n", "<br/>", $text);
    	/* this query with escaped $city will work */




mysqli_query($link, "INSERT into tblJournalDeBord (	Entree	, idStagiaire, Dates  ) VALUES ('$text', 17, '$date');");
/*
$link = mysqli_connect("host=dicj.info", "cegepjon_p2017_2", "madfpfadshdb", "cegepjon_p2017_2_tests");
if(mysqli_query($link, $sql)){

    echo "Records inserted successfully.";

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

}*/


include ('JournalBord2.php');
?>
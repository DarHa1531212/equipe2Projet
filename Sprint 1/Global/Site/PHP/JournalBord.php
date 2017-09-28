

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



if ($text != "")
mysqli_query($link, "INSERT into tblJournalDeBord (	Entree	, idStagiaire, Dates  ) VALUES ('$text', 17, '$date');");


include ('JournalBord2.php');
?>
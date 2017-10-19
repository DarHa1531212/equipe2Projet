<?php
	$username = $_POST['Username'];
	$MDP = $_POST['Password'];

	try
	{
		include 'Recherche.php';
	}
	catch(Exception $e){echo "HO NO " . $e;}
?>
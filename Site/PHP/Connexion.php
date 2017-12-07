<?php
	session_start();
	$username = $_POST['Username'];
	$MDP = $_POST['Password'];
	require 'ConnexionBD.php';
	include 'hash.php';
	
	try
	{
		include 'Recherche.php';
	}
	
	catch(Exception $e){echo "HO NO " . $e;}
	
?>
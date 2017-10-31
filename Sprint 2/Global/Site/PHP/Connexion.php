<?php
	session_start();
	if(!isset($_SESSION['Username']))
	{
		$_SESSION['Username'] = $_POST['Username'];
		$_SESSION['MDP'] = $_POST['Password'];
	}
	include 'ConnexionBD.php';
	include 'hash.php';
	
	try
	{
		include 'Recherche.php';
	}
	catch(Exception $e){echo "HO NO " . $e;}
	
?>
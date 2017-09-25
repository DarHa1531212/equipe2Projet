<?php
	$stagiaire = $_POST['Username'];
	$MDP = $_POST['Password'];

	try
	{
		if($stagiaire == 'Tremblay.Olimpia@etu.cegepjonquiere.ca' && $MDP == 'Timartin')
		{
			include 'TableauBordStagiaire.php';
		}
		else
		{
			echo 'Roger pas content!';
		}
	}
	catch(Exception $e){}
?>
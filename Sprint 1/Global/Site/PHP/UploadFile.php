<?php

	if(isset($_FILES['fichier']))
	{
		$dossier = '../Upload/';
		$fichier = basename($_FILES['fichier']['name']);
		$tailleMax = 2000000;
		$taille = filesize($_FILES['fichier']['tmp_name']);
		$extensions = array('.png','.jpg','.jpeg','.docx','.pdf');
		$extension = strchr($_FILES['fichier']['name'],'.');



		if(!in_array($extension, $extensions))
		{
			//Ne prend pas ce type de fichier
		}

		if($taille > $tailleMax)
		{
			//Le fichier est trop volumineux...
		}

		$verif = verificationDoublon($bdd, $fichier);

		if(!isset($erreur) && $verif) //S'il n'y a pas d'erreur
		{
			$fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			$fichier = preg_replace('/([^.a-z0-9]+)/i','-', $fichier);
			if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier))
			{
				echo'Upload Success';
			}
			else
			{
				echo'Roger pas content';
			}
		}
	}

	function verificationDoublon($bdd, $fichier)
	{
		$query = $bdd->prepare("SELECT Documents FROM vJournalDeBord");
		$query->execute();
		$files = $query->fetchAll();

		foreach($files as $file)
		{
			$doc = $file['Documents'];
			if($doc == $fichier)
			{
				$doublon = true;
				break;
			}
			else
			{
				$doublon = false;
			}
		}

		if(!$doublon)
		{
			return true;
		}
		else
		{
			?><script>alert('GROSSE MARDE DE DOUBLEUR');</script><?php
			return false;
		}
	}
?>
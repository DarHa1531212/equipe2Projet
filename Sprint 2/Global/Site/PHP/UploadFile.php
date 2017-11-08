<?php

	if(isset($_FILES['file']))
	{
		$dossier = '../Upload/';
		$fichier = basename($_FILES['file']['name']);
		$tailleMax = 2000000;
		$taille = filesize($_FILES['file']['tmp_name']);
		$extensions = array('.png','.jpg','.jpeg','.docx','.pdf');
		$extension = strchr($_FILES['file']['name'],'.');
		$erreur = false;



		if(!in_array($extension, $extensions))
		{
			?><script>alert("Ce type de fichier n'est pas valide...");</script>><?php
			$erreur = true;
		}

		if($taille > $tailleMax)
		{
			?><script>alert("Le fichier est trop volumineux...");</script>><?php
			$erreur = true;

		}

		if($fichier != "")
		{
			$verif = verificationDoublon($bdd, $fichier);

			if($erreur && $verif) //S'il n'y a pas d'erreur
			{
				$fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				$fichier = preg_replace('/([^.a-z0-9]+)/i','-', $fichier);
				if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier . $fichier))
				{
					//echo'Upload Success';
				}
				else
				{
					//echo'Roger pas content';
				}
			}
		}
		else
		{
			$verif = true;
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
				return false;
				break;
			}
			else
			{
				return true;
			}
		}
	}
?>
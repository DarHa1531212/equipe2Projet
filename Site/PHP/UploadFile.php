<?php
	function UploadFile($page, $bdd, $idStagiaire)
	{
		if(isset($_FILES['file']))
		{
			$result = $bdd->Request('SELECT Annee FROM vStage JOIN vSession ON vStage.IdSession = vSession.Id WHERE idStagiaire = :id', Array('id'=>$idStagiaire), 'stdClass');

			if($page == 'Journal')
			{
				$dossier = '../Sessions/'.$result->Annee.'/'.$idStagiaire.'/Files/';
			}
			else
			{
				if($page == 'Stage')
				{
					$dossier = '../Sessions/'.$result->Annee.'/'.$idStagiaire.'/';
				}
			}
			$fichier = basename($_FILES['file']['name']);
			$tailleMax = 2000000;
			$taille = filesize($_FILES['file']['tmp_name']);
			$extensions = array('.png','.jpg','.jpeg','.docx','.pdf');
			$extension = strchr($_FILES['file']['name'],'.');



			if(!in_array($extension, $extensions))
			{
				//Ne prend pas ce type de fichier
			}

			if($taille > $tailleMax)
			{
				//Le fichier est trop volumineux...
			}

			if($fichier != "")
			{
				if($page == 'Journal') {$verif = verificationDoublon($bdd, $fichier);}else{$verif = true;}

				if(!isset($erreur) && $verif) //S'il n'y a pas d'erreur
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
<?php

	function creationDossierSession($annee)
	{
		if(!is_dir('../Sessions/' . $annee))
		{
			mkdir('../Sessions/' . $annee);
		}
	}

	function creationDossierStage($annee, $stagiaire)
	{
		if(!is_dir('../Sessions/'.$annee.'/'.$stagiaire))
		{
			mkdir('../Sessions/'.$annee.'/'.$stagiaire);
			mkdir('../Sessions/'.$annee.'/'.$stagiaire.'/Files/');
		}
	}
?>
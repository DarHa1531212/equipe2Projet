/********************************************************************************
*	Nom: Hans Darmstadt-Bélanger												*
*	Date: 12 Décembre 2017														*
*	But: Récupérer la réponse du php et afficher un message d'erreur si besoin	*
*********************************************************************************/


function testerRetourSupressionEntreprise(data)
{
	var PHPResponse = jQuery.parseJSON(data);

	//alert("i'm in");
	if(PHPResponse == "-1")
	{
        alert ("Cette entreprise est liée à un ou plusieurs stage(s) et ne peut pas être supprimée");
	}
	else if (PHPResponse == "0" )
	{
        alert ("L'entreprise a été supprimée");
		Requete(AfficherPage, '../PHP/TBNavigation.php?nomMenu=ListeEntreprise.php');
	}
}
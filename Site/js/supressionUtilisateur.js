/********************************************************************************
*	Nom: Hans Darmstadt-Bélanger												*
*	Date: 06 Décembre 2017														*
*	But: Récupérer la réponse du php et afficher un message d'erreur si besoin	*
*********************************************************************************/

function testerRetourSupressionUtilisateur(data)
{
	//PHP envoie nativement 1, donc si j'envoie -1 dans ma fonction PHP, JS reçois -11
	if(data == -11)
	{
        alert ("Cet utilisateur est lié à un ou plusieurs stage(s) et ne peut pas être suprimé");
	}
	else if (data == 01 )
	{
        alert ("L'utilisateur a été supprimé");
		Requete(AfficherPage, '../PHP/TBNavigation.php?nomMenu=ListeUtilisateur.php');
	}

}
var affichage = false;

function AfficherImage(doc, ext)
{
	if(!affichage)
	{
		var contenu= "<img src='../Upload/" + doc + "' class='imageJointe' onclick='EnleverImage()'>";
		affichage=!affichage;
	    document.getElementById('idImage').innerHTML = contenu;
	}
}


function EnleverImage()
{
	if(affichage)
	{
		var contenu= "";
		affichage=!affichage;
	    document.getElementById('idImage').innerHTML = contenu;
	}
}
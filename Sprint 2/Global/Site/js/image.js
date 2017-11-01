var affichage = false;

function AfficherImage(doc, ext)
{
	if(!affichage)
	{
		var contenu= "<div class='pieceJointe' onclick='EnleverImage()'><img class='centerImage' src='../Upload/" + doc + "' class='imageJointe'></div>";
		affichage=!affichage;
	    document.getElementById('imageJointe').innerHTML = contenu;
	}
}


function EnleverImage()
{
	if(affichage)
	{
		var contenu= "";
		affichage=!affichage;
	    document.getElementById('imageJointe').innerHTML = contenu;
	}
}
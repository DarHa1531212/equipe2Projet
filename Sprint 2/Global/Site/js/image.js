var affichage = false;

function AfficherImage(doc, ext)
{
<<<<<<< HEAD
	if(!affichage)
	{
		var contenu= "<img src='../Upload/" + doc + "' class='imageJointe' onclick='EnleverImage()'>";
		affichage=!affichage;
	    document.getElementById('imageJointe').innerHTML = contenu;
	}
=======
	if(!affichage && (ext == 'png' || ext == 'jpg' || ext == 'jpeg'))
	{
		var contenu= "<div class='pieceJointe' onclick='EnleverImage()'><img class='centerImage' src='../Upload/" + doc + "' class='imageJointe'></div>";
		affichage=!affichage;
	    document.getElementById('imageJointe').innerHTML = contenu;
	}
	else
	{
		if(ext == 'pdf')
		{
			window.open("../Upload/" + doc);
		}
		else
		{
			if(ext == 'doc' || ext == 'docx')
			{
				window.open("../Upload/" + doc);
			}
		}
	}
>>>>>>> f919533d5dcf2dba0255e78eeaae3b5a83a12642
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
var affichage = false;

function AfficherImage(doc, ext)
{
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

//Affiche le nom du fichier sélectionné.
function AfficherNom(champ){
    var nom = document.getElementById("nomPieceJointe");
    var nomFichier = champ.value.split("\\");
    
    for(var i = 0; i < nomFichier.length; i++){
        nomFichier.splice(0, 1);
    }
    
    nom.innerHTML = nomFichier[0];
}
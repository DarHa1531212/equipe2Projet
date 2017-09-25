//////////////////////////////////////////////////////////////////////////////////////////////////
//Script pour un SlideView dans le tableau de bord de l'entreprise pour afficher les stagiaires.//
//////////////////////////////////////////////////////////////////////////////////////////////////
var indiceCategorie = 1;

function SlideMove(bouton)
{
    var slide = document.getElementById("slideContainer");
    var width = slide.clientWidth;
    
    if(bouton.id == "btnSuivant"){
        slide.scrollLeft += width;
    }
    else
        slide.scrollLeft -= width;
}


function chargementPage()
{
	var i;
	afficheCacheCategorie(1);
	document.getElementById('boutonPrecedent').style.display='none';

}

function afficheCacheCategorie(position)
{	
	for(i=1;i<=7;i++)
	{
		if(i!=position)
		{
			document.getElementById('categorie'+i).style.display='none';
			document.getElementById('descriptionCategorie'+i).style.display='none';
		}
		else
		{
			document.getElementById('categorie'+i).style.display='block';
			document.getElementById('descriptionCategorie'+i).style.display='block';
		}
		
	}

}

function afficheCategorie(indiceCategorie)
{
	afficheCacheCategorie(indiceCategorie);
}



function afficheCacheLettreAlphabet(position)
{	
	for(i=1;i<=7;i++)
	{
		if(i!=position)
		{
			document.getElementById('categorie'+i).style.display='none';
			document.getElementById('descriptionCategorie'+i).style.display='none';
		}
		else
		{
			document.getElementById('categorie'+i).style.display='block';
			document.getElementById('descriptionCategorie'+i).style.display='block';
		}
		
	}

}






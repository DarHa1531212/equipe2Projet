var indiceCategorie = 1;

var blocCategories = document.getElementsByClassName("categories");

var lettreCategories = document.getElementsByClassName("lettreCategories");

var enteteCategories = document.getElementsByClassName("enteteCategorieQuestion");

var indiceQuestion = document.getElementById("indiceQuestion");

var indiceBlocCategorie = 0;

var boutonSuivant = document.getElementById("boutonSuivant");

var boutonPrecedent = document.getElementById("boutonPrecedent");


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
	cacheTousLesBlocCategories();

	//indiceQuestion.innerHTML = indiceBlocCategorie+1;

	blocCategories[0].style.display = 'block';
	enteteCategories[0].style.display = 'block';
	//boutonPrecedent.style.display = 'none';
	boutonPrecedent.disabled=true;
	lettreCategories[0].style.borderColor = 'blue';

	
	//cocheReponse();
}

function chargementPageEvalFinale()
{
	cacheTousLesBlocCategories();

	indiceQuestion.innerHTML = indiceBlocCategorie+1;

	blocCategories[0].style.display = 'block';
	enteteCategories[0].style.display = 'block';
	//boutonPrecedent.style.display = 'none';
	boutonPrecedent.disabled=true;
	//lettreCategories[0].style.borderColor = 'blue';

	
	//cocheReponse();
}


function afficheCategorieSuivante()
{

	boutonPrecedent.disabled=false;
	boutonSuivant.disabled = false;

	indiceBlocCategorie++;

	cacheTousLesBlocCategories();

	blocCategories[indiceBlocCategorie].style.display = 'block';
	enteteCategories[indiceBlocCategorie].style.display = 'block';

	initialiseLettreAlphabet()
	lettreCategories[indiceBlocCategorie].style.borderColor = 'Blue';

	if(indiceBlocCategorie == blocCategories.length - 1)
	{
		boutonPrecedent.disabled=false;
		boutonSuivant.disabled = true;
	}
	
}

function afficheCategorieSuivanteEvalFinale()
{

	boutonPrecedent.disabled=false;
	boutonSuivant.disabled = false;

	indiceBlocCategorie++;

	cacheTousLesBlocCategories();

	blocCategories[indiceBlocCategorie].style.display = 'block';
	enteteCategories[indiceBlocCategorie].style.display = 'block';

	initialiseLettreAlphabet()
	//lettreCategories[indiceBlocCategorie].style.borderColor = 'Blue';

	if(indiceBlocCategorie == blocCategories.length - 1)
	{
		boutonPrecedent.disabled=false;
		boutonSuivant.disabled = true;
	}

	indiceQuestion.innerHTML = indiceBlocCategorie+1;
	
}


function afficheCategoriePrecedente()
{
	boutonPrecedent.disabled=false;
	boutonSuivant.disabled = false;
	
	indiceBlocCategorie--;

	cacheTousLesBlocCategories();

	blocCategories[indiceBlocCategorie].style.display = 'block';
	enteteCategories[indiceBlocCategorie].style.display = 'block';

	initialiseLettreAlphabet();
	lettreCategories[indiceBlocCategorie].style.borderColor = 'Blue';

	if(indiceBlocCategorie == 0)
	{
		boutonPrecedent.disabled = true;
		boutonSuivant.disabled = false;
	}

}

function afficheCategoriePrecedenteEvalFinale()
{
	boutonPrecedent.disabled=false;
	boutonSuivant.disabled = false;
	
	indiceBlocCategorie--;

	cacheTousLesBlocCategories();

	blocCategories[indiceBlocCategorie].style.display = 'block';
	enteteCategories[indiceBlocCategorie].style.display = 'block';

	initialiseLettreAlphabet();
	//lettreCategories[indiceBlocCategorie].style.borderColor = 'Blue';

	if(indiceBlocCategorie == 0)
	{
		boutonPrecedent.disabled = true;
		boutonSuivant.disabled = false;
	}

	indiceQuestion.innerHTML = indiceBlocCategorie+1;

}

function cacheTousLesBlocCategories()
{
	for(var i=0;i<blocCategories.length;i++) 
	{
	  blocCategories[i].style.display='none';
	}

	for(var i=0;i<enteteCategories.length;i++) 
	{
	  enteteCategories[i].style.display='none';
	}
}

function initialiseLettreAlphabet()
{
	for(var i=0;i<lettreCategories.length;i++) 
	{
	  lettreCategories[i].style.borderColor='#f9a11d';
	}

}







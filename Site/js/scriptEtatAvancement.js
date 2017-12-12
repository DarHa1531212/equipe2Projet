var contents = document.getElementsByClassName("tabContent");

function afficheFormulaire(idFormulaire)
{
	var formulaire = document.getElementById(idFormulaire);
	
	formulaire.style.display = 'block';
	
	for(var i = 0; i < contents.length-1; i++)
    {
        contents[i]style.display = 'none';;
    }
	
}
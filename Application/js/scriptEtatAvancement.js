//var contents = document.getElementsByClassName("tabContent");

function afficheFormulaire(idFormulaire)
{
	var contents = document.getElementsByClassName("tabcontent");
	//recupere 
	//var formulaire = document.getElementById(idFormulaire);
	
	for(var i = 0; i < contents.length; i++)
    {
        contents[i].style.display = 'none';
		//$(contents[i]).hide();
    }
	document.getElementById(idFormulaire).style.display = 'block';
	
}
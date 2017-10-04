function RegexProfilStagiaire(){

	var idNumTel = ['numeroCellulaire', 'numeroMaison', 'numeroEntreprise'];
	var regexNumTel = /^[(]{1}[0-9]{3}[)]{1}[\s]{1}[0-9]{3}[-]{1}[0-9]{4}$/;
	var confirmSaveNum = [true, true, true];
	var confirmSaveCourriel = [true, true];
	var confirmSavePoste = true;
	var confirmSaveMDP = [true, true];

	for(var i = 0; i < 3; i++) //boucle rentre 3 fois pour verifier les 3 nums
	{
		var id = idNumTel[i];
		var text = document.getElementById(id);

		if(text.value != "")
		{
			if(regexNumTel.test(text.value)) 
			{
				changerCouleur(text, true);
				confirmSaveNum[i] = true;
			}
			else
			{
				changerCouleur(text, false);
				confirmSaveNum[i] = false;
			}
		}
		else
		{
			if(text.id == 'numeroEntreprise')
			{
				changerCouleur(text, true);
				confirmSaveNum[i] = true;
			}
				
		}
	}

	var idCourriel = ['courrielPersonnel', 'courrielEntreprise'];
	var regexCourriel = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

	for(var i = 0; i < 2; i++) //permet de vérifier les emails selon un standard web
	{
		var id = idCourriel[i];
		var text = document.getElementById(id);
		
		if(text.value != "")
		{
			if(regexCourriel.test(text.value))
			{
				changerCouleur(text, true);
				confirmSaveCourriel[i] = true;
			}
			else
			{
				changerCouleur(text, false);
				confirmSaveCourriel[i] = false;
			}
		}
		else
		{
			if(idCourriel[i] == 'courrielEntreprise')
			{
				changerCouleur(text, true);
				confirmSaveCourriel[i] = true;
			}
		}
	}

	var text = document.getElementById('poste');
	var regexPoste = /^[0-9]{0,7}$/;

	if(text.value != "")
	{
		if(regexPoste.test(text.value))
		{
			changerCouleur(text, true);
			confirmSavePoste = true;
		}
		else
		{
			changerCouleur(text, false);
			confirmSavePoste = false;
		}
	}
	else
	{
		changerCouleur(text, true);
		confirmSavePoste = true;
	}

	var idMDP = ['newPwd', 'confirmationNewPwd'];
	var regexMDP = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
	for(var i = 0; i < 2; i++)
	{
		var id = idMDP[i];
		var text = document.getElementById(id);
		
		if(text.value != "")
		{
			if(regexMDP.test(text.value))
			{
				changerCouleur(text, true);
				confirmSaveMDP[i] = true;
			}
			else
			{
				changerCouleur(text, false);
				confirmSaveMDP[i] = false;
			}
		}
		else
		{
			changerCouleur(text, true);
			confirmSaveMDP[i] = true;
		}
	}

	if(document.getElementById(idMDP[0]).value != document.getElementById(idMDP[1]).value)
	{
		confirmSaveMDP[0] = false;
	}
	else
	{
		confirmSaveMDP[0] = true;
	}

	if(!confirmSaveNum[0] || !confirmSaveNum[1] || !confirmSaveNum[2] || !confirmSaveCourriel[0] || !confirmSaveCourriel[1] || !confirmSavePoste || !confirmSaveMDP[0] || !confirmSaveMDP[1])
	{
		document.getElementById('Save').disabled = true;
	}
	else
	{
		document.getElementById('Save').disabled = false;
	}
}

function changerCouleur(text, etat)
{
	if(!etat)
	{
		text.style.backgroundColor = "#ff8080";
	}
	else
	{
		text.style.backgroundColor = "white";
	}
}
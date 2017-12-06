//Petit refactoring a faire ici!!! Pour la modification du mot de passe a franck
function RegexProfilStagiaire(){

	var idNumTel = ['numTel', 'numEntreprise'];
	var regexNumTel = /^[(]{1}[0-9]{3}[)]{1}[\s]{1}[0-9]{3}[-]{1}[0-9]{4}$/;
	var confirmSaveNum = [true, true, true];
	var confirmSaveCourriel = [true, true];
	var confirmSavePoste = true;
	var confirmSaveMDP = [true, true];
	var Utilisateur = "";

	for(var i = 0; i < 2; i++) //boucle rentre 3 fois pour verifier les 3 nums
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
			if(text.id == 'numEntreprise')
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
	confirmSaveMDP = regexMDP(idMDP, confirmSaveMDP);

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
        $("#Save").css("background-color", "#011f45");
	}
	else
	{
		document.getElementById('Save').disabled = false;
        $("#Save").css('background-color', '');
	}
}

function regexMDP(idMDP, confirmSaveMDP)
{
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
	return confirmSaveMDP;
}

function regexCreationStage() 
{
	//heure sem
	var confirmSaveHeure = true;

	var regexHeure = /^[0-4][0-9],?[0-5]?[0]?$/;
	var text = document.getElementById("heureSem");

	if(regexHeure.test(text.value))
	{
		changerCouleur(text, true);
		confirmSaveHeure = true;
	}
	else
	{
		changerCouleur(text, false);
		confirmSaveHeure = false;
	}

	//salaire
	var confirmSalaire = true;

	var regexSalaire = /^[0-9][0-9],[0-9][0-9]$/;
	var text = document.getElementById("salaire");

	if(document.getElementById("non").checked == false)
	{
		if(regexSalaire.test(text.value))
		{
			changerCouleur(text, true);
			confirmSalaire = true;
		}
		else
		{
			changerCouleur(text, false);
			confirmSalaire = false;
		}
	}
	else
	{
		changerCouleur(text, "disabled");
		confirmSalaire = true;
	}

	if(!confirmSaveHeure || !confirmSalaire)
	{
		document.getElementById('Save').disabled = true;
        $("#Save").css("background-color", "#011f45");
	}
	else
	{
		document.getElementById('Save').disabled = false;
        $("#Save").css('background-color', '');
	}	
}

function regexCreationUtilisateur()
{
	var confirmEmployeEntreprise = true;

	//Prenom
	var confirmNom = true;
	var regexNom = /^[A-Z][a-z]{1,}$/;
	var text = document.getElementById("nom");

	if(regexNom.test(text.value))
	{
		changerCouleur(text, true);
		confirmNom = true;
	}
	else
	{
		changerCouleur(text, false);
		confirmNom = false;
	}

	//Nom
	var confirmPrenom = true;
	var regexPrenom = /^[A-Z][a-z]{1,}$/;
	var text = document.getElementById("prenom");

	if(regexPrenom.test(text.value))
	{
		changerCouleur(text, true);
		confirmPrenom = true;
	}
	else
	{
		changerCouleur(text, false);
		confirmPrenom = false;
	}

	//email
	var confirmEmail = true;
	var regexCourriel = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	var text = document.getElementById("Courriel");

	if(regexCourriel.test(text.value))
	{
		changerCouleur(text, true);
		confirmEmail = true;
	}
	else
	{
		changerCouleur(text, false);
		confirmEmail = false;
	}

	if(Utilisateur == "EmployeEntreprise")
	{
		confirmEmployeEntreprise = regexEmployeEntreprise();
	}

	if(!confirmPrenom || !confirmNom || !confirmEmail || !confirmEmployeEntreprise)
	{
		document.getElementById('Save').disabled = true;
        $("#Save").css("background-color", "#011f45");
	}
	else
	{
		document.getElementById('Save').disabled = false;
        $("#Save").css('background-color', '');
	}
}

function regexEmployeEntreprise()
{
	//numtel
	var confirmNum = true;
	var regexNumTel = /^[(]{1}[0-9]{3}[)]{1}[\s]{1}[0-9]{3}[-]{1}[0-9]{4}$/;
	var text = document.getElementById("numTelEntreprise");

	if(regexNumTel.test(text.value))
	{
		changerCouleur(text, true);
		confirmNum = true;
	}
	else
	{
		changerCouleur(text, false);
		confirmNum = false;
	}

	//Poste
	var confirmPoste = true;
	var regexPoste = /^[0-9]{0,7}$/;
	var text = document.getElementById("posteTel");

	if(regexPoste.test(text.value))
	{
		changerCouleur(text, true);
		confirmPoste = true;
	}
	else
	{
		changerCouleur(text, false);
		confirmPoste = false;
	}

	if(confirmNum && confirmPoste)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function regexSession()
{
	var confirmAnnee = true;
	var regexAnnee = /^[2][0][0-9]{2}$/;
	var text = document.getElementById("annee");

	if(regexAnnee.test(text.value))
	{
		changerCouleur(text, true);
		confirmAnnee = true;
	}
	else
	{
		changerCouleur(text, false);
		confirmAnnee = false;
	}

	if(!confirmAnnee)
	{
		document.getElementById('Save').disabled = true;
        $("#Save").css("background-color", "#011f45");
	}
	else
	{
		document.getElementById('Save').disabled = false;
        $("#Save").css('background-color', '');
	}
}

function regexCreationEntreprise()//???
{
	//NumTell
	var confirmNum = true;
	var regexNumTel = /^[(]{1}[0-9]{3}[)]{1}[\s]{1}[0-9]{3}[-]{1}[0-9]{4}$/;
	//Num civique
	var confirmCivique = true;
	var regexCivique = /^[0-9]{1,5}$/;
	//rue
	var confirmStreet = true;
	var regexStreet = /^[A-z]{0,}\s?[A-z]{0,}\s?[A-z]{0,}$/;
	//Ville
	var confirmTown = true;
	var regexTown = /^[A-Z][a-z]{1,}$/;
	//code postal
	var confirmPostal = true;
	var regexPostal = /^[A-Z][0-9][A-Z]\s[0-9][A-Z][0-9]$/;
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

	if (etat == "disabled") 
	{
		text.style.backgroundColor = "#dddddd"
	}
}
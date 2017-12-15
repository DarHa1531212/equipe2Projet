var timeout;

function ReponseChoisie(item){
    $(".evaluation2 > tbody > tr").css("background-color", "rgba(0, 0, 0, 0.2)");
    $(".evaluation2 > tbody > tr:hover").css("background-color", "rgba(0, 0, 0, 0.9)");
    
    $(item).css("background-color", "#43ee2d");
}

function DisableSalaire(rad){
    var salaire = document.getElementById("salaire");
    
    if(rad.id == "oui")
    {
        salaire.disabled = false;
        salaire.style.backgroundColor = "#ffffff";
    }
    else
    {
        salaire.disabled = true;
        salaire.style.backgroundColor = "#dddddd";
        salaire.value = "0,00";
    }
}

function SetTimeout(){
    timeout = setTimeout(SessionTimeout, 300000);
}

function SessionTimeout(){
    window.location = "../PHP/logout.php";
}

window.addEventListener("click", function(){
    clearTimeout(timeout);
    timeout = setTimeout(SessionTimeout, 300000);
})

//PLEIN D'UTILISATEUR N'ONT PAS D'ID D'UTILISATEUR A VOIR DANS LA BD.
function PopulateListEmploye(data){
    var option = "";
    data = JSON.parse(data);
    
    for(var i = 0; i < data.length; i++)
        option += "<option value=" + data[i].IdUtilisateur + ">" + data[i].Nom + "</option>";
    
    $("#superviseur").empty();
    $("#responsable").empty();
    $("#superviseur").append(option);
    $("#responsable").append(option);
}

function setLimitDateSession(data)
{
    data = JSON.parse(data);

    //EVALUATION
    //Mi-stage
    $("#MiStageDebut").attr({
        min : data + '-01-01',
        max : data + '-12-31'
    });

    $("#MiStageLimit").attr({
        min : data + '-01-01',
        max : data + '-12-31'
    });

    //Finale
    $("#EvalFinalDebut").attr({
        min : data + '-01-01',
        max : data + '-12-31'
    });

    $("#EvalFinalLimit").attr({
        min : data + '-01-01',
        max : data + '-12-31'
    });

    //Formation
    $("#EvalFormDebut").attr({
        min : data + '-01-01',
        max : data + '-12-31'
    });

    $("#EvalFormLimit").attr({
        min : data + '-01-01',
        max : data + '-12-31'
    });

    //RAPORTS
    //Janvier
    $("#JanvierDebut").attr({
        min : data + '-01-01',
        max : data + '-01-31'
    });

    $("#JanvierLimit").attr({
        min : data + '-01-01',
        max : data + '-01-31'
    });

    //Février
    $("#FevrierDebut").attr({
        min : data + '-02-01',
        max : data + '-02-28'
    });

    $("#FevrierLimit").attr({
        min : data + '-02-01',
        max : data + '-02-28'
    });

    //Mars
    $("#MarsDebut").attr({
        min : data + '-03-01',
        max : data + '-03-31'
    });

    $("#MarsLimit").attr({
        min : data + '-03-01',
        max : data + '-03-31'
    });
}

function PopulateTable(data){
    var option = "";
    data = JSON.parse(data);
    
    for(var i = 0; i < data.length; i++){
        option +=   "<tr class=\"itemHover\" onclick=\"Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=InfoStage.php&index=\'.$index.\'\')\">" +
                        "<td>" + data[i].NomEntreprise + "</td>" +
                        "<td>" + data[i].NomStagiaire + "</td>" + 
                        "<td>Lettre dentente</td>" +
                    "</tr>";
    }
        
    
    $("table>tbody").empty();
    $("table>tbody").append(option);
}
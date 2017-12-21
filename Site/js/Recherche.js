function PopulateStage(data){
    var option = "";
    data = JSON.parse(data);
    
    for(var i = 0; i < data.length; i++){
        option +=   "<tr class=\"itemHover\" onclick=\"Requete(AfficherPage, '../PHP/TBNavigation.php?nomMenu=InfoStage.php&idStage=" + data[i].IdStage + "')\">" +
                        "<td>" + data[i].NomEntreprise + "</td>" +
                        "<td>" + data[i].NomStagiaire + "</td>" + 
                        "<td>" + data[i].SalaireHoraire + "</td>" + 
                        "<td>" + data[i].DateDebut + "</td>" + 
                        "<td>" + data[i].DateFin + "</td>" + 
                    "</tr>";
    }
        
    $("table>tbody").empty();
    $("table>tbody").append(option);
}

function PopulateUser(data){
    var option = "";
    var role = ["Gestionnaire", "Responsable", "Enseignant", "Superviseur", "Stagiaire"];
    data = JSON.parse(data);
    
    for(var i = 0; i < data.length; i++){
        var courriel = "";
        var numTel = "";
        
        if(data[i].CourrielPersonnel != undefined)
            courriel = data[i].CourrielPersonnel;
        else
            courriel = data[i].CourrielEntreprise;
        
        if(data[i].NumTelPerso != undefined)
            numTel = data[i].NumTelPerso;
        else
            numTel = data[i].NumTelEntreprise;
        
        option +=   "<tr class=\"itemHover\" onclick=\"Requete(AfficherPage, '../PHP/TBNavigation.php?nomMenu=Profil.php&idProfil=" + data[i].IdUtilisateur + "')\">" +
                        "<td>" + data[i].Prenom + "</td>" +
                        "<td>" + data[i].Nom + "</td>" + 
                        "<td>" + courriel + "</td>" + 
                        "<td>" + numTel + "</td>" + 
                        "<td>" + data[i].NomEntreprise + "</td>" + 
                        "<td>" + role[data[i].IdRole - 1] + "</td>" + 
                    "</tr>";
    }
        
    $("table>tbody").empty();
    $("table>tbody").append(option);
}

function PopulateEntreprise(data){
    var option = "";
    data = JSON.parse(data);
    
    for(var i = 0; i < data.length; i++){
        option +=   "<tr class=\"itemHover\" onclick=\"Requete(AfficherPage, '../PHP/TBNavigation.php?nomMenu=InfoEntreprise.php&id=" + data[i].Id + "')\">" +
                        "<td>" + data[i].Nom + "</td>" +
                        "<td>" + data[i].NumTel + "</td>" + 
                        "<td>" + data[i].CourrielEntreprise + "</td>" + 
                        "<td>" + data[i].Ville + "</td>" + 
                    "</tr>";
    }
        
    $("table>tbody").empty();
    $("table>tbody").append(option);
}

function PopulateSession(data){
    var option = "";
    data = JSON.parse(data);
    
    for(var i = 0; i < data.length; i++){
        option +=   "<tr class=\"itemHover\" onclick=\"Requete(AfficherPage, '../PHP/TBNavigation.php?nomMenu=InfoSession.php&id=" + data[i].Id + "')\">" +
                        "<td>" + data[i].Periode + "</td>" +
                        "<td>" + data[i].Annee + "</td>" + 
                    "</tr>";
    }
        
    $("table>tbody").empty();
    $("table>tbody").append(option);
}
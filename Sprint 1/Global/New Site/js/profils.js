function Requete(url, callback){
    console.log(url);
    $.ajax({
        type: "POST",
        url: Url(arguments) ,
        success: function(data){
            console.log(url);
            callback(data);
        }
    });
}

function Url(){
    var url = "";
    
    for(var i = 2; i < arguments[0].length; i++){
        url += arguments[0][i];
    }
    
    console.log(url);
    return url;
}
        
function AfficherPage(xhttp){
    var menu = $.parseJSON(xhttp);
    $(".stagiaire").empty();
    $(".stagiaire").append(menu);
}

function Execute(url, choix){
    switch(choix){
        case 1: Requete(url, AfficherPage, arguments);
            break;
        case 2: Requete(url, AfficherPage, arguments);
            break;
    }
}
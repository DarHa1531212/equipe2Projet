var titrePage;

//Envoie la requete au serveur et retourne la réponse.
function Requete(callback){
    $.ajax({
        type: "POST",
        url: Url(arguments) ,
        success: function(data){
            history.pushState(JSON.parse(data), titrePage[0], titrePage[0] + ".html");
            callback(data);
        }
    });
}

function Post(callback){
    var lstChamps = $(".value");
    var tabChamp = [];
    var champ = "";
    var form_data = new FormData();
    
    for(var i = 0; i < lstChamps.length; i++){
        champ = {
            nom: lstChamps[i].name,
            value: lstChamps[i].value
        };
        
        tabChamp.push(champ);
    }
    
    tabChamp = JSON.stringify(tabChamp);
    form_data.append('tabChamp', tabChamp);
    
    $.ajax({ 
        url: Url(arguments),  
        dataType: 'text',   
        cache: false, 
        contentType: false, 
        processData: false, 
        data: form_data,                          
        type: 'post', 
        success: function(data){ 
            callback(data); 
        } 
    }); 
}

//Crée une liste des radios boutons et les encode en JSON pour le envoyer au PHP.
function PostEval(callback){ 
    var questions = $('input[type="radio"]:checked');   
    var reponse = "";
    var tabReponse = [];
    var form_data = new FormData();                   
    
    for(var i = 0; i < questions.length; i++){
        reponse={
            nom: questions[i].name,
            idQuestion: questions[i].name.substring(8, questions[i].name.length),
            value: questions[i].value
        };
        
        tabReponse.push(reponse);
    }
    
    tabReponse = JSON.stringify(tabReponse);
    
    form_data.append('tabReponse', tabReponse); 
    
    $.ajax({ 
        url: Url(arguments),  
        dataType: 'text',   
        cache: false, 
        contentType: false, 
        processData: false, 
        data: form_data,                          
        type: 'post', 
        success: function(data){ 
            callback(data); 
        } 
    }); 
} 

function UploadFile(callback){ 
    var file_data = $('#file').prop('files')[0];    
    var form_data = new FormData();                   
    form_data.append('file', file_data); 
     
    $.ajax({ 
        url: Url(arguments),  
        dataType: 'text',   
        cache: false, 
        contentType: false, 
        processData: false, 
        data: form_data,                          
        type: 'post', 
        success: function(data){ 
            callback(data); 
        } 
    }); 
} 

//Construit l'URL selon les derniers paramètre de la fonction Execute.
function Url(){
    var url = "";
    var parametre = arguments[0][1];
    
    for(var i = 1; i < parametre.length; i++){
        url += parametre[i];
        url = url.replace(/(?:\r\n|\r|\n)/g, '\\n');
    }
    
    titrePage = url.split("nomMenu=");
    titrePage = titrePage[1].split("&");

    return url;
}
 
//Affiche la page selon l'url demandé.
function AfficherPage(xhttp){
    var page = "";
    
    if(xhttp != history.state)
        page = $.parseJSON(xhttp);
    else
        page = xhttp;
        
    $(".stagiaireContainer").empty();
    $(".stagiaireContainer").append(page);
    CacherDiv();//Juste si il y a des stagiaires a afficher ou des evaluations(Fix plus tard).
}

window.onpopstate = function(){
    AfficherPage(history.state);
}

window.addEventListener("load", function(){
    var html = document.getElementsByClassName("stagiaireContainer")[0].innerHTML;
    history.replaceState(html, "Main", "Main.html");
})

//Éxecute une page PHP sans l'afficher.
function ExecuteQuery(xhttp){
    $.parseJSON(xhttp);
}

//Selon le choix, éxecute la fonction demandé. C'est la fonction qui doit être appelée
//sur les OnClicks. Tous les paramètres qui se trouvent après "choix" sont utilisés pour
//construire l'url.
function Execute(choix){
    switch(choix){
        case 1: Requete(AfficherPage, arguments);
            break;
        case 2: Requete(ExecuteQuery, arguments);
            break;
        case 3: UploadFile(ExecuteQuery, arguments);
            break;
        case 4: PostEval(ExecuteQuery, arguments);
            break;
        case 5: Post(AfficherPage, arguments);
    }
}
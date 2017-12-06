var titrePage;

//Envoie la requete au serveur et retourne la réponse.
function Requete(callback){
    $.ajax({
        type: "POST",
        url: Url(arguments) ,
        success: function(data){
            history.pushState(JSON.parse(data), titrePage[0], titrePage[0]);
            callback(data);
        }
    });
}

//Prend tous les champs possédant la classe value et les envoie dans un tableau php avec un POST
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

//Construit l'URL selon les derniers paramètres d'une fonctions.
function Url(arguments){
    var url = arguments[1];
    
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
    history.replaceState(html, "Main", "Main");
})

//Éxecute une page PHP sans l'afficher.
function ExecuteQuery(xhttp){
	$.parseJSON(xhttp);
}
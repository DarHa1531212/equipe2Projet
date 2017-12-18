var titrePage;

//Envoie la requete au serveur et retourne la réponse.
function Requete(callback){
    $.ajax({
        type: "POST",
        url: Url(arguments) ,
        async: false,
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
    UploadFile(form_data);
    
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
        async: false,
        success: function(data){ 
            callback(data); 
        } 
    }); 
}

//Détermine si il y a un fichier à transferer sur la page.
function UploadFile(form_data){ 
    if($('#file').length > 0){
        var file_data = $('#file').prop('files')[0];                      
        form_data.append('file', file_data); 
    }
} 

//Crée une liste des radios boutons et les encode en JSON pour le envoyer au PHP.
function PostEval(callback)
{ 
     var form_data = new FormData(); 

   
        var questions = $('input[type="radio"]:checked');   
        var zoneCommentaireEvaluation = $('[name=commentaireEvaluation]');
        var zoneCommentaireCategories = $(".commentaireCategorie");
        var reponse = "";
        var tabReponse = [];
        
                 
        
        for(var i = 0; i < questions.length; i++)
        {
            reponse=
            {
                nom: questions[i].name,
                idQuestion: questions[i].name.substring(8, questions[i].name.length),
                value: questions[i].value,
                type:"question"
            };
            
            tabReponse.push(reponse);
        }

        if(zoneCommentaireCategories.length != 0)
        {
            for(var i = 0; i < zoneCommentaireCategories.length; i++)
            {
                commentaireCategorie = 
                {
                    nom: zoneCommentaireCategories[i].name,
                    idQuestion: zoneCommentaireCategories[i].name,
                    value : zoneCommentaireCategories[i].value,
                    type:"commentaireCategorie"
                }

                 tabReponse.push(commentaireCategorie);

            }
        }

        commentaire = 
        { 
            nom: " ",
            idQuestion: " ",
            value : zoneCommentaireEvaluation.val(),
            type:"commentaireEvaluation"
        };

        tabReponse.push(commentaire);

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
            async: false,
            success: function(data)
            { 
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

//fonction execute lors de la soumission des evaluations
function submitEvaluation()
{
    if(($('.questions').length == $('input[type="radio"]:checked').length))
    {
        //PostEval(ExecuteQuery, arguments);
        PostEval( ExecuteQuery, '../PHP/TBNavigation.php?idEmploye='+$("input[name=IdSuperviseur]").val() + '&nomMenu=Eval&post=true&idEvaluation='+ $("input[name=IdEvaluation]").val() +'&id='+ $("input[name=IdStagiaire]").val()+'&idStage='+ $("input[name=IdStage]").val() );
        Requete( AfficherPage, '../PHP/TBNavigation.php?idEmploye='+ $("input[name=IdSuperviseur]").val() +'&nomMenu=Main' );
    }
    else
    {
        //AfficherPage('../TBNavigation.php?idEmploye=' + $("input[name=IdSuperviseur]").val() + '&nomMenu=Eval&erreurRadioButton=true&idEvaluation='+ $("input[name=IdEvaluation]").val() +'&idStagiaire='+ $("input[name=IdStagiaire]").val() );

        Requete( AfficherPage, '../PHP/TBNavigation.php?idEmploye=' + $("input[name=IdSuperviseur]").val() + '&nomMenu=Eval&erreurRadioButton=true&idEvaluation='+ $("input[name=IdEvaluation]").val() +'&id='+ $("input[name=IdStagiaire]").val()+'&idStage='+ $("input[name=IdStage]").val());
        //Execute(1, '../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Main');
    }
}
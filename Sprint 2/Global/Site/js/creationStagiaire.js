/********************************************************************************************************************************************
*	Nom: Hans Darmstadt-Bélanger																											*
*	But: un controller qui récupère les données saisies par l'utilisateur et qui les envoie au PHP pour interragir avec la base de données	*
*	date: 06 novebre 2017																													*
********************************************************************************************************************************************/


function getValuesFromUser(callback)
{
    var values = $(".data");   
    var reponse = "";
    var tabValues = [];
    var form_data = new FormData();                   
    
         reponse={
                nom: "functionToExecute",
                value: "1"
            };
    tabValues.push(reponse);

    for(var i = 0; i < values.length; i++){
        reponse={
            nom: values[i].name,
            value: values[i].value
        };
        
        tabValues.push(reponse);
    }
    
    tabValues = JSON.stringify(tabValues);
    alert (tabValues);
    form_data.append('tabValues', tabValues); 
    
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

//afficher toutes les infos à propos d'un stagiaire à partir de l'id en paramètre d'entrée
function readStagiaire(callback, args)
{
 //   alert("readStagiaire");
 
    var reponse = "";
    var tabValues = [];
     var form_data = new FormData();
 
    reponse={
                nom: "functionToExecute",
                value: "2"
            };
    tabValues.push(reponse);
 
    reponse={
                nom: "idStagiaire",
                value: args[2]
            };
    tabValues.push(reponse);
    args[2]="";

     tabValues = JSON.stringify(tabValues);

 form_data.append('tabValues', tabValues); 
   //alert(tabValues);
        
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
                console.log(data);
                afficherInfos(data);
            } 
        }); 
 
 
}

function afficherInfos(data)
{
    var myObject = JSON.parse(data);
    console.log (myObject);
  //  alert (myObject);
    var contenu = "<p>Nom du stagiaire: ".concat( myObject[1] + " " + myObject[0] + "</p><br><p>Courrie scolaire: " + myObject[2] + "</p><br><p>Numéro de téléphone en entreprise: " + myObject[3] + "</p><br><p>Poste: " + myObject[4] + "</p><br><p>Courriel d'entreprise: " + myObject[5] + "</p><br><p>Code permanent: " + myObject[6] + "</p><br><p>Courriel personnel: " + myObject[7] + "</p><br><p>Numéro de téléphone personnel: " + myObject[8] + "</p><br><p>Entreprise: " + myObject[9] + "</p>");
    document.getElementById('readStagiaire').innerHTML = contenu;

}


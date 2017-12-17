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

function readEmploye (callback, args)
{
 
    var reponse = "";
    var tabValues = [];
     var form_data = new FormData();
 
    reponse={
                nom: "functionToExecute",
                value: "2"
            };
    tabValues.push(reponse);
 
    reponse={
                nom: "idEmploye",
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
    var contenu ="<p>Nom de l'employe:  ".concat(  myObject[0]  + "</p><br><p>Nom d'entreprise: " + myObject[4] + "</p><br><p>Courriel de l'employe: " + myObject[1] +"</p><br><p>Numéro de téléphone de l'employé: " + myObject[2] + "</p><br><p>Poste téléphonique de l'employe: " + myObject[3] +  "</p> <br>");
    console.log (contenu);
    document.getElementById('readEmployeEntreprise').innerHTML = contenu;




}

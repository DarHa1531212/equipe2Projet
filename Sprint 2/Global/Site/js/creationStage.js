/********************************************************************************************************************************************
*  Nom: Hans Darmstadt-Bélanger                                                      *
*  But: un controller qui récupère les données saisies par l'utilisateur et qui les envoie au PHP pour interragir avec la base de données  *
*  date: 06 novebre 2017                                                          *
********************************************************************************************************************************************/
 
 
function getValuesFromUser(callback)
{
    var values = $(".infosStage");   
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
    alert(tabValues);
    
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
 
 
//quand l'utilisateur sélectionne une entreprise, les champs Responsable et Supervieur sont peuplés par les employés de cette entreprise exclusivement
function afficherResponsableEtSuperviseur(callback)
 
{
    var reponse = "";
    var tabValues = [];
    var form_data = new FormData();                   
    var e = document.getElementById("entreprise");
    var idEntreprise = e.options[e.selectedIndex].value;
 
    $('#responsableStage').remove().not(':first');
   
 
     reponse={
                nom: "functionToExecute",
                value: "2"
            };
    tabValues.push(reponse);
 
     reponse={
                nom: "idEntreprise",
                  value: idEntreprise
            };
    tabValues.push(reponse);
 
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
 
    //ajouter parseJson
 
}
 
//afficher toutes les infos à propos d'un stage à partir de l'id en paramètre d'entrée
function readStage(callback, clicked_id)
{
 
    var reponse = "";
    var tabValues = [];
     var form_data = new FormData();
 
    reponse={
                nom: "functionToExecute",
                value: "3"
            };
    tabValues.push(reponse);
 
    reponse={
                nom: "idStage",
                value: clicked_id
            };
    tabValues.push(reponse);
 
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

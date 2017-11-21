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
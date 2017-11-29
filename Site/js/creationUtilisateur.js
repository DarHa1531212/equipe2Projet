 function changeUserType(obj){
         champ = {
            nom: "userType",
            value: obj.options[obj.selectedIndex].value
        };
        
    tabChamp.push(champ);

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

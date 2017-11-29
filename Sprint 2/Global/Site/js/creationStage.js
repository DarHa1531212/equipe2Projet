/********************************************************************************************************************************************
*  Nom: Hans Darmstadt-Bélanger                                                                                                             *
*  But: un controller qui récupère les données saisies par l'utilisateur et qui les envoie au PHP pour interragir avec la base de données   *
*  date: 06 novebre 2017                                                                                                                    *
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
   // alert(tabValues);
    
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
    var retourResonsables = "";
 
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
   //s alert (tabValues);
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
                console.log(data);
                ajouterSuperviseur(data);
            } 


        }); 




} 

 
//afficher toutes les infos à propos d'un stage à partir de l'id en paramètre d'entrée
function readStage(callback, args)
{
 
    var reponse = "";
    var tabValues = [];
    var form_data = new FormData();

    tabValues.push(reponse);
 
    reponse={
                nom: "idStage",
                value: args[1]
            };
    tabValues.push(reponse);
    args[1]="";

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


function ajouterSuperviseur(callback)
{

console.log (callback);
    $('#responsableStage').append(callback);
    console.log ("all good");

}


function afficherInfos(data)
{
//échanger compétances recherchées et nom du responsable
        /* $returnData [0] = $DescriptionStage; $returnData [1] = $CompetenceRecherche;        $returnData [2] = $HoraireTravail;        $returnData [3] = $SalaireHoraire;        $returnData [4] = $NbHeureSemaine;        $returnData [5] = $NomEntreprise;        $returnData [6] = $NomSuperviseur;        $returnData [7] = $NomStagiaire;        $returnData [8] = $NomResponsable;        $returnData [9] = $NomEnseignant;  */
    var myObject = JSON.parse(data);
    console.log (myObject);
    var contenu ="<p>Nom du stagiaire:  ".concat(  myObject[7]  + "</p><br><p>Nom d'entreprise: " + myObject[5] + "</p><br><p>Nom de l'enseignant: " + myObject[9] +"</p><br><p>Nom du superviseur: " + myObject[6] + "</p><br><p>Nom du responsable: " + myObject[8] +  "</p> <br> <p>Horaire de travail: " + myObject[2] + "</p><br><p>Salaire horaire: " + myObject[3] + "</p><br><p>Nombre d'heures par semaine: " +  myObject[4] + "</p> <br><p>Compétences recherchées: " + myObject[1] +   "</p><br><p>Description du stage: " + myObject[0] + "</p><br>");
    console.log (contenu);
    document.getElementById('readStage').innerHTML = contenu;




}

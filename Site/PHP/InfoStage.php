<?php

    require 'ListeStage.php';

    if(isset($_REQUEST["delete"]))
        DeleteStage($bdd);
    
    function DeleteStage($bdd){
        return $bdd->Request("  DELETE FROM tblStage WHERE Id = :id;",
                                array('id'=>$_REQUEST["idStage"]),
                                'stdClass');
    }

    if(isset($_REQUEST["idStage"])){
        foreach($stages as $sta){
            if($sta->getIdStage() == $_REQUEST["idStage"]){
                $stage = $sta;
                break;
            }  
        }
    }     

    if(isset($_REQUEST["post"]))
        DeleteStage($bdd);

    $content =
    '
    <script>
        function Delete(){
            if(confirm("Êtes-vous certains de vouloir supprimer ce stage?")){
                alert("Le stage a bien été supprimé.");
                Requete(ExecuteQuery, \'../PHP/TBNavigation.php?nomMenu=InfoStage.php&idStage='.$stage->getIdStage().'&delete\');
                Requete(AfficherPage, \'../PHP/TBNavigation.php?idstage='.$stage->getIdStage().'&nomMenu=ListeStage.php\');
            }
        }
    </script>
    
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Consultation des Stage</h2>
            <input class="bouton" type="button" value="Modifier" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?&nomMenu=ModifStage.php&idStage='.$stage->getIdStage().'\')"/>
        </div>

        <div class="separateur">
            <h3>Informations du Stage</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Session : </p>
                <p class="value">'.$stage->getNomSession().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Nom d\'entreprise : </p>
                <p class="value">'.$stage->getNomEntreprise().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Nom du stagiaire : </p>
                <p class="value">'.$stage->getNomStagiaire().'</p>
            </div>           
            <div class="champ">
                <p class="label labelForInput">Nom de l\'enseignant : </p>
                <p class="value">'.$stage->getNomEnseignant().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Nom du superviseur : </p>
                <p class="value">'.$stage->getNomSuperviseur().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Nom du responsable : </p>
                <p class="value">'.$stage->getNomResponsable().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Salaire horaire : </p>
                <p class="value">'.$stage->getSalaireHoraire().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Heures/Semaine : </p> 
                <p class="value">'.$stage->getNbHeureSemaine().'</p> 
            </div>
            <div class="champ">
                <p class="label labelForInput">Date de début : </p>
                <p class="value">'.$stage->getDateDebut().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Date de fin : </p>
                <p class="value">'.$stage->getDateFin().'</p>
            </div>     
            <div>
                <p class="label labelForInput">Description du stage : </p>
                <p class="entree">'.$stage->getDescriptionStage().'</p>
            </div>
            <div>
                <p class="label labelForInput">Compétences recherchées : </p>
                <p class="entree">'.$stage->getCompetenceRecherche().'</p>
            </div>
            <br/><br/>
        </div>

    <br/><br/>
    
    <input class="bouton" type="button" style="width: 100px;" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeStage.php\')"/>
    <input class="bouton" type="button" style="width: 100px;" value="Supprimer" onclick="Delete()"/>';

    return $content;

?>
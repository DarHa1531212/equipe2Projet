<?php

    require 'ListeStage.php';

    function DeleteStage($bdd){
        if(isset($_REQUEST['idStage']))
            $data = $_REQUEST['idStage'];
        $stage = array();
        $result = $bdd->Request(" DELETE FROM tblStage WHERE Id = :id;",
        array('id'=>$data),'stdClass');

        return "stage Supprimé";
    }


    if(isset($_REQUEST["index"]))
        $stage = $stages[$_REQUEST["index"]];

   // var_dump($stage->getNomStagiaire());


    if(isset($_REQUEST["post"]))
        DeleteStage($bdd);

    else 
    {
     //  var_dump($stages[$_REQUEST["index"]]->getIdStage());
        $content =
        '<article class="stagiaire">
        <div class="infoStagiaire">
                <h2>Consultation des stages</h2>
                <input class="bouton" type="button" value="Modifier" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?&nomMenu=ModifStage.php&index='.$_REQUEST["index"].'\')"/>
            </div>

            <div class="separateur">
                <h3>Informations des Stages</h3>
            </div>

            <div class="blocInfo infoProfil">
        <div class="champ">
            <p class="label labelForInput">Nom du stagiaire</p>
            <p class = "value">' . $stage->getNomStagiaire() . '</p>
        </div>
        <br>
        <div class="champ">
            <p class="label labelForInput">Nom d\'entreprise </p>
            <p class = "value"> ' . $stage->getNomEntreprise() .'</p>
        </div>
        <br>
        <div class="champ">
            <p class="label labelForInput">Nom de l\'enseignant</p>
            <p class = "value">' . $stage->getNomEnseignant() .'</p>
        </div>
        <br>
        <div class="champ">
            <p class="label labelForInput">Nom du superviseur</p>
            <p class = "value">'.$stage->getNomSuperviseur().'</p>
        </div>
        <br> 
        <div class="champ">
            <p class="label labelForInput">Horaire de travail</p>
            <p class = "value">' . $stage->getHoraireTravail() . '</p>
        </div>
        <br>
        <div class="champ">
            <p class="label labelForInput">Salaire horaire</p>
            <p class = "value">' . $stage->getSalaireHoraire() . '</p>
        </div>
        <br>
        <div class="champ">
            <p class="label labelForInput">Nombre d\'heures par semaine</p> 
            <p class = "value">' . $stage->getNbHeureSemaine() . '</p> 
        </div>
        <br>
        <div class="champ">
            <p class="label labelForInput">Compétences recherchées:</p>
            <p class = "value">' . $stage->getCompetenceRecherche() . '</p>
        </div>
        <br>
        <div class="champ">
            <p class="label labelForInput">Description du stage</p>
            <p class = "value">' . $stage->getDescriptionStage() . '</p>
        </div>
        <br>
        <div class="champ">
            <p class="label labelForInput">Date de début</p>
            <p class = "value">' . $stage->getDateDebut() . '</p>
        </div>
        <br>
        <div class="champ">
            <p class="label labelForInput">Date de fin</p>
            <p class = "value">' . $stage->getDateFin() . '</p>
        </div>
        <br>
        </div>

        <br/><br/>

        <input class="bouton" type="button" style="width: 100px;" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeStage.php\')"/>
        <input class="bouton" type="button" style="width: 100px;" value="Suprimer" onclick= "Requete(ExecuteQuery, \'../PHP/TBNavigation.php?nomMenu=InfoStage.php&idStage='.$stages[$_REQUEST["index"]]->getIdStage().'&post=true\'); Requete(AfficherPage, \'../PHP/TBNavigation.php?idstage='.$stages[$_REQUEST["index"]]->getIdStage().'&nomMenu=ListeStage.php\'); "/>

        </article>
        ';

        return $content;

    }

 

?>
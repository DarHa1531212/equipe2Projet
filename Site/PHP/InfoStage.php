<?php

    require 'ListeStage.php';

    function DeleteStage($bdd){
        if(isset($_REQUEST['idStage']))
            $data = $_REQUEST['idStage'];
        $stage = array();
        $result = $bdd->Request(" DELETE FROM tblStage WHERE Id = :id;",
        array('id'=>$data),'stdClass');

        return;
    }

    if(isset($_REQUEST["index"]))
        $stage = $stages[$_REQUEST["index"]];

    if(isset($_REQUEST["post"]))
        DeleteStage($bdd);

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
    <p>Nom du stagiaire: ' . $stage->getNomStagiaire() . '</p>
    </div>
    <br>
    <div class="champ">
    <p>Nom d\'entreprise: ' . $stage->getNomEntreprise() . '</p>
    </div>
    <br>
    <div class="champ">
    <p>Nom de l\'enseignant: ' . $stage->getNomEnseignant() . '</p>
    </div>
    <br>
    <div class="champ">
    <p>Nom du superviseur: ' . $stage->getNomSuperviseur() . '</p>
    </div>
    <br> 
    <div class="champ">
    <p>Horaire de travail: ' . $stage->getHoraireTravail() . '</p>
    </div>
    <br>
    <div class="champ">
    <p>Salaire horaire: ' . $stage->getSalaireHoraire() . '</p>
    </div>
    <br>
    <div class="champ">
    <p>Nombre d\'heures par semaine: ' . $stage->getNbHeureSemaine() . '</p> 
    </div>
    <br>
    <div class="champ">
    <p>Compétences recherchées: ' . $stage->getCompetenceRecherche() . '</p>
    </div>
    <br>
    <div class="champ">
    <p>Description du stage: ' . $stage->getDescriptionStage() . '</p>
    </div>
    <br>
    <div class="champ">
    <p>Date de début: ' . $stage->getDateDebut() . '</p>
    </div>
    <br>
    <div class="champ">
    <p>Date de fin: ' . $stage->getDateFin() . '</p>
    </div>
    <br>
    </div>

    <br/><br/>

    <input class="bouton" type="button" style="width: 100px;" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeStage.php\')"/>
    <input class="bouton" type="button" style="width: 100px;" value="Supprimer" onclick= "Requete(ExecuteQuery, \'../PHP/TBNavigation.php?nomMenu=InfoStage.php&idStage='.$stages[$_REQUEST["index"]]->getIdStage().'&post=true);Requete(AfficherPage, \'../PHP/TBNavigation.php?idstage='.$stages[$_REQUEST["index"]]->getIdStage().'&nomMenu=ListeStage.php\'); "/>

    </article>
    ';

    return $content;

?>
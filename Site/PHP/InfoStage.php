<?php

    require 'ListeStage.php';

     if(isset($_REQUEST["post"]))
        DeleteStage($bdd);
    else{


   $content =
       '<article class="stagiaire">
        <div class="infoStagiaire">
                <h2>Consultation des stages</h2>
                <input class="bouton" type="button" value="Modifier"/>
            </div>

            <div class="separateur">
                <h3>Informations des Stages</h3>
            </div>

            <div class="blocInfo infoProfil">
        <div class="champ">
        <p>Nom du stagiaire: ' . $stages[$_REQUEST["id"]]->NomStagiaire . '</p>
        </div>
        <br>
        <div class="champ">
        <p>Nom d\'entreprise: ' . $stages[$_REQUEST["id"]]->NomEntreprise . '</p>
        </div>
        <br>
        <div class="champ">
        <p>Nom de l\'enseignant: ' . $stages[$_REQUEST["id"]]->NomEnseignant . '</p>
        </div>
        <br>
        <div class="champ">
        <p>Nom du superviseur: ' . $stages[$_REQUEST["id"]]->NomSuperviseur . '</p>
        </div>
        <br> 
        <div class="champ">
        <p>Horaire de travail: ' . $stages[$_REQUEST["id"]]->HoraireTravail . '</p>
        </div>
        <br>
        <div class="champ">
        <p>Salaire horaire: ' . $stages[$_REQUEST["id"]]->SalaireHoraire . '</p>
        </div>
        <br>
        <div class="champ">
        <p>Nombre d\'heures par semaine: ' . $stages[$_REQUEST["id"]]->NbHeureSemaine . '</p> 
        </div>
        <br>
        <div class="champ">
        <p>Compétences recherchées: ' . $stages[$_REQUEST["id"]]->CompetenceRecherche . '</p>
        </div>
        <br>
        <div class="champ">
        <p>Description du stage: ' . $stages[$_REQUEST["id"]]->DescriptionStage . '</p>
        </div>
        <br>
        <div class="champ">
        <p>Date de début: ' . $stages[$_REQUEST["id"]]->DateDebut . '</p>
        </div>
        <br>
        <div class="champ">
        <p>Date de fin: ' . $stages[$_REQUEST["id"]]->DateFin . '</p>
        </div>
        <br>
        </div>

        <br/><br/>

        <input class="bouton" type="button" style="width: 100px;" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=ListeStage.php\')"/>
        <input class="bouton" type="button" style="width: 100px;" value="Supprimer" onclick= "Requete(ExecuteQuery, \'../PHP/TBNavigation.php?nomMenu=InfoStage.php\',\'&idStage=\','.$stages[$_REQUEST["id"]]->IdStage.',\'&post=\',true);Requete(AfficherPage, \'../PHP/TBNavigation.php?idstage=\','.$stages[$_REQUEST["id"]]->IdStage.',\'&nomMenu=ListeStage.php\'); "/>

        </article>
    ';
    
    return $content;

        
    }
        
    function DeleteStage($bdd){
        $data = $_REQUEST['idStage'];
        $stage = array();
        $result = $bdd->Request(" DELETE FROM tblStage WHERE Id = :id;",
            array('id'=>$data),'stdClass');

        return;
    }


?>
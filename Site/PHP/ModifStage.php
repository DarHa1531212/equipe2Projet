<?php
include 'CreationStage.php';
require 'InfoStage.php';

if(isset($_REQUEST["Edit"]))
    return $stage->Update($bdd, json_decode($_POST["tabChamp"]));

if(isset($_REQUEST["populate"]))
    return showEmployees($bdd);

$content =
'
<script>
        Post(PopulateListEmploye, \'../PHP/TBNavigation.php?nomMenu=ModifStage.php&index='.$_REQUEST["index"].'&populate\');
        
        function Submit(){
            if(CheckAll()){
                Post(AfficherPage, \'../PHP/TBNavigation.php?&nomMenu=ModifStage.php&index='.$_REQUEST["index"].'&Edit\')
                alert("Le stage à bien été modifié.");
                Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeStage.php\');
            }
        }
    </script>
<article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Modification d\'un Stage</h2>
        </div>

        <div class="separateur">
            <h3>Informations Générales</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Entreprise</p>
                <select class="value" name="Entreprise" onchange="Post(PopulateListEmploye, \'../PHP/TBNavigation.php?nomMenu=ModifStage.php&index='.$_REQUEST["index"].'&populate\')">
                    <option value="'.$stage->getIdEntreprise().'" selected>'.$stage->getNomEntreprise().'</option>
                    ' . showEnterprises($bdd) . '
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Stagiaire</p>
                <select class="value"  name = "Stagiaire">
                    <option selected value='.$stage->getIdStagiaire().'>'.$stage->getNomStagiaire().'</option>
                    ' . showInterns($bdd) . '
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Session</p>
                <select class="value"  name = "Session">
                    <option selected disabled value='.$stage->getIdSession().'>'.$stage->getNomSession().'</option>
                    ' . showSessions($bdd) . '
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Responsable</p>
                <select class="value"  name = "Responsable" id="responsable">
                    <option selected disabled>'.$stage->getNomResponsable().'</option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Superviseur</p>
                <select class="value"  name = "Superviseur" id="superviseur">
                    <option selected disabled>'.$stage->getNomSuperviseur().'</option>               
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Enseignant</p>
                <select class="value"  name = "Enseignant">
                    <option selected disabled value="'.$stage->getIdEnseignant().'">'.$stage->getNomEnseignant().'</option>
                    ' . showProfessors($bdd) . '
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Heure / Semaine</p>
                <input class="value" type="text" value="'.$stage->getNbHeureSemaine().'" name="HeuresSemaine" onblur="VerifierRegex(this);" pattern="'.$regxHeure.'"/>
            </div>
            <div class="champ">
                <p class="label labelForInput"></p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Rémunéré</p>
                <div>
                    <label for="oui">Oui</label>
                    <input id="oui" type="radio" name="remunere" value="1" checked onclick="DisableSalaire(this)"/>
                    <label for="non">Non</label>
                    <input id="non" type="radio" name="remunere" value="0" onclick="DisableSalaire(this)"/>
                </div>
            </div>
            <div class="champ">
                <p class="label labelForInput">Salaire Horaire</p>
                <input class="value" type="text"  name = "SalaireHoraire" value="'.$stage->getSalaireHoraire().'" id="salaire" onblur="VerifierRegex(this);" pattern="'.$regxSalaire.'"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Date Début</p>
                <input class="value" value="'.$stage->getDateDebut().'" onblur="Required(this);" name="DateDebut" type="date" required/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Date Fin</p>
                <input class="value" value="'.$stage->getDateFin().'" onblur="Required(this);" name="DateFin" type="date" required/>
            </div>

            <br/>

            <div class="champArea">
                <p class="label labelForInput labelArea">Description du stage</p>
                <textarea class="value valueArea" maxlength="1000" name="DescStage">'.$stage->getDescriptionStage().'</textarea>
            </div>  
            <div class="champArea">
                <p class="label labelForInput labelArea">Compétences recherchées</p>
                <textarea class="value valueArea" maxlength="1000" name="CompetancesRecherchees">'.$stage->getCompetenceRecherche().'</textarea>
            </div>

            <br/>
            
            <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeStage.php\')"/>      
            <input class="bouton" type="button" id="Save" style="width: 100px;" value=" Sauvegarder " onclick= "Submit()"/>
            <br/><br/>
        </div>   
</article>';

return $content;

?>
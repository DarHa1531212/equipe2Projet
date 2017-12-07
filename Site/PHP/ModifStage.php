<?php

include 'CreationStage.php';
require 'InfoStage.php';

if(isset($_REQUEST["post"])){
    $stage->Update($bdd, json_decode($_POST["tabChamp"]));
    return;
}
    

$content =
'
<article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Stages</h2>
        </div>

        <div class="separateur">
            <h3>Création d\'un Stage</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Entreprise</p>
                <select class="value" name = "Entreprise" onchange="Post(PopulateListEmploye, \'../PHP/TBNavigation.php?nomMenu=CreationStage.php&populate\')">
                    ' . showEnterprises($bdd) . '
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Stagiaire</p>
                <select class="value"  name = "Stagiaire">
                    ' . showInterns($bdd) . '
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Responsable</p>
                <select class="value"  name = "Responsable" id="responsable">
                    <option value = "1">Responsable 1</option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Superviseur</p>
                <select class="value"  name = "Superviseur" id="superviseur">
                <option value = "1">SUPERVISEUR 1</option>                
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Enseignant</p>
                <select class="value"  name = "Enseignant">
                    ' . showProfessors($bdd) . '
                    </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Heure / Semaine</p>
                <input class="value" type="text"  name = "HeuresSemaine"/>
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
                <input class="value" type="text"  name = "SalaireHoraire" id="salaire"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Date Début</p>
                <input class="value"  name = "DateDebut" type="date"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Date Fin</p>
                <input class="value"  name = "DateFin" type="date"/>
            </div>

            <br/>

            <div class="champArea">
                <p class="label labelForInput labelArea">Description du stage</p>
                <textarea class="value" class="valueArea"  name = "DescStage"></textarea>
            </div>  
            <div class="champArea">
                <p class="label labelForInput labelArea">Compétences recherchées</p>
                <textarea class="value" class="valueArea"  name = "CompetancesRecherchees"></textarea>
            </div>

		<br>
            <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeStage.php\')"/>      
            <input class="bouton" type="button" id="Save" style="width: 100px;" value=" Sauvegarder " onclick= "Post(AfficherPage, \'../PHP/TBNavigation.php?&nomMenu=CreationStage.php&post\')"/>
            <br/><br/>
    </div>   
                
    <br/><br/>

    <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeEntreprise.php\')"/>
    <input class="bouton" type="button" id="Save" style="width: 100px;" value="Sauvegarder" onclick="Post(ExecuteQuery, \'../PHP/TBNavigation.php?id='.$_REQUEST["index"].'&nomMenu=ModifEntreprise.php&post\'); Requete(AfficherPage, \'../PHP/TBNavigation.php?&nomMenu=ListeEntreprise.php\')"/>
</article>';

return $content;

?>
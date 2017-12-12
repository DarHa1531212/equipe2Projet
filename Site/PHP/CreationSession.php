<?php
if(isset($_REQUEST["post"]))
        CreateSession($bdd);
        
    function CreateSession($bdd){
        $champs = json_decode($_POST["tabChamp"]);
        $session = array();
        
        foreach($champs as $champ){
            $session[$champ->nom] = $champ->value;
        }
        $bdd->Request(" INSERT INTO tblSession (Annee,Periode,MiStageDebut,MiStageLimite,FinaleDebut,FinaleLimite,FormationDebut,FormationLimite,JanvierDebut,JanvierLimite,FevrierDebut,FevrierLimite,MarsDebut,MarsLimite) 
                        VALUES (:annee,:periode,:mistagedebut,:mistagelimite,:finaledebut,:finalelimite,:formationdebut,:formationlimite,:janvierdebut,:janvierlimite,:fevrierdebut,:fevrierlimite,:marsdebut,:marslimite)",
                        array(
                        'annee'=>$session["annee"],
                        'periode'=>$session["periode"],    
                        'mistagedebut'=>$session["mistagedebut"],    
                        'mistagelimite'=>$session["mistagelimite"],
                        'finaledebut'=>$session["finaledebut"],
                        'finalelimite'=>$session["finalelimite"],
                        'formationdebut'=>$session["formationdebut"],
                        'formationlimite'=>$session["formationlimite"],
                        'janvierdebut'=>$session["janvierdebut"],
                        'janvierlimite'=>$session["janvierlimite"],
                        'fevrierdebut'=>$session["fevrierdebut"],
                        'fevrierlimite'=>$session["fevrierlimite"],
                        'marsdebut'=>$session["marsdebut"],
                        'marslimite'=>$session["marslimite"]),
                        'stdClass');
    }
    $content = 
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Création d\'une Session</h2>
        </div>
        
        <div class="separateur">
            <h3>Information de la session</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Année</p>
                <input class="value" type="text" name="annee">
            </div>
            <div class="champ">
                <p class="label labelForInput">Cahier Entreprise</p>
                <input class="value" type="file">
            </div>
            <div class="champ">
                <p class="label labelForInput">Période</p>
                <select  class="value" name="periode">
                    <option name="periode">Été</option>
                    <option name="periode">Automne</option>
                    <option name="periode">Hiver</option>
                    <option name="periode">Printemps</option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Cahier Stagiaire</p>
                <input class="value" type="file">
            </div>
        </div>
        
        <div class="moitier">
            <div class="separateur enteteMoitier">
                <h3>Évalutions</h3>
            </div>

            <div class="blocInfo infoProfil">
                <h4>Évaluation Mi-Stage</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="mistagedebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name ="mistagelimite">
                </div>
                
                <h4>Évaluation Finale</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="finaledebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="finalelimite">
                </div>
                
                <h4>Évaluation de la Formation</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="formationdebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="formationlimite">
                </div>
                
                <br/><br/>
            </div>
        </div>
        
        <div class="moitier">
            <div class="separateur enteteMoitier">
                <h3>Rapports</h3>
            </div>

            <div class="blocInfo infoProfil">
                <h4>Rapport Janvier</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="janvierdebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="janvierlimite">
                </div>
                
                <h4>Rapport Février</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="fevrierdebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="fevrierlimite">
                </div>
                
                <h4>Rapport Mars</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="marsdebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="marslimite">
                </div>
                
                <br/><br/>
            </div>
        </div>
        
        <br/><br/>
        
        <input style="width: 120px;" class="bouton" type="button" value="Retour" onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=Main\')"/>
        <input class="bouton" type="button" id="Save" style="width: 100px;" value="Créer" onclick="Execute(5, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=CreationSession.php&post\');Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=ConsoleAdminMain.php\')"/>
    </article>
    ';   

    return $content;
?>
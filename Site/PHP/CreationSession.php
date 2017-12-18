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
                        'annee'=>$session["dateSelected"],
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

    function createYear()
    {
        $choix = '<option value="default">Choisir une année</option>';
        $year = date('Y');

        for($i = $year; $i <= $year+10; $i++)
        {
            $choix = $choix . '<option value="'.$i.'">'.$i.'</option>';
        }

        return '<select name="dateSelected" class="value" onchange="Post(setLimitDateSession, \'../PHP/TBNavigation.php?nomMenu=CreationSession.php&limit\')">'.$choix.'</select>';
    }

    if(isset($_REQUEST['limit']))
        return createLimitYear();

    function createLimitYear()
    {
        $champs = json_decode($_POST["tabChamp"]);
        $date = array();

        foreach($champs as $champ){
            $date[$champ->nom] = $champ->value;
        }
        return $date['dateSelected'];

    }

    $content = 
    '
        <script>
        function Submit(){
            if(CheckAll()){
                Post(ExecuteQuery, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=CreationSession.php&post\');
                Requete(AfficherPage, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=ListeSession.php\');
            }
        }
    </script>
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
                '.createYear().'
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
                    <input class="value" type="date" name="mistagedebut" id="MiStageDebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name ="mistagelimite" id="MiStageLimit">
                </div>
                
                <h4>Évaluation Finale</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="finaledebut" id="EvalFinalDebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="finalelimite" id="EvalFinalLimit">
                </div>
                
                <h4>Évaluation de la Formation</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="formationdebut" id="EvalFormDebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="formationlimite" id="EvalFormLimit">
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
                    <input class="value" type="date" name="janvierdebut" id="JanvierDebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="janvierlimite" id="JanvierLimit">
                </div>
                
                <h4>Rapport Février</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="fevrierdebut" id="FevrierDebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="fevrierlimite" id="FevrierLimit">
                </div>
                
                <h4>Rapport Mars</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input class="value" type="date" name="marsdebut" id="MarsDebut">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input class="value" type="date" name="marslimite" id="MarsLimit">
                </div>
                
                <br/><br/>
            </div>
        </div>
        
        <br/><br/>
        
        <input type="button" id="Cancel" class="bouton" value="Retour" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeSession.php\')" /> 
        <input class="bouton" type="button" id="Save" style="width: 100px;" value="Créer" onclick="Submit()"/>
    </article>
    ';   

    return $content;
?>
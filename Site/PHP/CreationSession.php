<?php

    function createYear()
    {
        $choix = '<option value="default">Choisir une année</option>';
        for($i = 2017; $i <= 2017+25; $i++)
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
                <select  class="value">
                    <option>Été</option>
                    <option>Automne</option>
                    <option>Hiver</option>
                    <option>Printemps</option>
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
                    <input id="MiStageDebut" class="value" type="date">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input id="MiStageLimit" class="value" type="date">
                </div>
                
                <h4>Évaluation Finale</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input id="EvalFinalDebut" class="value" type="date">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input id="EvalFinalLimit" class="value" type="date">
                </div>
                
                <h4>Évaluation de la Formation</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input id="EvalFormDebut" class="value" type="date">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input id="EvalFormLimit" class="value" type="date">
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
                    <input id="JanvierDebut" class="value" type="date">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input id="JanvierLimit" class="value" type="date" >
                </div>
                
                <h4>Rapport Février</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input id="FevrierDebut" class="value" type="date">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input id="FevrierLimit" class="value" type="date">
                </div>
                
                <h4>Rapport Mars</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                    <input id="MarsDebut" class="value" type="date">
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                    <input id="MarsLimit" class="value" type="date">
                </div>
                
                <br/><br/>
            </div>
        </div>
        
        <br/><br/>
        
        <input style="width: 120px;" class="bouton" type="button" value="Retour" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=Main\')"/>
        <input style="width: 120px;" class="bouton" type="button" value="Créer"/>
    </article>
    ';   

    return $content;
?>
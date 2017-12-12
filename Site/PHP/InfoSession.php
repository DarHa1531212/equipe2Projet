<?php
    
    require 'ListeSession.php';


    $content =
    '
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Consultation de la session</h2>
            <input class="bouton" type="button" value="Modifier"/>
        </div>

        
        <div class="separateur">
            <h3>Information de la session</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Année</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->Annee.'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Cahier Entreprise</p>
                <input class="value" type="file">
            </div>
            <div class="champ">
                <p class="label labelForInput">Période</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->Periode.'</p>
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
                <p class="value">'.$sessions[$_REQUEST["id"]]->MiStageDebut.'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->MiStageLimite.'</p>
                </div>
                
                <h4>Évaluation Finale</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->FinaleDebut.'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->FinaleLimite.'</p>
                </div>
                
                <h4>Évaluation de la Formation</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->FormationDebut.'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->FormationLimite.'</p>
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
                <p class="value">'.$sessions[$_REQUEST["id"]]->JanvierDebut.'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->JanvierLimite.'</p>
                </div>
                
                <h4>Rapport Février</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->FevrierDebut.'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->FevrierLimite.'</p>
                </div>
                
                <h4>Rapport Mars</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->MarsDebut.'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$sessions[$_REQUEST["id"]]->MarsLimite.'</p>
                </div>
                
                <br/><br/>
            </div>
        </div>
            <br/><br/>
        
        <input class="bouton" type="button" style="width: 100px;" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=ListeSession.php\')"/>
        <input class="bouton" type="button" id="Save" style="width: 100px;" value="Supprimer"/>
            
    </article>
    ';
    
    return $content;

?>





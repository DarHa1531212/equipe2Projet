<?php
    
    require 'ListeSession.php';

    if(isset($_REQUEST["delete"])){
        return $sessions[$_REQUEST["id"]]->Delete($bdd, $sessions[$_REQUEST["id"]]->getId());
    }
    
    if(isset($_REQUEST["id"])){
        foreach($sessions as $sess){
            if($sess->getId() == $_REQUEST["id"]){
                $session = $sess;
                break;
            }  
        }
    }   

    function CheckStage($bdd,$IdSession){
        $nbStage = $bdd->Request("SELECT COUNT(*) AS nbStage FROM vStage WHERE IdSession = :IdSession",array("IdSession"=>$IdSession),"stdClass");
        if($nbStage[0]->nbStage >= 1)
            return "true";
        else
            return "false";

        return"false";

    }
    $content =
    '
    <script>
    function Submit(){
        if(CheckAll()){
            if(confirm("Voulez-vous vraiment supprimer cette session?")){
                if(!'.CheckStage($bdd,$session->getId()).'){
                    Post(ExecuteQuery, \'../PHP/TBNavigation.php?id='.$_REQUEST["id"].'&nomMenu=InfoSession.php&delete\');
                    Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeSession.php\');

                }else{
                    alert("La session ne peut être supprimée car elle liée à un stage.");
                }
            }   
        }
    }
    </script>
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Consultation de la session</h2>
            <input class="bouton" type="button" value="Modifier" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?&nomMenu=ModifSession.php&id='.$_REQUEST["id"].'\')"/>
        </div>

        
        <div class="separateur">
            <h3>Information de la session</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Année</p>
                <p class="value">'.$session->getAnnee().'</p>
            </div>
            <div class="champ">
                <p class="label labelForInput">Cahier Entreprise</p>
                <input class="value" type="file">
            </div>
            <div class="champ">
                <p class="label labelForInput">Période</p>
                <p class="value">'.$session->getPeriode().'</p>
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
                <p class="value">'.$session->getMiStageDebut().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$session->getMiStageLimite().'</p>
                </div>
                
                <h4>Évaluation Finale</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                <p class="value">'.$session->getFinaleDebut().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$session->getFinaleLimite().'</p>
                </div>
                
                <h4>Évaluation de la Formation</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                <p class="value">'.$session->getFormationDebut().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$session->getFormationLimite().'</p>
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
                <p class="value">'.$session->getJanvierDebut().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$session->getJanvierLimite().'</p>
                </div>
                
                <h4>Rapport Février</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                <p class="value">'.$session->getFevrierDebut().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$session->getFevrierLimite().'</p>
                </div>
                
                <h4>Rapport Mars</h4>
                <div class="champ">
                    <p class="label labelForInput">Date Début</p>
                <p class="value">'.$session->getMarsDebut().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Date Limite</p>
                <p class="value">'.$session->getMarsLimite().'</p>
                </div>
                
                <br/><br/>
            </div>
        </div>
            <br/><br/>
        
        <input class="bouton" type="button" style="width: 100px;" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeSession.php\')"/>
        
        <input class="bouton" type="button" id="Save" style="width: 100px;" value="Supprimer" onclick="Submit()"/>
            
    </article>
    ';
    
    return $content;

?>
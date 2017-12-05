<?php

    $eval = new Evaluation($bdd, $_REQUEST["idEvaluation"]);

    if($eval->getIdTypeEval() == 1)
        $eval = new EvaluationGrille($bdd, $_REQUEST["idEvaluation"]);
    else if($eval->getIdTypeEval() == 2)
        $eval = new EvaluationChoixReponse($bdd, $_REQUEST["idEvaluation"]);

    function Identification($bdd){
        $identification = $bdd->Request('   SELECT * FROM vIdentification
                                            WHERE IdStagiaire = :idStagiaire',
                                            array('idStagiaire'=>$_REQUEST["id"]),
                                            "stdClass")[0];
        
        return 
        '
        <table class="identification">
            <tbody>
                <tr>
                    <td>Organisation</td>
                    <td>'.$identification->NomEnt.'</td>
                </tr>

                <tr>
                    <td>Responsable technique</td>
                    <td>'.$_SESSION['PrenomConnecte'].' '.$_SESSION['NomConnecte'].'</td>
                </tr>

                <tr>
                    <td>Responsable pédagogique</td>
                    <td>'.$identification->PrenomEns.' '.$identification->NomEns.'</td>
                </tr>

                <tr>
                    <td>Élève stagiaire</td>
                    <td>'.$identification->PrenomSta.' '.$identification->NomSta.'</td>
                </tr>
            </tbody>
        </table>
        ';
    }

    function LettreNav($bdd, $eval){
        $i = 0;
        $content = "";
        
        foreach($eval->getCategories() as $categorie){
            $content = $content.
            '<input id="Cat'.$i++.'" type="button" value="'.$categorie->getLettre().'" class="lettreNav bouton" onclick="JumpTo('.($i-1).')"/>';
        }
        
        return $content;
    }

    if(isset($_REQUEST["post"]))
        $eval->Submit($bdd);

    $content =
    '<article class="stagiaire">
        <div class="infoStagiaire">
            <h2>'.$eval->getTitre().'</h2>
        </div>

        <div class="blocInfo infoProfil">
            <p>
                La première évaluation servira à noter de façon générale l’élève stagiaire en vue
                d\'un réajustement possible. Il serait grandement souhaitable que cette évaluation
                se fasse conjointement avec l’élève stagiaire et que la démarche s\'effectue de
                façon formative. Une fois complété, le formulaire devra être remis à votre
                stagiaire qui se chargera de nous l\'expédier.
            </p>
        </div>

        <div class="separateur">
            <h3>Identification</h3>
        </div>

        '.Identification($bdd).'
        '.$eval->DrawEvaluation($bdd).'';
        
        $content = $content .
        '<div class="navigateurEval">
            <input id="gauche" class="bouton" style="width : 150px; float: left;" type="button" value="Précédent" onclick="ChangerItem(this)"/>
            '.LettreNav($bdd, $eval).'
            <input id="droite" class="bouton" style="width : 150px; float: right" type="button" value="Suivant" onclick="ChangerItem(this)"/>
            <input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="Execute(4, \'../PHP/TBNavigation.php?idEmploye='.$profils[0]->IdSuperviseur.'&nomMenu=Evaluation.php\', \'&post=true\', \'&idEvaluation=\', '.$_REQUEST["idEvaluation"].', \'&id=\', '.$_REQUEST["id"].'); Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profils[0]->IdSuperviseur.'&nomMenu=Main\')" hidden/>
        </div>

        <br/><br/>

        <input class="bouton" type="button" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profils[0]->IdSuperviseur.'&nomMenu=Main\')"/>
    </article>';

    return $content;

?>
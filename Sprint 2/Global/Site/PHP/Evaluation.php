<?php
    
    $queryQuestion = $bdd->prepare('SELECT DISTINCT(Id), Q.Texte
                                    FROM vQuestion AS Q
                                    JOIN vEvaluationQuestionReponse AS EQR
                                    ON EQR.IdQuestion = Q.Id
                                    WHERE EQR.IdEvaluation = 1');

    $queryReponse = $bdd->prepare( 'SELECT DISTINCT(RQ.IdReponse)
                                    FROM vReponseQuestion AS RQ
                                    JOIN vEvaluationQuestionReponse AS EQR
                                    ON RQ.IdQuestion = EQR.IdQuestion
                                    WHERE EQR.IdEvaluation = 1');
        
    $queryReponseChoisie = $bdd->prepare(  'select IdReponse
                                            from vEvaluationQuestionReponse
                                            where IdEvaluation = 1 AND IdQuestion = :IdQuestion;');

    $queryQuestion->execute();
    $queryReponse->execute();

    function Identification($bdd){
        $query = $bdd->prepare( 'SELECT * FROM vIdentification
                            WHERE IdStagiaire = :idStagiaire');

        $query->execute(array('idStagiaire'=>$_REQUEST["idStagiaire"]));

        $identification = $query->fetchAll();
        
        return 
        '
        <table class="identification">
            <tbody>
                <tr>
                    <td>Organisation</td>
                    <td>'.$identification[0]["NomEnt"].'</td>
                </tr>

                <tr>
                    <td>Responsable technique</td>
                    <td>'.$_SESSION['PrenomConnecte'].' '.$_SESSION['NomConnecte'].'</td>
                </tr>

                <tr>
                    <td>Responsable pédagogique</td>
                    <td>'.$identification[0]["PrenomEns"].' '.$identification[0]["NomEns"].'</td>
                </tr>

                <tr>
                    <td>Élève stagiaire</td>
                    <td>'.$identification[0]["PrenomSta"].' '.$identification[0]["NomSta"].'</td>
                </tr>
            </tbody>
        </table>
        ';
    }

    function Questions($bdd, $queryQuestion, $queryReponse, $queryReponseChoisie){
        
        $content = "";
        
        $questions = $queryQuestion->fetchAll();
        $reponses = $queryReponse->fetchAll();
        
        foreach($questions as $question){
            $content = $content.
            '
            <tbody>
                <tr>
                    <td>'.$question["Texte"].'</td>
                    '.ChoixReponses($bdd, $question["Id"], $queryReponseChoisie, $reponses).'
                </tr>
            </tbody>
            ';
        }
        
        return $content;
    }

    function ChoixReponses($bdd, $idQuestion, $queryReponseChoisie, $reponses){
        $content = "";
        
        $queryReponseChoisie->execute(array('IdQuestion'=>$idQuestion));
        
        $reponsesChoisies = $queryReponseChoisie->fetchAll();
        
        foreach($reponses as $reponse){
            if($reponse['IdReponse'] == $reponsesChoisies[0]["IdReponse"])
                $content = $content.'<td><input type="radio" name="question'.$idQuestion.'" value="'.$reponse['IdReponse'].'" checked = "checked" ></td>';
            else
                $content = $content.'<td><input type="radio" name="question'.$idQuestion.'" value="'.$reponse['IdReponse'].'"></td>';
        }
        
        return $content;
    }

    $content =
    '<article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Évaluation de mi-stage</h2>
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

        <div class="separateur" id="question">
            <h3>A. Motivation</h3>
            <p> 
                Capacité qui se manifeste par le désir d’apprendre, le désir de réussir, l’enthousiasme
                et la persévérance.
            </p>
        </div>
        
        <div class="categories">
            <table class="evaluation">
                <thead>
                    <th>Critères</th>
                    <th>Généralement</th>
                    <th>Souvent</th>
                    <th>Parfois</th>
                    <th>Rarement</th>
                </thead>
                <tbody>
                    '.Questions($bdd, $queryQuestion, $queryReponse, $queryReponseChoisie).'
                </tbody>
            </table>
        </div>

        <div class="navigateurEval">
            <input class="bouton" style="width : 150px; float: left;" type="button" value="Précédent"/>
            <input class="bouton" style="width : 150px; float: right" type="button" value="Suivant"/>
        </div>

        <br/><br/>

        <input class="bouton" type="button" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Main\')"/>
    </article>';

    return $content;

?>
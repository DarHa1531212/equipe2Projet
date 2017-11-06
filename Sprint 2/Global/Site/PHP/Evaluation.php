<?php
    
<<<<<<< HEAD
    $query = $bdd->prepare( 'SELECT * FROM vIdentification
                            WHERE IdStagiaire = :idStagiaire');

    $query->execute(array('idStagiaire'=>$_REQUEST["idStagiaire"]));

    $identification = $query->fetchAll();

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

=======
    $queryCategorie = $bdd->prepare('SELECT DISTINCT(CQ.Id) AS IdCategorie, TitreCategorie, Lettre, descriptionCategorie
                                    FROM vQuestion AS Q
                                    JOIN vCategorieQuestion AS CQ
                                    ON CQ.Id = Q.IdCategorieQuestion
                                    JOIN vEvaluationQuestionReponse AS EQR
                                    ON EQR.IdQuestion = Q.Id
                                    WHERE IdEvaluation = :idEvaluation');

    $queryQuestion = $bdd->prepare('SELECT DISTINCT(Id), Q.Texte
                                    FROM vQuestion AS Q
                                    JOIN vEvaluationQuestionReponse AS EQR
                                    ON EQR.IdQuestion = Q.Id
                                    WHERE EQR.IdEvaluation = :idEvaluation AND Q.IdCategorieQuestion = :idCategorie');

    $queryReponse = $bdd->prepare( 'SELECT DISTINCT(RQ.IdReponse)
                                    FROM vReponseQuestion AS RQ
                                    JOIN vEvaluationQuestionReponse AS EQR
                                    ON RQ.IdQuestion = EQR.IdQuestion
                                    WHERE EQR.IdEvaluation = :idEvaluation');
    
    $queryReponseChoisie = $bdd->prepare(  'select IdReponse
                                            from vEvaluationQuestionReponse
                                            where IdEvaluation = :idEvaluation AND IdQuestion = :IdQuestion;');

    $queryCategorie->execute(array('idEvaluation'=>$_REQUEST["idEvaluation"]));
    $queryReponse->execute(array('idEvaluation'=>$_REQUEST["idEvaluation"]));

    function Identification($bdd){
        $query = $bdd->prepare( 'SELECT * FROM vIdentification
                            WHERE IdStagiaire = :idStagiaire');

        $query->execute(array('idStagiaire'=>$_REQUEST["idStagiaire"]));

        $identification = $query->fetchAll();
        
        return 
        '
>>>>>>> f919533d5dcf2dba0255e78eeaae3b5a83a12642
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
<<<<<<< HEAD

        <div class="separateur">
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
                    <tr>
                        <td>Faire preuve de curiosité.</td>
                        <td><input type="radio" name="Q1"/></td>
                        <td><input type="radio" name="Q1"/></td>
                        <td><input type="radio" name="Q1"/></td>
                        <td><input type="radio" name="Q1"/></td>
                    </tr>

                    <tr>
                        <td>
                            Concentrer ses efforts et investir l’énergie nécessaire pour faire
                            du bon travail, voir à se dépasser, et pour satisfaire aux normes
                            de qualité et de rendement en vigueur dans l’entreprise.
                        </td>
                        <td><input type="radio" name="Q2"/></td>
                        <td><input type="radio" name="Q2"/></td>
                        <td><input type="radio" name="Q2"/></td>
                        <td><input type="radio" name="Q2"/></td>
                    </tr>

                    <tr>
                        <td>
                            Porter un intérêt soutenu au travail. Faire preuve de
                            persévérance et de volonté.
                        </td>
                        <td><input type="radio" name="Q3"/></td>
                        <td><input type="radio" name="Q3"/></td>
                        <td><input type="radio" name="Q3"/></td>
                        <td><input type="radio" name="Q3"/></td>
                    </tr>

                    <tr>
                        <td>Être de bonne humeur. Éprouver du plaisir à travailler</td>
                        <td><input type="radio" name="Q4"/></td>
                        <td><input type="radio" name="Q4"/></td>
                        <td><input type="radio" name="Q4"/></td>
                        <td><input type="radio" name="Q4"/></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="navigateurEval">
            <input class="bouton" style="width : 150px; float: left;" type="button" value="Précédent"/>
            <input class="bouton" style="width : 150px; float: right" type="button" value="Suivant"/>
=======
        ';
    }

    function Questions($bdd, $queryQuestion, $queryReponse, $queryReponseChoisie, $queryCategorie){
        
        $content = "";
        
        $categories = $queryCategorie->fetchAll();
        $reponses = $queryReponse->fetchAll();
        
        foreach($categories as $categorie){
            $queryQuestion->execute(array("idEvaluation"=>$_REQUEST["idEvaluation"], "idCategorie"=>$categorie["IdCategorie"]));
            $questions = $queryQuestion->fetchAll();
            
            $content = $content.
                '
                <div class="categories">
                    <div class="separateur" id="question">
                        <h3>'.$categorie["Lettre"].'. '.$categorie["TitreCategorie"].'</h3>
                        <p> 
                            '.$categorie["descriptionCategorie"].'
                        </p>
                    </div>

                    <table class="evaluation">
                        <thead>
                            <th>Critères</th>
                            <th>Généralement</th>
                            <th>Souvent</th>
                            <th>Parfois</th>
                            <th>Rarement</th>
                        </thead>

                        <tbody>';
            
            foreach($questions as $question){
                $content = $content.
                '
                            <tr>
                                <td>'.$question["Texte"].'</td>
                                '.ChoixReponses($bdd, $question["Id"], $queryReponseChoisie, $reponses).'
                            </tr>
                ';
            }
            
            $content = $content.
                '
                        </tbody>
                    </table>
                </div>
                ';
        }
        
        
        return $content;
    }

    function ChoixReponses($bdd, $idQuestion, $queryReponseChoisie, $reponses){
        $content = "";
        
        $queryReponseChoisie->execute(array("idEvaluation"=>$_REQUEST["idEvaluation"], 'IdQuestion'=>$idQuestion));
        
        $reponsesChoisies = $queryReponseChoisie->fetchAll();
        
        foreach($reponses as $reponse){
            if($reponse['IdReponse'] == $reponsesChoisies[0]["IdReponse"])
                $content = $content.'<td><input type="radio" id="question'.$idQuestion.'" name="question'.$idQuestion.'" value="'.$reponse['IdReponse'].'" checked = "checked" ></td>';
            else
                $content = $content.'<td><input type="radio" name="question'.$idQuestion.'" value="'.$reponse['IdReponse'].'"></td>';
        }
        
        return $content;
    }

    function LettreNav($bdd, $queryCategorie){
        $i = 0;
        $content = "";
        $queryCategorie->execute(array("idEvaluation"=>$_REQUEST["idEvaluation"]));
        $categories = $queryCategorie->fetchAll();
        
        foreach($categories as $categorie){
            $content = $content.
            '<input id="Cat'.$i++.'" type="button" value="'.$categorie["Lettre"].'" class="lettreNav bouton" onclick="JumpTo('.($i-1).')"/>';
        }
        
        return $content;
    }

    function Submit($bdd, $queryCategorie, $queryQuestion){
        $reponses = json_decode($_POST["tabReponse"], true);
        
        $requeteModificationEvaluationQuestionReponse = $bdd->prepare(  'update tblEvaluationQuestionReponse SET IdReponse = :IdReponse
                                                                        WHERE IdEvaluation = :IdEvaluation AND IdQuestion = :IdQuestion;');

        $requeteModifierStatutEvaluation = $bdd->prepare('update tblEvaluation set Statut= \'3\', DateComplétée=:DateCompletee where Id=:IdEvaluation;');

        $queryCategorie->execute(array('idEvaluation'=>$_REQUEST['idEvaluation']));

        $requeteModifierStatutEvaluation->execute(array('IdEvaluation'=>$_REQUEST['idEvaluation'],'DateCompletee'=>date("Y-m-d")));

        $categories = $queryCategorie->fetchAll();

          foreach($categories as $categorie)
          {
              foreach($reponses as $reponse){
                  $requeteModificationEvaluationQuestionReponse->execute(array('IdEvaluation'=>$_REQUEST['idEvaluation'],'IdQuestion'=>$reponse["idQuestion"],'IdReponse'=>$reponse["value"]));
              }         
          }
    }

    if(isset($_REQUEST["post"]))
        Submit($bdd, $queryCategorie, $queryQuestion);

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
        
        '.Questions($bdd, $queryQuestion, $queryReponse, $queryReponseChoisie, $queryCategorie).'

        <div class="navigateurEval">
            <input id="gauche" class="bouton" style="width : 150px; float: left;" type="button" value="Précédent" onclick="ChangerItem(this)"/>
            '.LettreNav($bdd, $queryCategorie).'
            <input id="droite" class="bouton" style="width : 150px; float: right" type="button" value="Suivant" onclick="ChangerItem(this)"/>
            <input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="Execute(4, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Eval\', \'&post=true\', \'&idEvaluation=\', '.$_REQUEST["idEvaluation"].', \'&idStagiaire=\', '.$_REQUEST["idStagiaire"].'); Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Main\')" hidden/>
>>>>>>> f919533d5dcf2dba0255e78eeaae3b5a83a12642
        </div>

        <br/><br/>

        <input class="bouton" type="button" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Main\')"/>
    </article>';

    return $content;

?>
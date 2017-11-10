<?php

    $eval = new Evaluation($bdd, $_REQUEST["idEvaluation"]);

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

    function QuestionsGrille($bdd, $eval){
        
        $content = "";
        
        foreach($eval->getCategories() as $categorie){
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

    function QuestionChoixReponse($bdd, $eval){
        $content = "";
        
        foreach($eval->getQuestions() as $question){
            $content = $content.
            '<div class="categories">
                <div class="separateur" id="question">
                    <h3>'.$question->getCategorie()->getLettre().' '.$question->getCategorie()->getTitre().'</h3>
                    <p> 
                        '.$question->getTexte().'
                    </p>
                </div>
                <table class="evaluation2">
                    <tbody>          
                            '.ChoixReponses($bdd, $question->getId(), $eval).'
                    </tbody>
                </table>
            </div>';                  
        }
        
        return $content;
    }

    function ChoixReponses($bdd, $idQuestion, $eval){
        $content = "";
    
        foreach($eval->getQuestions() as $question){
            foreach($question->getReponses() as $reponse){
                if($_REQUEST["typeEval"] == 1){
                    if($reponse->getId() == $eval->getReponses()[0]->getId())
                        $content = $content.'<td><input type="radio" id="question'.$idQuestion.'" name="question'.$idQuestion.'" value="'.$reponse->getid().'" checked = "checked" ></td>';
                    else
                        $content = $content.'<td><input type="radio" name="question'.$idQuestion.'" value="'.$reponse->getid().'"></td>';
                    }
                else if($_REQUEST["typeEval"] == 2){
                    $content = $content. 
                    '
                        <tr class="itemHover" onclick="ReponseChoisie(this)">
                            <td>'.$reponse->getTexte().'</td>
                        </tr>
                    ';
                }  
            }
        }
        
        return $content;
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

        '.Identification($bdd).'';

        if($_REQUEST["typeEval"] == 1){
            $content = $content.
            '
                '.QuestionsGrille($bdd, $queryQuestion, $queryReponse, $queryReponseChoisie, $queryCategorie).'
            ';
        }
        else if($_REQUEST["typeEval"] == 2){
            $content = $content.
            '
                '.QuestionChoixReponse($bdd, $eval).'
            ';
        }
        
        $content = $content .
        '<div class="navigateurEval">
            <input id="gauche" class="bouton" style="width : 150px; float: left;" type="button" value="Précédent" onclick="ChangerItem(this)"/>
            '.LettreNav($bdd, $eval).'
            <input id="droite" class="bouton" style="width : 150px; float: right" type="button" value="Suivant" onclick="ChangerItem(this)"/>
            <input id="confirmer" class="bouton" style="width : 150px; float: right" type="button" value="Confirmer" onclick="Execute(4, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Eval\', \'&post=true\', \'&idEvaluation=\', '.$_REQUEST["idEvaluation"].', \'&idStagiaire=\', '.$_REQUEST["idStagiaire"].'); Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Main\')" hidden/>
        </div>

        <br/><br/>

        <input class="bouton" type="button" value="   Retour   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$profil["IdSuperviseur"].'&nomMenu=Main\')"/>
    </article>';

    return $content;

?>
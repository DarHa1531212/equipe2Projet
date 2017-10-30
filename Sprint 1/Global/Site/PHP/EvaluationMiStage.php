<?php 
      include 'Session.php'; 
      include 'ConnexionBD.php';
      
                

                
                    echo '<form onsubmit="return valider();" method="post" action="EvaluationPost.php">';


                    $requeteReponses = $bdd->prepare('select distinct(IdReponse), DescriptionReponse
                                                        from vEvaluations
                                                        where IdEvaluation = :IdEvaluation and IdCategorieQuestion = :IdCategorieQuestion ');


                    $requeteQuestions = $bdd->prepare('select distinct(IdQuestion), DescriptionQuestion
                                                        from vEvaluations
                                                        where IdEvaluation = :IdEvaluation and IdCategorieQuestion = :IdCategorieQuestion
                                                        order by IdQuestion ASC');


                    $requeteCategories = $bdd->prepare('select distinct(IdCategorieQuestion),DescriptionCategorie
                                                        from vEvaluations
                                                        where IdEvaluation = :IdEvaluation
                                                        order by IdCategorieQuestion ASC;');

                    $requeteReponsesChoisie = $bdd->prepare('select IdReponse
                                                                from vEvaluationQuestionReponse
                                                                where IdEvaluation = :IdEvaluation AND IdQuestion = :IdQuestion;');

                    $requeteStatutEvaluation = $bdd->prepare('select distinct(Statut)
                                                                from vEvaluations
                                                                where IdEvaluation = :IdEvaluation;');




                    $requeteCategories->execute(array('IdEvaluation'=>$_POST['IdEvaluation']));

                    $requeteStatutEvaluation->execute(array('IdEvaluation'=>$_POST['IdEvaluation']));



                    $categoriesQuestion = $requeteCategories->fetchAll();

                    foreach($categoriesQuestion as $categorie)
                    {
                        

                        $requeteReponses->execute(array('IdEvaluation'=>$_POST['IdEvaluation'],'IdCategorieQuestion'=> $categorie['IdCategorieQuestion']));

                        $requeteQuestions->execute(array('IdEvaluation'=>$_POST['IdEvaluation'],'IdCategorieQuestion'=> $categorie['IdCategorieQuestion']));

                                                
                        $reponses = $requeteReponses->fetchAll();

                        $questions = $requeteQuestions->fetchAll();
                        

                            echo '  <div class="enteteCategorieQuestion" id="descriptionCategorie'.$categorie['IdCategorieQuestion'].'">
                                        <h3>'.$categorie['DescriptionCategorie'].'</h3>
                                    </div>

                                    <div class="categories" id="categorie'.$categorie['IdCategorieQuestion'].'"  >
                                    <table class="table tbEvaluation">
                                        <thead>
                                         <tr>
                                          <th class="critere">Critères</th>';

                        foreach($reponses as $reponse)
                        {
                            echo '<th class="critere reponse">'.$reponse['DescriptionReponse'].'</th>';
                        }

                        echo '</tr>
                        </thead>
                        <tbody class="bodyQuestions">';

                        foreach($questions as $question)
                        {
                            
                            echo '<tr><td class="critere">'.$question['DescriptionQuestion'].'</td>';

                             $requeteReponsesChoisie->execute(array('IdEvaluation'=>$_POST['IdEvaluation'], 'IdQuestion'=> $question['IdQuestion']));

                             $reponseChoisie = $requeteReponsesChoisie->fetchAll();


                                foreach ($reponses as $reponse) 
                                {

                                    if($reponseChoisie[0]['IdReponse'] == $reponse['IdReponse'])
                                    {
                                        echo '<td><input type="radio" name="question'.$question['IdQuestion'].'" value="'.$reponse['IdReponse'].'" checked = "checked" ></td>';
                                    }
                                    else
                                    {
                                         echo '<td><input type="radio" name="question'.$question['IdQuestion'].'" value="'.$reponse['IdReponse'].'"></td>';
                                    }
                                   
                                }

                                  echo '</tr>';
                        }

                            echo '</tbody>
                                    </table>
                                </div>';

                    }

                   
                
                   echo '<div class="btnSectionContainer">

                        <div class="btnContainer">';

                          

                                $i=0;

                                $listeAlphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N');

                                foreach($categoriesQuestion as $categorie)
                                {
                                    echo '<input type="button" class="btnSectionEval lettreCategories" value="'.$listeAlphabet[$i].'"/>';

                                    $i++;
                                }


                            
                             

                        echo '</div>

                        <div class="btnContainer">

                                 <button type="button" class="btnNextSection" id="boutonPrecedent" onclick="afficheCategoriePrecedente()"> PRECEDENT </button> 
                                    
                                <button type="button" class="btnNextSection" id="boutonSuivant" onclick="afficheCategorieSuivante()"> SUIVANT </button>
          
              
                        </div>

                         
                            <input type="hidden" value="'.$_POST['IdEvaluation'].'" name="IdEvaluation"/>
                        


                        

                        <div class="btnContainer">';

                           

                            $statutEvaluation = $requeteStatutEvaluation->fetchAll();

                               if($statutEvaluation == '1' || $statutEvaluation == '2')//pas débuté ou en retard
                               {
                                    echo '<input type="submit" class="btnSectionEval btnNextSection" value="Valider" id="boutonValider"/>';
                               }

                          
                            

                        echo '</div>

                    </div>

               </form>';
?>



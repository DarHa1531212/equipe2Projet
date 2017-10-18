<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Évaluation des stages</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="CSS/style.css">
        <link rel="stylesheet" media="screen and (max-width: 1240px)" href="CSS/style-1240px.css" />
        <link rel="stylesheet" media="screen and (max-width: 1040px)" href="CSS/style-1040px.css" />
        <link rel="stylesheet" media="screen and (max-width: 735px)" href="CSS/style-735px.css" />
    </head>
    
    <body onload="chargementPage()">
        <header>
            <aside class="left">
                <img id="logo" src="Images/LogoDICJ2.png"/>
            </aside>
            
            <div class="conteneur">
            
            </div>
            
            <aside class="right "id="profil">
                <a class="zoneCliquable" href="ProfilEntreprise.html">
                    <h3>Bonjour</h3>
                    <h3>Martin Mystère</h3>
                </a>
            </aside>
        </header>
        
        <content>
            <div class="conteneur">
                <div class="entete">
                    <h1>Description</h1>
                </div>
                
                <p class="description">
                    La première évaluation servira à noter de façon générale l’élève stagiaire en vue d'un réajustement possible. Il serait grandement souhaitable que cette évaluation se fasse conjointement avec l’élève stagiaire et que la démarche s'effectue de façon formative. Une fois complété, le formulaire devra être remis à votre stagiaire qui se chargera de nous l'expédier. 
                </p>
            </div>
            
            <div class="conteneur">
                <div class="entete">
                    <h1>Identification</h1>
                </div>
                
                <table class="table tableIdentification">
                    <tbody>
                        <tr>
                            <td class="rowTitle">
                                Organisation
                            </td>
                            
                            <td>
                                Test
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="rowTitle">
                                Responsable technique
                            </td>
                            
                            <td>
                                Test
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="rowTitle">
                                Responsable pédagogique
                            </td>
                            
                            <td>
                                Test
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="rowTitle">
                                Élève stagiaire
                            </td>
                            
                            <td>
                                Test
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

           
            
            <div class="conteneur" id="conteneurEvaluation">

                <div class="entete">
                    <h1>Évaluation</h1>
                </div>

                <form onsubmit="return valider();" method="post" action="evaluationPost.php">

                 <?php



                    include 'PHP/ConnexionBD.php';


                    $requeteReponses = $bd->prepare('select distinct(RE.Id), RE.Texte
                                                    FROM tblQuestionGrille AS QG
                                                    JOIN tblReponseQuestionGrille AS RQG
                                                    ON QG.Id = RQG.IdQuestionGrille
                                                    JOIN tblReponse AS RE
                                                    ON RE.Id = RQG.IdReponse
                                                    WHERE QG.idCategorieQuestion = :idCategorieQuestion');

                    $requeteQuestions = $bd->prepare('select QG.Id,QG.Texte
                                                    FROM tblQuestionGrille AS QG
                                                    WHERE QG.idCategorieQuestion = :idCategorieQuestion');


                    $requeteCategories = $bd->prepare('select * from tblCategorieQuestion');


                    $requeteCategories->execute();

                    $i=1;

                    while (($categorie = $requeteCategories->fetch()) and ($i<=7))
                    {

                        $indiceQuestion = 0;

                        $indiceReponse = 0;

                        $requeteReponses->execute(array('idCategorieQuestion'=> $categorie['Id']));

                        $requeteQuestions->execute(array('idCategorieQuestion'=> $categorie['Id']));

                                                
                        $reponses = $requeteReponses->fetchAll();

                        $questions = $requeteQuestions->fetchAll();
                        

                            echo '  <div class="enteteCategorieQuestion" id="descriptionCategorie'.$i.'">
                                        <h3>'.$categorie['descriptionCategorie'].'</h3>
                                    </div>

                                    <div id="categorie'.$i.'">
                                    <table class="table tbEvaluation">
                                        <thead>
                                         <tr>
                                          <th class="critere">Critères</th>';

                        foreach($reponses as $reponse)
                        {
                            echo '<th class="critere reponse">'.$reponse['Texte'].'</th>';
                        }

                        echo '</tr>
                        </thead>
                        <tbody>';

                        foreach($questions as $question)
                        {
                            $indiceQuestion++;

                            $indiceReponse=0;

                            echo '<tr><td class="critere">'.$question['Texte'].'</td>';

                                foreach ($reponses as $reponse) 
                                {
                                    $indiceReponse++;

                                    echo '<td><input type="radio" name="question'.$question['Id'].'" value="'.$reponse['Id'].'"></td>';
                                }

                                  echo '</tr>';
                        }

                            echo '</tbody>
                                    </table>
                                </div>';

                        $i++;

                    }
                ?>
               
                    <div class="btnSectionContainer">

                        <div class="btnNomSectionContainer">

                            <?php

                                $listeAlphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N');

                                for($i=0;$i<=6;$i++)
                                {
                                    echo '<input type="button" onclick="afficheCategorie('.($i+1).')" class="btnSectionEval" value="'.$listeAlphabet[$i].'"/>';
                                }

                            ?>

                        </div>
                         
                        <div  class="btnContainer">
                            <input type="submit" class="btnSectionEval btnNextSection" value="Valider" id="boutonValider"/>
                        </div>

                    </div>

               </form>

            </div>

        </content>
        
        <footer>
        
        </footer>

        <script src="js/scripts.js"></script>
    </body>
</html>
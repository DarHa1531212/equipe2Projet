<?php

    include 'Session.php'; 
    
    try
    {
        $bd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_dev','cegepjon_p2017_2','madfpfadshdb',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }


    $requeteModificationEvaluationQuestionReponse = $bd->prepare('update tblEvaluationQuestionReponse SET IdReponse = :IdReponse
    WHERE IdEvaluation = :IdEvaluation AND IdQuestion = :IdQuestion;');

    $requeteModifierStatutEvaluation = $bd->prepare('update tblEvaluation set Statut= \'3\', DateComplétée=:DateCompletee where Id=:IdEvaluation;');
    

     $requeteQuestions = $bd->prepare('select distinct(IdQuestion), DescriptionQuestion
                                        from vEvaluations
                                        where IdEvaluation = :IdEvaluation and IdCategorieQuestion = :IdCategorieQuestion
                                        order by IdQuestion ASC;');

      $requeteCategories = $bd->prepare('select distinct(IdCategorieQuestion),TitreCategorie
                                        from vEvaluations
                                        where IdEvaluation = :IdEvaluation
                                        order by IdCategorieQuestion ASC;');

      //$requeteInsertionEvaluation->execute(array('Statut'=>0,'IdTypeEvaluation'=>1));

      $requeteCategories->execute(array('IdEvaluation'=>$_SESSION['IdEvaluation']));

      $requeteModifierStatutEvaluation->execute(array('IdEvaluation'=>$_SESSION['IdEvaluation'],'DateCompletee'=>date("Y-m-d")));

      $categoriesQuestion = $requeteCategories->fetchAll();

      foreach($categoriesQuestion as $categorie)
      {
              $requeteQuestions->execute(array('IdEvaluation'=>$_SESSION['IdEvaluation'],'IdCategorieQuestion'=> $categorie['IdCategorieQuestion']));

              $questions = $requeteQuestions->fetchAll();

              foreach($questions as $question)
              {
                  $idReponse = htmlspecialchars($_POST['question'.$question['IdQuestion']]);   

                  $requeteModificationEvaluationQuestionReponse->execute(array('IdEvaluation'=>$_SESSION['IdEvaluation'],'IdQuestion'=>$question['IdQuestion'],'IdReponse'=>$idReponse));
              }

      }

      header('Location:TBEntreprise.php'); 

?>
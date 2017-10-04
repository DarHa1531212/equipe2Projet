<?php
    
   
    $i=1;

    try
    {
        $bd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_tests','cegepjon_p2017_2','madfpfadshdb',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }


    //$requeteInsertionEvaluation = 'insert into tblEvaluation(Statut, IdTypeEvaluation) values (:Statut,:IdTypeEvaluation)';

    //$requeteInsertionEvaluationQuestionGrille = $bd->prepare('insert into tblQuestionGrilleEvaluation(IdEvaluation, IdQuestionGrille, IdReponse) values (:IdEvaluation,:IdQuestionGrille,:IdReponse)');

    
    $requeteModificationEvaluationQuestionGrille = $bd->prepare('update tblQuestionGrilleEvaluation SET IdReponse = :IdReponse
    WHERE IdEvaluation = :IdEvaluation AND IdQuestionGrille = :IdQuestionGrille;');
    

    $requeteQuestions = $bd->prepare('select QG.Id,QG.Texte
                                        FROM tblQuestionGrille AS QG
                                        WHERE QG.idCategorieQuestion = :idCategorieQuestion');

     $requeteCategories = $bd->prepare('select * from tblCategorieQuestion');

     //$requeteInsertionEvaluation->execute(array('Statut'=>0,'IdTypeEvaluation'=>1));

     $requeteCategories->execute();

     while (($categorie = $requeteCategories->fetch()) and ($i<=7))
     {

        $requeteQuestions->execute(array('idCategorieQuestion'=> $categorie['Id']));

        $questions = $requeteQuestions->fetchAll();

        foreach($questions as $question)
        {
            $idReponse = htmlspecialchars($_POST['question'.$question['Id']]);   

            $requeteModificationEvaluationQuestionGrille->execute(array('IdEvaluation'=>1,'IdQuestionGrille'=>$question['Id'],'IdReponse'=>$idReponse));
        }

        $i++;

     }

     header('Location:EvaluationStage.php'); 

    //Script pour updater les evaluations

    //UPDATE tblQuestionGrilleEvaluation SET IdReponse = 2
    //WHERE IdEvaluation = 1 AND IdQuestionGrille = 2;
?>
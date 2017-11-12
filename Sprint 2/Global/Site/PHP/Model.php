<?php
    
    class Evaluation{
        private $questions = array();
        private $reponses = array();
        private $categories = array();
        private $statut, $dateCompletee, $dateDebut, $dateFin, $idTypeEval;
        
        public function __construct($bdd, $id){
            $this->Initialise($bdd, $id);
        }
        
        //Initialise l'évaluation.
        private function Initialise($bdd, $id){
            $query = $bdd->prepare('SELECT *
                                    FROM vEvaluation
                                    WHERE Id = :idEvaluation');
            
            $query->execute(array('idEvaluation'=>$id));
            
            $evaluations = $query->fetchAll();
            
            foreach($evaluations as $evaluation){
                $this->statut = $evaluation["Statut"];
                $this->dateCompletee = $evaluation["DateComplétée"];
                $this->dateDebut = $evaluation["DateDébut"];
                $this->dateFin = $evaluation["DateFin"];
                $this->idTypeEval = $evaluation["IdTypeEvaluation"];                
            }
            
            $this->SelectQuestions($bdd, $id);
            $this->SelectCategories($bdd, $id);
        }
        
        //Sélectionne les réponses sélectionnées pour chaque questions.
        private function SelectReponse($bdd, $id, $idQuestion){
            $query = $bdd->prepare('SELECT IdReponse, R.Texte
                                    FROM vEvaluationQuestionReponse AS EQR
                                    JOIN vReponse AS R
                                    ON R.Id = EQR.IdReponse
                                    WHERE IdEvaluation = :idEvaluation AND IdQuestion = :idQuestion;');
            
            $query->execute(array('idEvaluation'=>$id, 'idQuestion'=>$idQuestion));
            
            $reponses = $query->fetchAll();
            
            foreach($reponses as $reponse){
                array_push($this->reponses, new Reponse($reponse["IdReponse"], $reponse["Texte"]));
            }
        }
        
        //Sélectionne toutes les questions pour l'évaluation.
        private function SelectQuestions($bdd, $id){
            $query = $bdd->prepare('SELECT *
                                    FROM vQuestion AS Q
                                    JOIN vEvaluationQuestionReponse AS EQR
                                    ON EQR.IdQuestion = Q.Id
                                    WHERE EQR.IdEvaluation = :idEvaluation');
            
            $query->execute(array('idEvaluation'=>$id));
            
            $questions = $query->fetchAll();
            
            foreach($questions as $question){
                array_push($this->questions, new Question($bdd, $question["Id"], $question["Texte"]));
                $this->SelectReponse($bdd, $id, $question["Id"]);
            }
        }
        
        //Sélectionne toutes les catégories présentes dans l'évaluation.
        private function SelectCategories($bdd, $id){
            $query = $bdd->prepare('SELECT DISTINCT(CQ.Id) AS IdCategorie, TitreCategorie, Lettre, descriptionCategorie
                                    FROM vQuestion AS Q
                                    JOIN vCategorieQuestion AS CQ
                                    ON CQ.Id = Q.IdCategorieQuestion
                                    JOIN vEvaluationQuestionReponse AS EQR
                                    ON EQR.IdQuestion = Q.Id
                                    WHERE IdEvaluation = :idEvaluation');
            
            $query->execute(array('idEvaluation'=>$id));
            
            $categories = $query->fetchAll();
            
            foreach($categories as $categorie){
                array_push($this->categories, new CategorieQuestion($categorie["IdCategorie"], $categorie["TitreCategorie"], $categorie["Lettre"], $categorie["descriptionCategorie"]));
            }
        }
        
        public function getCategories(){
            return $this->categories;
        }
        
        public function getQuestions(){
            return $this->questions;
        }    
        
        public function getReponses(){
            return $this->reponses;
        }        
        
        public function getStatut(){
            return $this->statut;
        }     
        
        public function getDateCompletee(){
            return $this->dateCompletee;
        }    
        
        public function getDateDebut(){
            return $this->dateDebut;
        }   
        
        public function getDateFin(){
            return $this->dateFin;
        }   
        
        public function getIdTypeEval(){
            return $this->idTypeEval;
        }
    }

    class Question{
        
        private $reponses = array();
        private $id, $texte, $categorie;
        
        function __construct($bdd, $id, $texte){
            $this->id = $id;
            $this->texte = $texte;
            $this->SelectReponses($bdd, $id);
            $this->SelectCategorie($bdd, $id);
        }
        
        //Sélectionne toutes les catégories lié à la question.
        private function SelectCategorie($bdd, $id){
            $query = $bdd->prepare('SELECT DISTINCT(CQ.Id) AS IdCategorie, TitreCategorie, Lettre, descriptionCategorie
                                    FROM vQuestion AS Q
                                    JOIN vCategorieQuestion AS CQ
                                    ON CQ.Id = Q.IdCategorieQuestion
                                    WHERE Q.Id = :idQuestion');
            
            $query->execute(array("idQuestion"=>$id));
            
            $categories = $query->fetchAll();
            
            $this->categorie = new CategorieQuestion($categories[0]["IdCategorie"], $categories[0]["TitreCategorie"], $categories[0]["Lettre"], $categories[0]["descriptionCategorie"]);
        }
        
        //Sélectionne toutes les réponses possibles pour la question.
        private function SelectReponses($bdd, $id){
            $query = $bdd->prepare('SELECT Q.Id AS IdQuestion, Q.Texte AS TexteQuestion, R.Id AS IdReponse, R.Texte AS TexteReponse
                                    FROM vQuestion AS Q
                                    JOIN vReponseQuestion AS RQ
                                    ON RQ.IdQuestion = Q.Id
                                    JOIN vReponse AS R
                                    ON R.Id = RQ.IdReponse
                                    WHERE IdQuestion = :idQuestion');
            
            $query->execute(array('idQuestion'=>$id));
            
            $reponses = $query->fetchAll();
            
            foreach($reponses as $reponse){
                array_push($this->reponses, new Reponse($reponse["IdReponse"], $reponse["TexteReponse"]));
            }
        }
        
        public function getId(){
            return $this->id;
        }
        
        public function getTexte(){
            return $this->texte;
        }   
        
        public function getCategorie(){
            return $this->categorie;
        }
        
        public function getReponses(){
            return $this->reponses;
        }
    }

    class CategorieQuestion{
        
        private $id, $titre, $lettre, $description;
        
        function __construct($id, $titre, $lettre, $description){
            $this->id = $id;
            $this->titre = $titre;
            $this->lettre = $lettre;
            $this->description = $description;
        }
        
        public function getId(){
            return $this->id;
        }
        
        public function getTitre(){
            return $this->titre;
        }
        
        public function getLettre(){
            return $this->lettre;
        }
        
        public function getDescription(){
            return $this->description;
        }
    }

    class Reponse{
        
        private $id;
        private $texte;
        
        function __construct($id, $texte){
            $this->id = $id;
            $this->texte = $texte;
        }
        
        public function getId(){
            return $this->id;
        }
        
        public function getTexte(){
            return $this->texte;
        }
    }

?>
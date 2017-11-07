<?php
    
    class Evaluation{
        private $questions = array();
        private $reponses = array();
        private $statut, $dateCompletee, $dateDebut, $dateFin, $idTypeEval;
        
        public function __construct($bdd, $id){
            $this->Initialise($bdd, $id);
        }
        
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
        }
        
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
            }
        }
        
        public function getQuestions(){
            return $this->questions;
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
        
        private $id;
        private $texte;
        private $reponses = array();
        
        function __construct($bdd, $id, $texte){
            $this->id = $id;
            $this->texte = $texte;
            $this->SelectReponses($bdd, $id);
        }
        
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
        
        public function getReponses(){
            return $this->reponses;
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
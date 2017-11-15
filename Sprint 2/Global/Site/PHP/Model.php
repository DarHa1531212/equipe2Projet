<?php

    class EvaluationChoixReponse extends Evaluation{
        
        public function __construct($bdd, $id){
            parent::__construct($bdd, $id);
            $this->SelectQuestions($bdd, $id);
        }
        
        //Sélectionne toutes les catégories pour chaque question.
        private function SelectCategories($bdd, $idQuestion){
            unset($this->categories);
            $this->categories = array();
            
            $query = $bdd->prepare('SELECT DISTINCT(CQ.Id) AS IdCategorie, TitreCategorie, Lettre, descriptionCategorie
                                    FROM vQuestion AS Q
                                    JOIN vCategorieQuestion AS CQ
                                    ON CQ.Id = Q.IdCategorieQuestion
                                    JOIN vEvaluationQuestionReponse AS EQR
                                    ON EQR.IdQuestion = Q.Id
                                    WHERE IdQuestion = :idQuestion');
            
            $query->execute(array('idQuestion'=>$idQuestion));
            
            $categories = $query->fetchAll();
            
            foreach($categories as $categorie){
                array_push($this->categories, new CategorieQuestion($categorie["IdCategorie"], $categorie["TitreCategorie"], $categorie["Lettre"], $categorie["descriptionCategorie"]));
            }
        }
        
        //Sélectionne toutes les questions pour l'évaluation.
        private function SelectQuestions($bdd, $idEvaluation){
            unset($this->questions);
            $this->questions = array();

            $query = $bdd->prepare('SELECT DISTINCT(Id), Q.Texte
                                    FROM vQuestion AS Q
                                    JOIN vEvaluationQuestionReponse AS EQR
                                    ON EQR.IdQuestion = Q.Id
                                    WHERE EQR.IdEvaluation = :idEvaluation');
            
            $query->execute(array('idEvaluation'=>$idEvaluation));
            
            $questions = $query->fetchAll();
            
            foreach($questions as $question){
                array_push($this->questions, new Question($question["Id"], $question["Texte"]));
            }
        }
        
        //Affiche l'évaluation.
        public function DrawEvaluation($bdd){
            $content = "";
        
            foreach($this->questions as $question){
                $this->SelectCategories($bdd, $question->getId());
                    
                $content = $content.
                '<div class="categories">
                    <div class="separateur" id="question">
                        <h3>'.$this->categories[0]->getLettre().' '.$this->categories[0]->getTitre().'</h3>
                        <p> 
                            '.$question->getTexte().'
                        </p>
                    </div>
                    <table class="evaluation2">
                        <tbody>          
                                '.$this->AfficheReponse($bdd, $question).'
                        </tbody>
                    </table>
                </div>';
            }

            return $content;
        }
        
        //Affiche les réponses.
        private function AfficheReponse($bdd, $question){
            $content = "";
            
            $this->SelectReponses($bdd, $question->getId());
            
            foreach($this->reponses as $reponse){   
                $content = $content. 
                '
                    <tr class="itemHover" onclick="reponse'.$reponse->getId().'.checked = true;">
                        <td>
                            '.$reponse->getTexte().'
                            <input type="radio" id="reponse'.$reponse->getId().'" name="question'.$question->getId().'" value="'.$reponse->getId().'"/>
                        </td>
                    </tr>
                ';
            }
            
            return $content;
        }
    }

    class EvaluationGrille extends Evaluation{
        
        public function __construct($bdd, $id){
            parent::__construct($bdd, $id);
            $this->SelectCategories($bdd, $id);
        }
        
        //Sélectionne toutes les catégories pour l'évaluation.
        private function SelectCategories($bdd, $idEvaluation){
            $query = $bdd->prepare('SELECT DISTINCT(CQ.Id) AS IdCategorie, TitreCategorie, Lettre, descriptionCategorie
                                    FROM vQuestion AS Q
                                    JOIN vCategorieQuestion AS CQ
                                    ON CQ.Id = Q.IdCategorieQuestion
                                    JOIN vEvaluationQuestionReponse AS EQR
                                    ON EQR.IdQuestion = Q.Id
                                    WHERE IdEvaluation = :idEvaluation');
            
            $query->execute(array('idEvaluation'=>$idEvaluation));
            
            $categories = $query->fetchAll();
            
            foreach($categories as $categorie){
                array_push($this->categories, new CategorieQuestion($categorie["IdCategorie"], $categorie["TitreCategorie"], $categorie["Lettre"], $categorie["descriptionCategorie"]));
            }
        }
        
        //Sélectionne toutes les questions pour la catégorie.
        private function SelectQuestions($bdd, $idEvaluation, $idCategorie){
            unset($this->questions);
            $this->questions = array();

            $query = $bdd->prepare('SELECT DISTINCT(Id), Q.Texte
                                    FROM vQuestion AS Q
                                    JOIN vEvaluationQuestionReponse AS EQR
                                    ON EQR.IdQuestion = Q.Id
                                    WHERE EQR.IdEvaluation = :idEvaluation AND Q.IdCategorieQuestion = :idCategorieQuestion');
            
            $query->execute(array('idEvaluation'=>$idEvaluation, 'idCategorieQuestion'=>$idCategorie));
            
            $questions = $query->fetchAll();
            
            foreach($questions as $question){
                array_push($this->questions, new Question($question["Id"], $question["Texte"]));
            }
        }
        
        //Affiche l'évaluation.
        public function DrawEvaluation($bdd){
            $content = "";
        
            foreach($this->categories as $categorie){
                $this->SelectQuestions($bdd, $this->id, $categorie->getId());
                    
                $content = $content.
                '
                <div class="categories">
                    <div class="separateur" id="question">
                        <h3>'.$categorie->getLettre().'. '.$categorie->getTitre().'</h3>
                        <p> 
                            '.$categorie->getDescription().'
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

                        <tbody>
                            '.$this->AfficherQuestion($bdd).'
                        </tbody>
                    </table>
                </div>
                ';
            }

            return $content;
        }
        
        //Affiche les questions.
        private function AfficherQuestion($bdd){
            $content = "";
            
            foreach($this->questions as $question){
                $content = $content.
                '<tr>
                    <td>'.$question->getTexte().'</td>
                    '.$this->AfficheReponse($bdd, $question).'
                </tr>';
            } 
            
            return $content;
        }
        
        //Affiche les réponses.
        private function AfficheReponse($bdd, $question){
            $content = "";
            
            $this->SelectReponses($bdd, $question->getId());
            
            foreach($this->reponses as $reponse){   
                $this->SelectReponsesChoisies($bdd, $this->id, $question->getId());
                
                if($reponse->getId() == $this->reponsesChoisies[0]->getId())
                    $content = $content.'<td><input type="radio" id="question'.$question->getId().'" name="question'.$question->getId().'" value="'.$reponse->getId().'" checked = "checked" ></td>';
                else
                    $content = $content.'<td><input type="radio" name="question'.$question->getId().'" value="'.$reponse->getid().'"></td>';
            }
            
            return $content;
        }
    }

    class Evaluation{
        protected $questions = array();
        protected $reponses = array();
        protected $categories = array();
        protected $reponsesChoisies = array();
        protected $id, $statut, $titre, $dateCompletee, $dateDebut, $dateFin, $idTypeEval;
        
        public function __construct($bdd, $id){
            $this->id = $id;
            $this->Initialise($bdd, $id);
        }
        
        //Initialise l'évaluation.
        private function Initialise($bdd, $id){
            $query = $bdd->prepare('SELECT *
                                    FROM vEvaluation AS Eval
                                    JOIN vTypeEvaluation AS TE
                                    ON TE.Id = Eval.IdTypeEvaluation
                                    WHERE Eval.Id = :idEvaluation');
            
            $query->execute(array('idEvaluation'=>$id));
            
            $evaluations = $query->fetchAll();
            
            foreach($evaluations as $evaluation){
                $this->titre = $evaluation["Titre"];
                $this->statut = $evaluation["Statut"];
                $this->dateCompletee = $evaluation["DateComplétée"];
                $this->dateDebut = $evaluation["DateDébut"];
                $this->dateFin = $evaluation["DateFin"];
                $this->idTypeEval = $evaluation["IdTypeEvaluation"];                
            }
        }
        
        //Sélectionne toutes les réponses pour chaque question.
        protected function SelectReponses($bdd, $idQuestion){
            unset($this->reponses);
            $this->reponses = array();
            
            $query = $bdd->prepare('SELECT Q.Id AS IdQuestion, Q.Texte AS TexteQuestion, R.Id AS IdReponse, R.Texte AS TexteReponse
                                    FROM vQuestion AS Q
                                    JOIN vReponseQuestion AS RQ
                                    ON RQ.IdQuestion = Q.Id
                                    JOIN vReponse AS R
                                    ON R.Id = RQ.IdReponse
                                    WHERE IdQuestion = :idQuestion');
            
            $query->execute(array('idQuestion'=>$idQuestion));
            
            $reponses = $query->fetchAll();
            
            foreach($reponses as $reponse){
                array_push($this->reponses, new Reponse($reponse["IdReponse"], $reponse["TexteReponse"]));
            }
        }
        
        //Sélectionne toutes les réponses choisies pour chaque question.
        protected function SelectReponsesChoisies($bdd, $idEvaluation, $idQuestion){
            unset($this->reponsesChoisies);
            $this->reponsesChoisies = array();
            
            $query = $bdd->prepare('SELECT IdReponse, R.Texte
                                    FROM vEvaluationQuestionReponse AS EQR
                                    JOIN vReponse AS R
                                    ON R.Id = EQR.IdReponse
                                    WHERE IdEvaluation = :idEvaluation AND IdQuestion = :idQuestion;');
            
            $query->execute(array('idEvaluation'=>$idEvaluation, 'idQuestion'=>$idQuestion));
            
            $reponses = $query->fetchAll();
            
            foreach($reponses as $reponse){
                array_push($this->reponsesChoisies, new Reponse($reponse["IdReponse"], $reponse["Texte"]));
            }
        }
        
        //Sauvegarde les modifications dans la BD.
        public function Submit($bdd){
            $reponses = json_decode($_POST["tabReponse"], true);

            $requeteModificationEvaluationQuestionReponse = $bdd->prepare(  'update tblEvaluationQuestionReponse SET IdReponse = :IdReponse
                                                                            WHERE IdEvaluation = :IdEvaluation AND IdQuestion = :IdQuestion;');

            $requeteModifierStatutEvaluation = $bdd->prepare('update tblEvaluation set Statut= \'3\', DateComplétée=:DateCompletee where Id=:IdEvaluation;');

            $requeteModifierStatutEvaluation->execute(array('IdEvaluation'=>$_REQUEST['idEvaluation'],'DateCompletee'=>date("Y-m-d")));

            foreach($reponses as $reponse){
                $requeteModificationEvaluationQuestionReponse->execute(array('IdEvaluation'=>$this->id,'IdQuestion'=>$reponse["idQuestion"],'IdReponse'=>$reponse["value"]));
            }  
        }    
        
        public function getCategories(){
            return $this->categories;
        }
        
        public function getId(){
            return $this->id;
        }          
        
        public function getTitre(){
            return $this->titre;
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
        
        private $id, $texte;
        
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
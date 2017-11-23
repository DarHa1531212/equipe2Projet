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
                        <tbody id="ancre">          
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
                        <thead id="ancre">
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


    class Profil{
        
        protected $id, $nom, $prenom, $numTel, $codePermanent, $poste, $courriel, $entreprise;
            
        public function __construct($id, $bdd){
            $this->id = $id;
        }
        
        public function getId(){
            return $this->id;
        }
        
        public function getNom(){
            return $this->nom;
        }
        
        public function getPrenom(){
            return $this->prenom;
        }
        
        public function getNumTel(){
            return $this->numTel;
        }
        
        public function getCodePermanent(){
            return $this->codePermanent;
        }
        
        public function getPoste(){
            return $this->poste;
        }
        
        public function getCourriel(){
            return $this->courriel;
        }
        
        public function getEntreprise(){
            return $this->entreprise;
        }
    }

    class ProfilEmploye extends Profil{
        
        private $idRole;
        
        public function __construct($id, $bdd){
            parent::__construct($id, $bdd);
            $this->Initialise($id, $bdd);
        }
        
        //Initialise les données du profil.
        private function Initialise($id, $bdd){
            $query = $bdd->prepare("SELECT Emp.IdUtilisateur, Prenom, Emp.Nom, Emp.NumTel, CourrielPersonnel, IdRole,
                                    Ent.Nom AS 'Nom Entreprise', Emp.CourrielEntreprise, Emp.NumTelEntreprise, Poste, CodePermanent
                                    FROM vEmploye AS Emp
                                    JOIN vEntreprise AS Ent
                                    ON Ent.Id = Emp.IdEntreprise
                                    JOIN vUtilisateurRole AS UR
                                    ON UR.IdUtilisateur = Emp.IdUtilisateur
                                    WHERE Emp.IdUtilisateur = :id");
            
            $query->execute(array("id"=>$id));
            $profil = $query->fetchAll();
            
            $this->nom = $profil[0]["Nom"];
            $this->prenom = $profil[0]["Prenom"];
            $this->numTel = $profil[0]["NumTelEntreprise"];
            $this->codePermanent = $profil[0]["CodePermanent"];
            $this->poste = $profil[0]["Poste"];
            $this->courriel = $profil[0]["CourrielEntreprise"];
            $this->entreprise = $profil[0]["Nom Entreprise"];
            $this->idRole = $profil[0]["IdRole"];
        }
        
        //Affiche les informations du profil.
        public function AfficherProfil(){
            $content =
            '
            <div class="separateur">
                <h3>Informations</h3>
            </div>

            <div class="blocInfo infoProfil">
                <div class="champ">
                    <p class="label">Prenom :</p>
                    <p class="value">'.$this->getPrenom().'</p>
                </div>

                <div class="champ">
                    <p class="label">Nom :</p>
                    <p class="value">'.$this->getNom().'</p>
                </div>

                <div class="champ">
                    <p class="label">Entreprise :</p>
                    <p class="value">'.$this->getEntreprise().'</p>
                </div>

                <div class="champ">
                    <p class="label">Courriel :</p>
                    <p class="value">'.$this->getCourriel().'</p>
                </div>

                <div class="champ">
                    <p class="label">No. Téléphone :</p>
                    <p class="value">'.$this->getNumTel().'</p>
                </div>

                <div class="champ">
                    <p class="label">Poste :</p>
                    <p class="value">'.$this->getPoste().'</p>
                </div>
            </div>
            ';
            return $content;
        }
        
        public function getIdRole(){
               return $this->idRole;
        }
    }

    class ProfilStagiaire extends Profil{
        
        private $numTelPerso, $courrielPerso;
        
        public function __construct($id, $bdd){     
            parent::__construct($id, $bdd);
            $this->Initialise($id, $bdd);
        }
        
        //Initialise les données du profil.
        private function Initialise($id, $bdd){
            $query = $bdd->prepare("SELECT Stagiaire.IdUtilisateur, Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTel, Stagiaire.CourrielPersonnel, Stagiaire.CodePermanent,
                                    Stagiaire.CourrielEntreprise, Stagiaire.NumTelEntreprise, Stagiaire.Poste, Ent.Nom AS 'Nom Entreprise'
                                    FROM vStage AS Stage
                                    JOIN vStagiaire AS Stagiaire
                                    ON Stage.Id = Stagiaire.Id
                                    JOIN vEmploye AS Emp
                                    ON Emp.IdUtilisateur = Stage.IdSuperviseur
                                    JOIN vEntreprise AS Ent
                                    ON Ent.Id = Emp.IdEntreprise 
                                    WHERE Stagiaire.IdUtilisateur = :id");
            
            $query->execute(array("id"=>$id));
            $profil = $query->fetchAll();
            
            $this->nom = $profil[0]["Nom"];
            $this->prenom = $profil[0]["Prenom"];
            $this->numTel = $profil[0]["NumTelEntreprise"];
            $this->codePermanent = $profil[0]["CodePermanent"];
            $this->poste = $profil[0]["Poste"];
            $this->courriel = $profil[0]["CourrielEntreprise"];
            $this->entreprise = $profil[0]["Nom Entreprise"];
            $this->numTelPerso = $profil[0]["NumTel"];
            $this->courrielPerso = $profil[0]["CourrielPersonnel"];
        }
        
        //Affiche les informations du profil.
        public function AfficherProfil(){
            $content = 
            '
            <div class="separateur">
                <h3>Informations Personnelles</h3>
            </div>

            <div class="blocInfo infoProfil">
                    <div class="champ">
                        <p class="label">Prenom :</p>
                        <p class="value">'.$this->getPrenom().'</p>
                    </div>

                    <div class="champ">
                        <p class="label">Nom :</p>
                        <p class="value">'.$this->getNom().'</p>
                    </div>

                    <div class="champ">
                        <p class="label">No. Téléphone :</p>
                        <p class="value">'.$this->getNumTelPerso().'</p>
                    </div>

                    <div class="champ">
                        <p class="label">Courriel :</p>
                        <p class="value">'.$this->getCourrielPerso().'</p>
                    </div>
            </div>

            <div class="separateur">
                <h3>Informations Professionnelles</h3>
            </div>

            <div class="blocInfo infoProfil">
                    <div class="champ">
                        <p class="label">Entreprise :</p>
                        <p class="value">'.$this->getEntreprise().'</p>
                    </div>

                    <div class="champ">
                        <p class="label">Courriel :</p>
                        <p class="value">'.$this->getCourriel().'</p>
                    </div>

                    <div class="champ">
                        <p class="label">No. Téléphone :</p>
                        <p class="value">'.$this->getNumTel().'</p>
                    </div>

                    <div class="champ">
                        <p class="label">Poste :</p>
                        <p class="value">'.$this->getPoste().'</p>
                    </div>
            </div>
            ';
            return $content;
        }
        
        public function getNumTelPerso(){
            return $this->numTelPerso;
        }
        
        public function getCourrielPerso(){
            return $this->courrielPerso;
        }
    }

    
    
    /**********************************************************************************************
    *   Classes: cUtilisateur, cStagiaire, cEmployeEntreprise                                     *
    *   But: gérer le CRUD des utilisateurs                                                       *
    *   Note: Va utiliser de l'héritage pour les champs des stagiaires vs des employes            *
    *   Nom: Hans darmstadt-Bélanger                                                              *
    *   date: 23 Novembre 2017                                                                    *
    *   ******************************************************************************************/

    abstract class cAbstractUtilisateur
    {
        //les classes abstraites pour le polymorphisme
        abstract protected function createUtilisateur($bdd, $dataArray);
        abstract protected function readUtilisateur($bdd,$dataArray);
        abstract protected function updateUtilisateur($bdd,$dataArray);
        abstract protected function deleteUtilisateur($bdd,$dataArray);

    }
    

    class cUtilisateur {
        
        private $courrielPrincipal, $id, $prenom, $nom, $noTelPrincipal, $posteTelEntreprise;


        
        }
    class cStagiaire extends cUtilisateur {

        private $noTelEntreprise, $courrielEntreprise, $courrielPersonnel, $codePermanent;

        protected function createUtilisateur($bdd,$dataArray)

            {
                $prenom = $dataArray[1]->value;
                $nom = $dataArray[2]->value;
                $courrielScolaire = $dataArray[3]->value;

                $query = $bdd->prepare("insert into tblStagiaire (Prenom, Nom, CourrielScolaire) Values  ('$prenom' , '$nom' , '$courrielScolaire');");
                $query->execute();
            }

        protected function readUtilisateur($bdd,$dataArray);
        {

            $idStagiaire =  intval ($dataArray[1]->value);
            $returnData = array();

            $query = $bdd->prepare("select 
                                    vStagiaire.Nom as 'NomStagiaire', 
                                    vStagiaire.Prenom as 'PrenomStagiaire'  , 
                                    vStagiaire.CourrielScolaire as 'CourrieScolaire', 
                                    vStagiaire.NumTelEntreprise as 'NumTelEntreprise',
                                    vStagiaire.Poste as 'Poste',
                                    vStagiaire.CourrielEntreprise as 'CourrielEntreprise', 
                                    vStagiaire.CodePermanent as 'CodePermanent', 
                                    vStagiaire.CourrielPersonnel as 'CourrielPersonnel', 
                                    vStagiaire.NumTel as 'NumTelStagiaire', 
                                    vEntreprise.Nom as 'NomEntreprise'
                                    from vStagiaire 
                                    join vStage on vStage.idStagiaire = vStagiaire.IdUtilisateur 
                                    join vSuperviseur on vStage.IdSuperviseur = vSuperviseur.IdUtilisateur 
                                    join vEntreprise on vEntreprise.Id = vSuperviseur.IdEntreprise 
                                    where vStagiaire.IdUtilisateur like :idStagiaire");

            $query->execute(array('idStagiaire'=> $idStagiaire));     
            $entrees = $query->fetchAll();

            foreach($entrees as $entree){

                $NomStagiaire = $entree["NomStagiaire"];
                $PrenomStagiaire = $entree["PrenomStagiaire"];
                $CourrieScolaire = $entree["CourrieScolaire"];
                $NumTelEntreprise = $entree["NumTelEntreprise"];
                $Poste = $entree["Poste"];
                $CourrielEntreprise = $entree["CourrielEntreprise"];
                $CodePermanent = $entree["CodePermanent"];
                $CourrielPersonnel = $entree["CourrielPersonnel"];
                $NumTelStagiaire = $entree["NumTelStagiaire"];
                $NomEntreprise = $entree["NomEntreprise"];

                $returnData [0] = $NomStagiaire;
                $returnData [1] = $PrenomStagiaire;
                $returnData [2] = $CourrieScolaire;
                $returnData [3] = $NumTelEntreprise;
                $returnData [4] = $Poste;
                $returnData [5] = $CourrielEntreprise;
                $returnData [6] = $CodePermanent;
                $returnData [7] = $CourrielPersonnel;
                $returnData [8] = $NumTelStagiaire;
                $returnData [9] = $NomEntreprise;  
            }

        return $returnData;

        }



    }
       

    class cEmployeEntreprise extends cUtilisateur{

        protected function createUtilisateur($bdd,$dataArray)
        {
            $prenom = $dataArray[1]->value;
            $nom = $dataArray[2]->value;
            $courrielEmploye = $dataArray[3]->value;
            $telEmploye = $dataArray[4]->value;
            $posteTelEmploye = $dataArray[5]->value;
            $idEntreprise = $dataArray[6]->value;


            $query = $bdd->prepare("INSERT IGNORE INTO tblEmploye (CourrielEntreprise,Nom,Prenom,NumTelEntreprise,Poste,IdEntreprise)VALUES($courrielEmploye,$nom,$prenom,$telEmploye,$posteTelEmploye,$idEntreprise);");
            $query->execute();

        }

        protected function readUtilisateur ($bdd, $dataArray)
        {
            $idStagiaire =  intval ($dataArray[1]->value);
            $returnData = array();

            $query = $bdd->prepare("select 
                                    vStagiaire.Nom as 'NomStagiaire', 
                                    vStagiaire.Prenom as 'PrenomStagiaire'  , 
                                    vStagiaire.CourrielScolaire as 'CourrieScolaire', 
                                    vStagiaire.NumTelEntreprise as 'NumTelEntreprise',
                                    vStagiaire.Poste as 'Poste',
                                    vStagiaire.CourrielEntreprise as 'CourrielEntreprise', 
                                    vStagiaire.CodePermanent as 'CodePermanent', 
                                    vStagiaire.CourrielPersonnel as 'CourrielPersonnel', 
                                    vStagiaire.NumTel as 'NumTelStagiaire', 
                                    vEntreprise.Nom as 'NomEntreprise'
                                    from vStagiaire 
                                    join vStage on vStage.idStagiaire = vStagiaire.IdUtilisateur 
                                    join vSuperviseur on vStage.IdSuperviseur = vSuperviseur.IdUtilisateur 
                                    join vEntreprise on vEntreprise.Id = vSuperviseur.IdEntreprise 
                                    where vStagiaire.IdUtilisateur like :idStagiaire");

            $query->execute(array('idStagiaire'=> $idStagiaire));     
            $entrees = $query->fetchAll();

            foreach($entrees as $entree){


                $NomStagiaire = $entree["NomStagiaire"];
                $PrenomStagiaire = $entree["PrenomStagiaire"];
                $CourrieScolaire = $entree["CourrieScolaire"];
                $NumTelEntreprise = $entree["NumTelEntreprise"];
                $Poste = $entree["Poste"];
                $CourrielEntreprise = $entree["CourrielEntreprise"];
                $CodePermanent = $entree["CodePermanent"];
                $CourrielPersonnel = $entree["CourrielPersonnel"];
                $NumTelStagiaire = $entree["NumTelStagiaire"];
                $NomEntreprise = $entree["NomEntreprise"];

                $returnData [0] = $NomStagiaire;
                $returnData [1] = $PrenomStagiaire;
                $returnData [2] = $CourrieScolaire;
                $returnData [3] = $NumTelEntreprise;
                $returnData [4] = $Poste;
                $returnData [5] = $CourrielEntreprise;
                $returnData [6] = $CodePermanent;
                $returnData [7] = $CourrielPersonnel;
                $returnData [8] = $NumTelStagiaire;
                $returnData [9] = $NomEntreprise;  
            }

        return $returnData;

        }
    }

    class cStage
    {

        private $idStagiaire, $idResponsable, $idSuperviseur, $idEnseignant, $idEntreprise, $competancesRecherchees, $descriptionStage, $salaireHoraire, $nbreHeuresSemaine, $dateDebut, $dateFin;
        function createStage($bdd, $dataArray)
        {

            $idStagiaire = intval ($dataArray[1]->value);
            $idEntreprise = intval ($dataArray[2]->value);
            $idResponsable = intval ($dataArray[3]->value);
            $idSuperviseur = intval ($dataArray[4]->value);
            $idEnseignant = intval ($dataArray[5]->value);
            $descriptionStage = $dataArray[6]->value;
            $competencesRecherche = $dataArray[7]->value;
            $horaireTravail = $dataArray[8]->value;
            $nbreHeuresSemaine = intval ($dataArray[9]->value);
            $salaireHoraire = intval ($dataArray[10]->value);
            $dateDebut = date ('Y-m-d', strtotime($dataArray[11]->value));
            $dateFin = date ('Y-m-d', strtotime($dataArray[12]->value));

           $query = $bdd->prepare("INSERT INTO tblStage (IdResponsable, IdSuperviseur, IdStagiaire, IdEnseignant, DescriptionStage, CompetenceRecherche, HoraireTravail, NbHeureSemaine, SalaireHoraire, DateDebut, DateFin ) VALUES ($idResponsable, $idSuperviseur, $idStagiaire, $idEnseignant, '$descriptionStage', '$competencesRecherche', '$horaireTravail', '$nbreHeuresSemaine', '$salaireHoraire', '$dateDebut', '$dateFin');");
            $query->execute();
        }

        function returnSuperviseursAndResponsables($bdd, $dataArray)
        {
            $idEntreprise = intval ($dataArray[1]->value);
            $valeurRetour = '<select id="responsableStage" name = "responsableStage" class = "infosStage">';
            $query = $bdd->prepare("select concat (Prenom, ' ',  Nom) as NomEmploye, IdUtilisateur from tblEmploye where IdEntreprise like '$idEntreprise'");

            $query->execute(array());     
            $entrees = $query->fetchAll();

            foreach($entrees as $entree){
                  $NomEmploye = $entree["NomEmploye"];
                  $IdUtilisateur = $entree["IdUtilisateur"];

                  $valeurRetour = $valeurRetour . "<option value='". $IdUtilisateur . "'>" . $NomEmploye . "</option>";
            }

            $valeurRetour = $valeurRetour . '</select>';

            return $valeurRetour;


        }

        function afficherInfos($bdd, $dataArray)
        {
            $idStage =  intval ($dataArray[1]->value);
            $returnData = array();
            $query = $bdd->prepare("select 
                                    vStage.DescriptionStage as 'DescriptionStage', 
                                    vStage.CompetenceRecherche as 'CompetenceRecherche', 
                                    vStage.HoraireTravail as 'HoraireTravail', 
                                    vStage.SalaireHoraire as 'SalaireHoraire', 
                                    vStage.NbHeureSemaine as 'NbHeureSemaine' , 
                                    vEntreprise.Nom as 'NomEntreprise' , 
                                    concat(vStagiaire.Prenom, ' ' , vStagiaire.Nom)  as 'NomStagiaire' , 
                                    concat (vSuperviseur.Prenom, ' ', vSuperviseur.Nom) as 'NomSuperviseur', 
                                    concat (vResponsable.Prenom, ' ', vResponsable.Nom) as'NomResponsable', 
                                    concat (vEnseignant.Prenom, ' ', vEnseignant.Nom) as 'NomEnseignant' 
                                    from vStage    
                                    left join vSuperviseur on  vSuperviseur.IdUtilisateur = vStage.IdSuperviseur    
                                    left join vEntreprise on vEntreprise.Id = vSuperviseur.IdEntreprise     
                                    left join vStagiaire on vStagiaire.IdUtilisateur = vStage.IdStagiaire     
                                    left join vResponsable on vResponsable.IdUtilisateur = vStage.IdResponsable     
                                    left join vEnseignant on vEnseignant.IdUtilisateur = vStage.IdEnseignant 
                                    swhere vStage.Id like :idStage");


            $query->execute(array('idStage'=> $idStage));     
            $entrees = $query->fetchAll();

            foreach($entrees as $entree){
                $DescriptionStage = $entree["DescriptionStage"];
                $CompetenceRecherche = $entree["CompetenceRecherche"];
                $HoraireTravail = $entree["HoraireTravail"];
                $SalaireHoraire = $entree["SalaireHoraire"];
                $NbHeureSemaine = $entree["NbHeureSemaine"];
                $NomEntreprise = $entree["NomEntreprise"];
                $NomStagiaire = $entree["NomStagiaire"];
                $NomSuperviseur = $entree["NomSuperviseur"];
                $NomResponsable = $entree["NomResponsable"];
                $NomEnseignant = $entree["NomEnseignant"];

                $returnData [0] = $DescriptionStage;
                $returnData [1] = $CompetenceRecherche;
                $returnData [2] = $HoraireTravail;
                $returnData [3] = $SalaireHoraire;
                $returnData [4] = $NbHeureSemaine;
                $returnData [5] = $NomEntreprise;
                $returnData [6] = $NomSuperviseur;
                $returnData [7] = $NomStagiaire;
                $returnData [8] = $NomResponsable;
                $returnData [9] = $NomEnseignant;  

            }

            return $returnData;

        }

    }


?>
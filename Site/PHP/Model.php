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
            
            $categories = $bdd->Request('   SELECT DISTINCT(CQ.Id) AS IdCategorie, TitreCategorie, Lettre, descriptionCategorie
                                            FROM vQuestion AS Q
                                            JOIN vCategorieQuestion AS CQ
                                            ON CQ.Id = Q.IdCategorieQuestion
                                            JOIN vEvaluationQuestionReponse AS EQR
                                            ON EQR.IdQuestion = Q.Id
                                            WHERE IdQuestion = :idQuestion',
                                            array('idQuestion'=>$idQuestion),
                                            "stdClass");

            foreach($categories as $categorie){
                array_push($this->categories, new CategorieQuestion($categorie->IdCategorie, $categorie->TitreCategorie, $categorie->Lettre, $categorie->descriptionCategorie));
            }
        }
        
        //Sélectionne toutes les questions pour l'évaluation.
        private function SelectQuestions($bdd, $idEvaluation){
            unset($this->questions);
            $this->questions = array();

            $questions = $bdd->Request('SELECT DISTINCT(Id), Q.Texte
                                        FROM vQuestion AS Q
                                        JOIN vEvaluationQuestionReponse AS EQR
                                        ON EQR.IdQuestion = Q.Id
                                        WHERE EQR.IdEvaluation = :idEvaluation',
                                        array('idEvaluation'=>$idEvaluation),
                                        "stdClass");
            
            foreach($questions as $question){
                array_push($this->questions, new Question($question->Id, $question->Texte));
            }
        }
        
        //Affiche l'évaluation.
        public function DrawEvaluation($bdd){
            $content = "";
        
            foreach($this->questions as $question){
                $this->SelectCategories($bdd, $question->getId());
                    
                $content = $content.
                '<div class="categories">
                    <div class="separateur questions" id="question">
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
            
            foreach($this->reponses as $reponse)
            {   


                if(( $this->getStatut() == 3 )|| ( $this->getStatut() == 4))
                {
                     $this->SelectReponsesChoisies($bdd, $this->id, $question->getId());
                    //evaluation soumise ou validée
                    if($reponse->getId() == $this->reponsesChoisies[0]->getId())
                    {
                        //name="question'.$question->getId().'" value="'.$reponse->getid().'"
                        $content = $content. 
                            '
                            <tr class="itemHover" onclick="reponse'.$reponse->getId().'.checked = true;" >
                                <td>
                                    '.$reponse->getTexte().'
                                    <input type="radio" id="reponse'.$reponse->getId().'" name="question'.$question->getId().'" value="'.$reponse->getId().'" checked="checked"/>
                                </td>
                            </tr>
                            ';
                    }  
                    else
                    {
                        $content = $content. 
                            '
                                <tr class="itemHover" onclick="reponse'.$reponse->getId().'.checked = true;" >
                                    <td>
                                        '.$reponse->getTexte().'
                                        <input type="radio" id="reponse'.$reponse->getId().'" name="question'.$question->getId().'" value="'.$reponse->getId().'"/>
                                    </td>
                                </tr>
                            ';
                    }
                        
                }
                else
                {
                      $content = $content. 
                            '
                                <tr class="itemHover" onclick="reponse'.$reponse->getId().'.checked = true;" >
                                    <td>
                                        '.$reponse->getTexte().'
                                        <input type="radio" id="reponse'.$reponse->getId().'" name="question'.$question->getId().'" value="'.$reponse->getId().'"/>
                                    </td>
                                </tr>
                            ';
                }
            }
            
            return $content;
        }
    }

    class EvaluationGrille extends Evaluation{
        
        public function __construct($bdd, $id){
            parent::__construct($bdd, $id);
            $this->SelectCategories($bdd, $id);
            $this->SelectAllQuestions($bdd,$id);
        }
        
        //Sélectionne toutes les catégories pour l'évaluation.
        private function SelectCategories($bdd, $idEvaluation){
            $categories = $bdd->Request('   SELECT DISTINCT(CQ.Id) AS IdCategorie, TitreCategorie, Lettre, descriptionCategorie
                                            FROM vQuestion AS Q
                                            JOIN vCategorieQuestion AS CQ
                                            ON CQ.Id = Q.IdCategorieQuestion
                                            JOIN vEvaluationQuestionReponse AS EQR
                                            ON EQR.IdQuestion = Q.Id
                                            WHERE IdEvaluation = :idEvaluation',
                                            array('idEvaluation'=>$idEvaluation),
                                            "stdClass");

            foreach($categories as $categorie){
                array_push($this->categories, new CategorieQuestion($categorie->IdCategorie, $categorie->TitreCategorie, $categorie->Lettre, $categorie->descriptionCategorie));
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
        protected function AfficherQuestion($bdd, $questions)
        {
            $content = "";
            
            foreach($questions as $question)
            {
                $content = $content.
                '<tr class="questions">
                    <td>'.$question->getTexte().'</td>
                    '.$this->AfficheReponse($bdd, $question).'
                </tr>';
            } 
            
            return $content;
        }

     
        //Affiche les réponses.
        protected function AfficheReponse($bdd, $question)
        {
            $content = "";
            
            $this->SelectReponses($bdd, $question->getId());
            
            foreach($this->reponses as $reponse)
            {   
                $this->SelectReponsesChoisies($bdd, $this->id, $question->getId());

                if(( $this->getStatut() == 3 )|| ( $this->getStatut() == 4))
                {
                    //evaluation soumise ou validée
                    if($reponse->getId() == $this->reponsesChoisies[0]->getId())
                        $content = $content.'<td><input type="radio" name="question'.$question->getId().'" value="'.$reponse->getid().'" checked = "checked" ></td>';
                    else
                        $content = $content.'<td><input type="radio" name="question'.$question->getId().'" value="'.$reponse->getid().'"></td>';
                }
                else
                {
                     $content = $content.'<td><input type="radio" name="question'.$question->getId().'" value="'.$reponse->getid().'"></td>';
                }
                
            }
            
            return $content;
        }

        
        //Sélectionne toutes les questions pour la catégorie.
        protected function SelectQuestionsByCategories($bdd, $idEvaluation, $idCategorie){
            $questionsDeLaCategorie = array();

            $questions = $bdd->Request('SELECT DISTINCT(Id), Q.Texte
                                        FROM vQuestion AS Q
                                        JOIN vEvaluationQuestionReponse AS EQR
                                        ON EQR.IdQuestion = Q.Id
                                        WHERE EQR.IdEvaluation = :idEvaluation AND Q.IdCategorieQuestion = :idCategorieQuestion',
                                        array('idEvaluation'=>$idEvaluation, 'idCategorieQuestion'=>$idCategorie),  "stdClass");
            
            foreach($questions as $question)
            {
                array_push($questionsDeLaCategorie, new Question($question->Id, $question->Texte));
            }

            return $questionsDeLaCategorie;
        }
        
        protected function SelectAllQuestions($bdd, $idEvaluation){
            unset($this->questions);

            $this->questions = array();

            $questions = $bdd->Request('SELECT DISTINCT(Id), Q.Texte
                                        FROM vQuestion AS Q
                                        JOIN vEvaluationQuestionReponse AS EQR
                                        ON EQR.IdQuestion = Q.Id
                                        WHERE EQR.IdEvaluation = :idEvaluation',
                                        array('idEvaluation'=>$idEvaluation),
                                        "stdClass");

            foreach($questions as $question)
            {
                array_push($this->questions, new Question($question->Id, $question->Texte));
            }
        }
        
    }

    class EvaluationGrilleFormation extends EvaluationGrille
    {

        public function __construct($bdd, $id)
        {
            parent::__construct($bdd, $id);
        }

        private function questionsHasComment($bdd, $questions)
        {
            foreach ($questions as $question) 
            {

                if(($question->getId() == 57)||($question->getId() == 59)||($question->getId() == 60)||($question->getId() == 62)|| ($question->getId() == 63) ||($question->getId() == 65))
                {
                    return array($question->getId(),); 
                }
            }
        }

        private function zoneCommentaireCategorie($bdd,  $questions)
        {
            if( ( $this->statut == 3 ) || ( $this->statut == 4) )//evaluation soumise ou validée
            {
                 $commentaireCategorie = $bdd->Request('select *
                                    from tblevaluationquestionreponse
                                    where IdEvaluation = :IdEvaluation and IdQuestion = :IdQuestion;',
                                            array('IdEvaluation'=>$this->id,'IdQuestion'=> $this->questionsHasComment($bdd, $questions)[0]),
                                            "stdClass");

                return '<textarea class="commentaireCategorie" rows="" cols="" maxlength="500" wrap="hard" readonly>'. $commentaireCategorie[0]->Commentaire .'</textarea>';
            }
            else
            {
                return '<textarea class="commentaireCategorie" rows="" cols="" maxlength="500" name="'.$this->questionsHasComment($bdd, $questions)[0].'" wrap="hard" placeholder="Vos commentaires ici!"></textarea>';
            }

        }

        public function DrawEvaluation($bdd)
        {
            $content = "";
        
            foreach($this->categories as $categorie)
            {
                $questions = $this->SelectQuestionsByCategories($bdd, $this->id, $categorie->getId());
                    
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
                            <th>En accord</th>
                            <th>Plutot en accord</th>
                            <th>Plutot en désaccord</th>
                            <th>En désaccord</th>
                            <th>Ne s\'applique pas</th>
                        </thead>

                        <tbody>
                            '.$this->AfficherQuestion($bdd, $questions).'
                        </tbody>

                    </table>

                     <div class="commentaireEvalFinale">

                        '.$this->zoneCommentaireCategorie($bdd, $questions).'

                    </div>

                    
                </div>';

            }

            return $content;
        }
    }

    class EvaluationGrilleMiStage extends EvaluationGrille
    {

        public function __construct($bdd, $id)
        {
            parent::__construct($bdd, $id);
        }

        public function DrawEvaluation($bdd)
        {
            $content = "";
        
            foreach($this->categories as $categorie)
            {
                $questions = $this->SelectQuestionsByCategories($bdd, $this->id, $categorie->getId());
                    
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
                            '.$this->AfficherQuestion($bdd, $questions).'
                        </tbody>

                    </table>

                </div>';
            }

            return $content;
        }
    }

    class Evaluation
    {
        protected $questions = array();
        protected $reponses = array();
        protected $categories = array();
        protected $reponsesChoisies = array();
        protected $id, $statut, $titre, $dateCompletee, $dateDebut, $dateFin, $idTypeEval, $commentaire, $objectifEval;
        
        public function __construct($bdd, $id){
            $this->id = $id;
            $this->Initialise($bdd, $id);
        }
        
        //Initialise l'évaluation.
        private function Initialise($bdd, $id){
            $evaluations = $bdd->Request('  SELECT *
                                            FROM vEvaluation AS Eval
                                            JOIN vTypeEvaluation AS TE
                                            ON TE.Id = Eval.IdTypeEvaluation
                                            WHERE Eval.Id = :idEvaluation',
                                            array('idEvaluation'=>$id),
                                            "stdClass");
            
            foreach($evaluations as $evaluation)
            {
                $this->titre = $evaluation->Titre;
                $this->statut = $evaluation->Statut;
                $this->dateCompletee = $evaluation->DateComplétée;
                $this->dateDebut = $evaluation->DateDébut;
                $this->dateFin = $evaluation->DateFin;

                $this->idTypeEval = $evaluation->IdTypeEvaluation;
                $this->commentaire = $evaluation->Commentaire;
                $this->objectifEval = $evaluation->Objectif;                
            }
        }
        
        //Sélectionne toutes les réponses pour chaque question.
        protected function SelectReponses($bdd, $idQuestion){
            unset($this->reponses);
            $this->reponses = array();
            
            $reponses = $bdd->Request(' SELECT Q.Id AS IdQuestion, Q.Texte AS TexteQuestion, R.Id AS IdReponse, R.Texte AS TexteReponse
                                        FROM vQuestion AS Q
                                        JOIN vReponseQuestion AS RQ
                                        ON RQ.IdQuestion = Q.Id
                                        JOIN vReponse AS R
                                        ON R.Id = RQ.IdReponse
                                        WHERE IdQuestion = :idQuestion',
                                        array('idQuestion'=>$idQuestion),
                                        "stdClass");
            
            foreach($reponses as $reponse){
                array_push($this->reponses, new Reponse($reponse->IdReponse, $reponse->TexteReponse));
            }
        }
        
        //Sélectionne toutes les réponses choisies pour chaque question.
        protected function SelectReponsesChoisies($bdd, $idEvaluation, $idQuestion){
            unset($this->reponsesChoisies);
            $this->reponsesChoisies = array();
            
            $reponses = $bdd->Request(' SELECT IdReponse, R.Texte
                                        FROM vEvaluationQuestionReponse AS EQR
                                        JOIN vReponse AS R
                                        ON R.Id = EQR.IdReponse
                                        WHERE IdEvaluation = :idEvaluation AND IdQuestion = :idQuestion;',
                                        array('idEvaluation'=>$idEvaluation, 'idQuestion'=>$idQuestion),
                                        "stdClass");

            foreach($reponses as $reponse){
                array_push($this->reponsesChoisies, new Reponse($reponse->IdReponse, $reponse->Texte));
            }
        }

        public function Submit($bdd)
        {
            $reponses = json_decode($_POST["tabReponse"], true);

            foreach($reponses as $reponse)
            {
                if($reponse["type"] == "question")
                {
                    $bdd->Request('update tblEvaluationQuestionReponse SET IdReponse = :IdReponse
                                                                    WHERE IdEvaluation = :IdEvaluation AND IdQuestion = :IdQuestion;',
                    array('IdEvaluation'=>$this->id,'IdQuestion'=>$reponse["idQuestion"],'IdReponse'=>$reponse["value"]),
                    "stdClass");
                }
                else if($reponse["type"] == "commentaireEvaluation")
                {
                    $bdd->Request('update tblEvaluation set Statut= \'3\', DateComplétée=:DateCompletee, Commentaire = :Commentaire where Id=:IdEvaluation;',
                    array('IdEvaluation'=>$_REQUEST['idEvaluation'],'DateCompletee'=>date("Y-m-d"), 'Commentaire'=> $reponse["value"]),
                    "stdClass");
                }
                else
                {
                    $bdd->Request('update tblEvaluationQuestionReponse set Commentaire= :Commentaire where IdEvaluation=:IdEvaluation AND IdQuestion = :IdQuestion;',
                    array('Commentaire'=>$reponse["value"],'IdEvaluation'=>$_REQUEST['idEvaluation'],'IdQuestion'=> $reponse["idQuestion"]),
                    "stdClass");
                }
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

        public function getQuestions()
        {
            return $this->questions;
        }

        public function getCommentaire()
        {
            return $this->commentaire;
        }

        public function getObjectifEval()
        {
            return $this->objectifEval;
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
        
        protected 
        $IdUtilisateur, $Nom, $Prenom, $NumTelEntreprise, $CodePermanent, $Poste, $CourrielEntreprise, $NomEntreprise, $IdRole,
        $regxEmail = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$",
        $regxPoste = "^[0-9]{0,7}$",
        $regxPassword = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$",
        $regxNumTel = "^[(]{1}[0-9]{3}[)]{1}[\s]{1}[0-9]{3}[-]{1}[0-9]{4}$";
        
        //Met à jour l'utilisateur dans la BD.
        protected function UpdateUser($bdd, $motPasse, $courriel){
            if($motPasse != "")
            {
                $motPasse = password_hash($motPasse, PASSWORD_DEFAULT);

                $bdd->Request(" UPDATE tblUtilisateur SET MotDePasse = :motPasse WHERE Id LIKE :id;",
                                array("motPasse"=>$motPasse, "id"=>$this->IdUtilisateur),
                                "stdClass");
            }
            
            if($courriel != ""){
                $bdd->Request(" UPDATE tblUtilisateur SET Courriel = :courriel WHERE Id LIKE :id;",
                                array("id"=>$this->IdUtilisateur, "courriel"=>$courriel),
                                "stdClass");
            }
        }
        
        public function getId(){
            return $this->IdUtilisateur;
        }
        
        public function getNom(){
            return $this->Nom;
        }
        
        public function getPrenom(){
            return $this->Prenom;
        }
        
        public function getNumTelEntreprise(){
            return $this->NumTelEntreprise;
        }
        
        public function getCodePermanent(){
            return $this->CodePermanent;
        }
        
        public function getPoste(){
            return $this->Poste;
        }
        
        public function getCourrielEntreprise(){
            return $this->CourrielEntreprise;
        }
        
        public function getEntreprise(){
            return $this->NomEntreprise;
        }
        
        public function getIdRole(){
               return $this->IdRole;
        }
    }

    class ProfilEmploye extends Profil{
        
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
                    <p class="value">'.$this->getCourrielEntreprise().'</p>
                </div>

                <div class="champ">
                    <p class="label">No. Téléphone :</p>
                    <p class="value">'.$this->getNumTelEntreprise().'</p>
                </div>

                <div class="champ">
                    <p class="label">Poste :</p>
                    <p class="value">'.$this->getPoste().'</p>
                </div>
            </div>
            ';
            return $content;
        }
        
        public function ModifierProfil(){
            $content =
            '
            <div class="blocInfo infoProfil">
                    <div class="champ">
                        <p class="label labelForInput">Prenom :</p>
                        <input type="text" value="'.$this->getPrenom().'" class="value" disabled onblur="Required(this)" required/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Nom :</p>
                        <input type="text" value="'.$this->getNom().'" class="value" disabled onblur="Required(this)" required/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Entreprise :</p>
                        <input type="text" value="'.$this->getEntreprise().'" class="value" disabled onblur="Required(this)" required/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Courriel :</p>
                        <input type="email" value="'.$this->getCourrielEntreprise().'" id="courrielEntreprise" name="courrielEntreprise" class="value" pattern="'.$this->regxEmail.'" onblur="Required(this) required; VerifierRegex(this)" />
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">No. Téléphone :</p>
                        <input type="text" value="'.$this->getNumTelEntreprise().'" id="numEntreprise" name="numEntreprise" class="value" onblur="Required(this); VerifierRegex(this)" pattern="'.$this->regxNumTel.'" required/>
                        <img class="info" src="../Images/info.png" title="Le numéro de téléphone doit
avoir ce format - (xxx) xxx-xxxx"/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Poste :</p>
                        <input type="text" value="'.$this->getPoste().'" name="poste" id="poste" pattern="'.$this->regxPoste.'" onblur="VerifierRegex(this)" class="value"/>
                    </div>
            </div>

            <div class="separateur">
                <h3>Sécurité</h3>
            </div>

            <div class="blocInfo infoProfil">
                    <div class="champ">
                        <p class="label labelForInput">Nouveau mot de passe :</p>
                        <input type="password" id="newPwd" class="value" name="nouveauPasse" pattern="'.$this->regxPassword.'" onblur="VerifierRegex(this)"/>
                        <img class="info" src="../Images/info.png" title="Le mot de passe doit contenir
- 8 caractères minimum
- Au moins une majuscule
- Au moins un chiffre(0-9)"/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Confirmer le mot de passe :</p>
                        <input type="password" id="confirmationNewPwd" class="value" onblur="DoubleVerif(newPwd, this)"/>
                    </div>
            </div>';

            return $content;
        }
        
        //Met à jour le profil dans la BD.
        public function UpdateProfil($bdd, $champs){
            $profil = array();

            foreach($champs as $champ){
                $profil[$champ->nom] = $champ->value;
            }

            $this->UpdateUser($bdd, $profil["nouveauPasse"], $profil["courrielEntreprise"]);

            $bdd->Request(" UPDATE tblEmploye SET NumTelEntreprise = :numTelEntreprise, Poste = :poste, CourrielEntreprise = :courrielEntreprise WHERE IdUtilisateur = :id",
                            array(
                            "numTelEntreprise"=>$profil["numEntreprise"],
                            "poste"=>$profil["poste"],
                            "courrielEntreprise"=>$profil["courrielEntreprise"],
                            "id"=>'121'),
                            "stdClass");
        }
    }

    class ProfilStagiaire extends Profil{
        
        protected $NumTelPerso, $CourrielPersonnel, $CourrielScolaire;
    
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

                    <div class="champ">
                        <p class="label">Courriel Scolaire:</p>
                        <p class="value">'.$this->getCourrielScolaire().'</p>
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
                        <p class="value">'.$this->getCourrielEntreprise().'</p>
                    </div>

                    <div class="champ">
                        <p class="label">No. Téléphone :</p>
                        <p class="value">'.$this->getNumTelEntreprise().'</p>
                    </div>

                    <div class="champ">
                        <p class="label">Poste :</p>
                        <p class="value">'.$this->getPoste().'</p>
                    </div>
            </div>
            ';
            return $content;
        }
        
        public function ModifierProfil(){
            $content =
            '
            <div class="separateur">
                <h3>Informations Personnelles</h3>
            </div>

            <div class="blocInfo infoProfil">
                    <div class="champ">
                        <p class="label labelForInput">Prenom :</p>
                        <input type="text" value="'.$this->getPrenom().'" class="value" disabled/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Nom :</p>
                        <input type="text" value="'.$this->getNom().'" class="value" disabled/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">No. Téléphone :</p>
                        <input type="text" value="'.$this->getNumTelPerso().'" id="numTel" name="numTel" class="value" onblur="VerifierRegex(this)" pattern="'.$this->regxNumTel.'"/>
                        <img class="info" src="../Images/info.png" title="Le numéro de téléphone doit
avoir ce format - (xxx) xxx-xxxx"/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Courriel personnel :</p>
                        <input type="email" value="'.$this->getCourrielPerso().'" id="courrielPersonnel" maxlength="320" name="courrielPersonnel" class="value" onblur="VerifierRegex(this)" pattern="'.$this->regxEmail.'"/>
                    </div>';

            if($_SESSION["IdRole"] == 1){
                $content = $content.
                '<div class="champ">
                    <p class="label labelForInput">Courriel scolaire :</p>
                    <input type="email" value="'.$this->getCourrielScolaire().'" id="courrielScolaire" maxlength="320" name="courrielScolaire" class="value" onblur="VerifierRegex(this)" pattern="'.$this->regxEmail.'" disabled/>
                </div>';
            }
                    
                            
            $content = $content.
            '</div>

            <div class="separateur">
                <h3>Informations Professionnelles</h3>
            </div>

            <div class="blocInfo infoProfil">
                    <div class="champ">
                        <p class="label labelForInput">Entreprise :</p>
                        <input type="text" value="'.$this->getEntreprise().'" class="value" disabled/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Courriel :</p>
                        <input type="email" value="'.$this->getCourrielEntreprise().'" id="courrielEntreprise" name="courrielEntreprise" class="value" onblur="VerifierRegex(this)" pattern="'.$this->regxEmail.'"/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">No. Téléphone :</p>
                        <input type="text" value="'.$this->getNumTelEntreprise().'" id="numEntreprise" name="numEntreprise" class="value" onblur="VerifierRegex(this)" pattern="'.$this->regxNumTel.'"/>
                        <img class="info" src="../Images/info.png" title="Le numéro de téléphone doit
avoir ce format - (xxx) xxx-xxxx"/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Poste :</p>
                        <input type="text" value="'.$this->getPoste().'" name="poste" id="poste" class="value" onblur="VerifierRegex(this)" pattern="'.$this->regxPoste.'"/>
                    </div>
            </div>

            <div class="separateur">
                <h3>Sécurité</h3>
            </div>

            <div class="blocInfo infoProfil">
                    <div class="champ">
                        <p class="label labelForInput">Nouveau mot de passe :</p>
                        <input type="password" id="newPwd" class="value" name="nouveauPasse" onblur="VerifierRegex(this)" pattern="'.$this->regxPassword.'"/>
                        <img class="info" src="../Images/info.png" title="Le mot de passe doit contenir
- 8 caractères minimum
- Au moins une majuscule
- Au moins un chiffre(0-9)"/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Confirmer le mot de passe :</p>
                        <input type="password" id="confirmationNewPwd" class="value" onblur="DoubleVerif(newPwd.value, this)"/>
                    </div>
            </div>';

            return $content;
        }
        
        //Met à jour le profil dans la BD.
        public function UpdateProfil($bdd, $champs){
            $profil = array();

            foreach($champs as $champ){
                $profil[$champ->nom] = $champ->value;
            }

            $this->UpdateUser($bdd, $profil["nouveauPasse"], $profil["courrielScolaire"]);

            $bdd->Request(" UPDATE tblStagiaire SET NumTelPerso = :numTelPerso, NumTelEntreprise = :numTelEntreprise, Poste = :poste, CourrielEntreprise = :courrielEntreprise, CourrielPersonnel = :courrielPerso WHERE IdUtilisateur = :id",
                            array(
                            "numTelPerso"=>$profil["numTel"],
                            "numTelEntreprise"=>$profil["numEntreprise"],
                            "poste"=>$profil["poste"],
                            "courrielEntreprise"=>$profil["courrielEntreprise"],
                            "courrielPerso"=>$profil["courrielPersonnel"],
                            "id"=>$this->IdUtilisateur),
                            "stdClass");
        }
        
        public function getNumTelPerso(){
            return $this->NumTelPerso;
        }
        
        public function getCourrielPerso(){
            return $this->CourrielPersonnel;
        }
        
        public function getCourrielScolaire(){
            return $this->CourrielScolaire;
        }
    }

    
    class Entreprise{
        private $Id, $CourrielEntreprise, $Nom, $NumTel, $NumCivique, $Rue, $Ville, $Province, $CodePostal, $Logo;
        
        //Met à jour un objet entreprise dans la BD.
        public function Update($bdd, $champs){
            $entreprise = array();

            foreach($champs as $champ){
                $entreprise[$champ->nom] = $champ->value;
            }
            
            return $bdd->Request("  UPDATE tblEntreprise SET CourrielEntreprise = :courriel, Nom = :nom, NumTel = :numTel,
                                    NumCivique = :numCivique, Rue = :rue, Ville = :ville, Province = :province, CodePostal = :codePostal,
                                    Logo = :logo WHERE Id = :id",
                                    array(  
                                    "courriel"=>$entreprise["courrielEntreprise"],
                                    "nom"=>$entreprise["nom"],
                                    "numTel"=>$entreprise["numEntreprise"],
                                    "numCivique"=>$entreprise["noCivique"],
                                    "rue"=>$entreprise["rue"],
                                    "ville"=>$entreprise["ville"],
                                    "province"=>$entreprise["province"],
                                    "codePostal"=>$entreprise["codePostal"],
                                    "logo"=>$entreprise["logo"],
                                    "id"=>$this->Id),
                                    "stdClass");
        }
        
        public function getId(){
            return $this->Id;
        }
        
        public function getCourriel(){
            return $this->CourrielEntreprise;
        }
        
        public function getNom(){
            return $this->Nom;
        }
        
        public function getNumTel(){
            return $this->NumTel;
        }
        
        public function getNumCivique(){
            return $this->NumCivique;
        }
        
        public function getRue(){
            return $this->Rue;
        }
        
        public function getVille(){
            return $this->Ville;
        }
        
        public function getProvince(){
            return $this->Province;
        }
        
        public function getCodePostal(){
            return $this->CodePostal;
        }
        
        public function getLogo(){
            return $this->Logo;
        }
    }
    
    class Session{
        private $Id, $Annee, $Periode, $MiStageDebut, $MiStageLimite, $FinaleDebut, $FinaleLimite, $FormationDebut, $FormationLimite, $JanvierDebut, $JanvierLimite, $FevrierDebut, $FevrierLimite, $MarsDebut, $MarsLimite;
        
        //Met à jour un objet entreprise dans la BD.
        public function Update($bdd, $champs){
            $session = array();

            foreach($champs as $champ){
                $session[$champ->nom] = $champ->value;
            }
            
            return $bdd->Request(" UPDATE tblSession SET Annee = :annee, Periode = :periode, MiStageDebut = :mistagedebut,
                            MiStageLimite = :mistagelimite, FinaleDebut = :finaledebut, FinaleLimite = :finalelimite, FormationDebut = :formationdebut, FormationLimite = :formationlimite,
                            JanvierDebut = :janvierdebut, JanvierLimite = :janvierlimite, FevrierDebut = :fevrierdebut, FevrierLimite = :fevrierlimite, MarsDebut = :marsdebut, MarsLimite = :marslimite WHERE Id = :id",
                            array(  
                            "annee"=>$session["annee"],
                            "periode"=>$session["periode"],
                            "mistagedebut"=>$session["mistagedebut"],
                            "mistagelimite"=>$session["mistagelimite"],
                            "finaledebut"=>$session["finaledebut"],
                            "finalelimite"=>$session["finalelimite"],
                            "formationdebut"=>$session["formationdebut"],
                            "formationlimite"=>$session["formationlimite"],
                            "janvierdebut"=>$session["janvierdebut"],
                            "janvierlimite"=>$session["janvierlimite"],
                            "fevrierdebut"=>$session["fevrierdebut"],
                            "fevrierlimite"=>$session["fevrierlimite"],
                            "marsdebut"=>$session["marsdebut"],
                            "marslimite"=>$session["marslimite"],
                            "id"=>$this->Id),
                            "stdClass");
        }
        
        public function getId(){
            return $this->Id;
        }
        
        public function getAnnee(){
            return $this->Annee;
        }
        public function getPeriode(){
            return $this->Periode;
        }
        
        public function getMiStageDebut(){
            return $this->MiStageDebut;
        }
        
        public function getMiStageLimite(){
            return $this->MiStageLimite;
        }
        
        public function getFinaleDebut(){
            return $this->FinaleDebut;
        }
        public function getFinaleLimite(){
            return $this->FinaleLimite;
        }
        
        public function getFormationDebut(){
            return $this->FormationDebut;
        }
        
        public function getFormationLimite(){
            return $this->FormationLimite;
        }
        
        public function getJanvierDebut(){
            return $this->JanvierDebut;
        }
        
        public function getJanvierLimite(){
            return $this->JanvierLimite;
        }
        
        public function getFevrierDebut(){
            return $this->FevrierDebut;
        }
        public function getFevrierLimite(){
            return $this->FevrierLimite;
        }
        public function getMarsDebut(){
            return $this->MarsDebut;
        }
        public function getMarsLimite(){
            return $this->MarsLimite;
        }
    }


    class Stage implements JsonSerializable{
        private $IdStage, $DescriptionStage, $CompetenceRecherche, $NbHeureSemaine, $SalaireHoraire,
                $DateDebut, $DateFin, $LettreEntenteVide, $LettreEntenteSignee, $OffreStage, $IdSession,
                $IdResponsable, $IdSuperviseur, $IdStagiaire, $IdEnseignant, $NomResponsable, $NomEnseignant,
                $NomSuperviseur, $NomStagiaire, $IdEntreprise, $NomEntreprise, $NomSession;
        
        //Met à jour le stage dans la BD.
        public function Update($bdd, $champs){
            $stage = array();

            foreach($champs as $champ){
                $stage[$champ->nom] = $champ->value;
            }

            return $bdd->Request("  UPDATE tblStage SET IdResponsable = :idResponsable, IdSuperviseur = :idSuperviseur, 
                                    IdStagiaire = :idStagiaire, IdEnseignant = :idEnseignant, DescriptionStage = :description,
                                    CompetenceRecherche = :competence, NbHeureSemaine = :nbHeure,
                                    SalaireHoraire = :salaire, DateDebut = :dateDebut, DateFin = :dateFin,
                                    IdSession = :idSession WHERE Id = :id",
                                    array(
                                        'idResponsable'=>$stage["Responsable"], 
                                        'idSuperviseur'=>$stage["Superviseur"], 
                                        'idStagiaire'=>$stage["Stagiaire"], 
                                        'idEnseignant'=>$stage["Enseignant"],
                                        'description'=>$stage["DescStage"], 
                                        'competence'=>$stage["CompetancesRecherchees"], 
                                        'nbHeure'=>$stage["HeuresSemaine"],
                                        'salaire'=>$stage["SalaireHoraire"], 
                                        'dateDebut'=>$stage["DateDebut"], 
                                        'dateFin'=>$stage["DateFin"],
                                        'idSession'=>$stage["Session"],
                                        'id'=>$this->getIdStage()),
                                        'stdClass');
        }
        
        public function jsonSerialize(){
            return get_object_vars($this);
        }
        
        public function getIdStage(){
            return $this->IdStage;
        }
        
        public function getNomEntreprise(){
            return $this->NomEntreprise;
        }
        
        public function getIdEntreprise(){
            return $this->IdEntreprise;
        }
        
        public function getDescriptionStage(){
            return $this->DescriptionStage;
        }
        
        public function getCompetenceRecherche(){
            return $this->CompetenceRecherche;
        }
        
        public function getNbHeureSemaine(){
            return $this->NbHeureSemaine;
        }
        
        public function getSalaireHoraire(){
            return $this->SalaireHoraire;
        }
        
        public function getDateDebut(){
            return $this->DateDebut;
        }
        
        public function getDateFin(){
            return $this->DateFin;
        }
        
        public function getLettreEntenteVide(){
            return $this->LettreEntenteVide;
        }
        
        public function getLettreEntenteSignee(){
            return $this->LettreEntenteSignee;
        }
        
        public function getOffreStage(){
            return $this->OffreStage;
        }
        
        public function getIdSession(){
            return $this->IdSession;
        }
        
        public function getNomSession(){
            return $this->NomSession;
        }
        
        public function getIdResponsable(){
            return $this->IdResponsable;
        }
        
        public function getIdSuperviseur(){
            return $this->IdSuperviseur;
        }
        
        public function getIdStagiaire(){
            return $this->IdStagiaire;
        }
        
        public function getIdEnseignant(){
            return $this->IdEnseignant;
        }
        
        public function getNomResponsable(){
            return $this->NomResponsable;
        }
        
        public function getNomSuperviseur(){
            return $this->NomSuperviseur;
        }
        
        public function getNomStagiaire(){
            return $this->NomStagiaire;
        }
        
        public function getNomEnseignant(){
            return $this->NomEnseignant;
        }
    }
?>
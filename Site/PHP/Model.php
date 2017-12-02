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
        
        //Sélectionne toutes les questions pour la catégorie.
        private function SelectQuestions($bdd, $idEvaluation, $idCategorie){
            unset($this->questions);
            $this->questions = array();

            $questions = $bdd->Request('SELECT DISTINCT(Id), Q.Texte
                                        FROM vQuestion AS Q
                                        JOIN vEvaluationQuestionReponse AS EQR
                                        ON EQR.IdQuestion = Q.Id
                                        WHERE EQR.IdEvaluation = :idEvaluation AND Q.IdCategorieQuestion = :idCategorieQuestion',
                                        array('idEvaluation'=>$idEvaluation, 'idCategorieQuestion'=>$idCategorie),
                                        "stdClass");
            
            foreach($questions as $question){
                array_push($this->questions, new Question($question->Id, $question->Texte));
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
            $evaluations = $bdd->Request('  SELECT *
                                            FROM vEvaluation AS Eval
                                            JOIN vTypeEvaluation AS TE
                                            ON TE.Id = Eval.IdTypeEvaluation
                                            WHERE Eval.Id = :idEvaluation',
                                            array('idEvaluation'=>$id),
                                            "stdClass");
            
            foreach($evaluations as $evaluation){
                $this->titre = $evaluation->Titre;
                $this->statut = $evaluation->Statut;
                $this->dateCompletee = $evaluation->DateComplétée;
                $this->dateDebut = $evaluation->DateDébut;
                $this->dateFin = $evaluation->DateFin;
                $this->idTypeEval = $evaluation->IdTypeEvaluation;                
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
        
        //Sauvegarde les modifications dans la BD.
        public function Submit($bdd){
            $reponses = json_decode($_POST["tabReponse"], true);

            $bdd->Request(' update tblEvaluation set Statut= \'3\', DateComplétée=:DateCompletee where Id=:IdEvaluation;',
                            array('IdEvaluation'=>$_REQUEST['idEvaluation'],'DateCompletee'=>date("Y-m-d")),
                            "stdClass");

            foreach($reponses as $reponse){
                $bdd->Request(' UPDATE tblEvaluationQuestionReponse SET IdReponse = :IdReponse
                                WHERE IdEvaluation = :IdEvaluation AND IdQuestion = :IdQuestion;',
                                array('IdEvaluation'=>$this->id,'IdQuestion'=>$reponse["idQuestion"],'IdReponse'=>$reponse["value"]),
                                "stdClass");
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
        
        protected $IdUtilisateur, $Nom, $Prenom, $NumTelEntreprise, $CodePermanent, $Poste, $CourrielEntreprise, $NomEntreprise, $IdRole;
        
        protected function SetPassword($newPassword, $bdd){
            if($newPassword != "")
            {
                $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $bdd->Request(" UPDATE tblUtilisateur SET MotDePasse = :motPasse WHERE Id LIKE :id;",
                                array("motPasse"=>$newPassword, "id"=>$this->IdUtilisateur),
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
                        <input type="text" value="'.$this->getPrenom().'" class="value" disabled/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Nom :</p>
                        <input type="text" value="'.$this->getNom().'" class="value" disabled/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Entreprise :</p>
                        <input type="text" value="'.$this->getEntreprise().'" class="value" disabled/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Courriel :</p>
                        <input type="email" value="'.$this->getCourrielEntreprise().'" id="courrielEntreprise" name="courrielEntreprise" class="value" onexit="RegexProfilStagiaire()"/>

                    </div>

                    <div class="champ">
                        <p class="label labelForInput">No. Téléphone :</p>
                        <input type="text" value="'.$this->getNumTelEntreprise().'" id="numEntreprise" name="numEntreprise" class="value" onexit="RegexProfilStagiaire()"/>
                        <img class="info" src="../Images/info.png" title="Le numéro de téléphone doit
avoir ce format - (xxx) xxx-xxxx"/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Poste :</p>
                        <input type="text" value="'.$this->getPoste().'" name="poste" id="poste" class="value" onexit="RegexProfilStagiaire()"/>
                    </div>
            </div>

            <div class="separateur">
                <h3>Sécurité</h3>
            </div>

            <div class="blocInfo infoProfil">
                    <div class="champ">
                        <p class="label labelForInput">Nouveau mot de passe :</p>
                        <input type="password" id="newPwd" class="value" name="nouveauPasse" onexit="RegexProfilStagiaire()"/>
                        <img class="info" src="../Images/info.png" title="Le mot de passe doit contenir
- 8 caractères minimum
- Au moins une majuscule
- Au moins un chiffre(0-9)"/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Confirmer le mot de passe :</p>
                        <input type="password" id="confirmationNewPwd" class="value" onexit="RegexProfilStagiaire()"/>
                    </div>
            </div>';

            return $content;
        }
        
        public function UpdateProfil($bdd, $champs){
            $profil = array();

            foreach($champs as $champ){
                $profil[$champ->nom] = $champ->value;
            }

            $this->SetPassword($profil["nouveauPasse"], $bdd);

            $bdd->Request(" UPDATE tblEmploye SET NumTelEntreprise = :numTelEntreprise, Poste = :poste, CourrielEntreprise = :courrielEntreprise WHERE IdUtilisateur = :id",
                            array(
                            "numTelEntreprise"=>$profil["numEntreprise"],
                            "poste"=>$profil["poste"],
                            "courrielEntreprise"=>$profil["courrielEntreprise"],
                            "id"=>$this->IdUtilisateur),
                            "stdClass");
        }
    }

    class ProfilStagiaire extends Profil{
        
        private $NumTel, $CourrielPersonnel;
    
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
                        <input type="text" value="'.$this->getNumTelPerso().'" id="numTel" name="numTel" class="value" onexit="RegexProfilStagiaire()"/>
                        <img class="info" src="../Images/info.png" title="Le numéro de téléphone doit
avoir ce format - (xxx) xxx-xxxx"/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Courriel :</p>
                        <input type="email" value="'.$this->getCourrielPerso().'" id="courrielPersonnel" name="courrielPersonnel" class="value" onexit="RegexProfilStagiaire()"/>
                    </div>
            </div>

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
                        <input type="email" value="'.$this->getCourrielEntreprise().'" id="courrielEntreprise" name="courrielEntreprise" class="value" onexit="RegexProfilStagiaire()"/>

                    </div>

                    <div class="champ">
                        <p class="label labelForInput">No. Téléphone :</p>
                        <input type="text" value="'.$this->getNumTelEntreprise().'" id="numEntreprise" name="numEntreprise" class="value" onexit="RegexProfilStagiaire()"/>
                        <img class="info" src="../Images/info.png" title="Le numéro de téléphone doit
avoir ce format - (xxx) xxx-xxxx"/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Poste :</p>
                        <input type="text" value="'.$this->getPoste().'" name="poste" id="poste" class="value" onexit="RegexProfilStagiaire()"/>
                    </div>
            </div>

            <div class="separateur">
                <h3>Sécurité</h3>
            </div>

            <div class="blocInfo infoProfil">
                    <div class="champ">
                        <p class="label labelForInput">Nouveau mot de passe :</p>
                        <input type="password" id="newPwd" class="value" name="nouveauPasse" onexit="RegexProfilStagiaire()"/>
                        <img class="info" src="../Images/info.png" title="Le mot de passe doit contenir
- 8 caractères minimum
- Au moins une majuscule
- Au moins un chiffre(0-9)"/>
                    </div>

                    <div class="champ">
                        <p class="label labelForInput">Confirmer le mot de passe :</p>
                        <input type="password" id="confirmationNewPwd" class="value" onexit="RegexProfilStagiaire()"/>
                    </div>
            </div>';

            return $content;
        }
        
        public function UpdateProfil($bdd, $champs){
            $profil = array();

            foreach($champs as $champ){
                $profil[$champ->nom] = $champ->value;
            }

            $this->SetPassword($profil["nouveauPasse"], $bdd);

            $bdd->Request(" UPDATE tblStagiaire SET NumTel = :numTel, NumTelEntreprise = :numTelEntreprise, Poste = :poste, CourrielEntreprise = :courrielEntreprise, CourrielPersonnel = :courrielPerso WHERE IdUtilisateur = :id",
                            array(
                            "numTel"=>$profil["numTel"],
                            "numTelEntreprise"=>$profil["numEntreprise"],
                            "poste"=>$profil["poste"],
                            "courrielEntreprise"=>$profil["courrielEntreprise"],
                            "courrielPerso"=>$profil["courrielPersonnel"],
                            "id"=>$this->IdUtilisateur),
                            "stdClass");
        }
        
        public function getNumTelPerso(){
            return $this->NumTel;
        }
        
        public function getCourrielPerso(){
            return $this->CourrielPersonnel;
        }
    }
    
    /**********************************************************************************************
    *   Classes: cUtilisateur, cStagiaire, cEmployeEntreprise, cEntreprise                        *
    *   But: gérer le CRUD des utilisateurs                                                       *
    *   Note: Va utiliser de l'héritage pour les champs des stagiaires vs des employes            *
    *   Nom: Hans darmstadt-Bélanger                                                              *
    *   date: 23 Novembre 2017                                                                    *
    *   ******************************************************************************************/


    

    class cUtilisateur {
        
        public function __construct($id, $bdd){
            $this->id = $id;
        }
        private $courrielPrincipal, $id, $prenom, $nom, $noTelPrincipal, $posteTelEntreprise;

        public function getCourrielPrincipal(){
            return $this->courrielPrincipal;
        }

        public function getId(){
            return $this->id;
        }

        public function getPrenom(){
            return $this->prenom;
        }

        public function getNoTelPrincipal(){
            return $this->noTelPrincipal;
        }

        public function getPosteTelEntreprise(){
            return $this->posteTelEntreprise;
        }

        
     }   
    class cStagiaire extends cUtilisateur {

        private $noTelEntreprise, $courrielEntreprise, $courrielPersonnel, $codePermanent;

        public function getNoTelEntreprise(){
            return $this->noTelEntreprise;
        }

        public function getCourrielEntreprise(){
            return $this->courrielEntreprise;
        }

        public function getCourrielPersonnel(){
            return $this->courrielPersonnel;
        }

        public function getCodePermanent(){
            return $this->codePermanent;
        }


        protected function createUtilisateur($bdd,$dataArray)

            {
                $prenom = $dataArray[1]->value;
                $nom = $dataArray[2]->value;
                $courrielScolaire = $dataArray[3]->value;

                $query = $bdd->prepare("insert into tblStagiaire (Prenom, Nom, CourrielScolaire) Values  ('$prenom' , '$nom' , '$courrielScolaire');");
                $query->execute();
            }

        protected function readUtilisateur($bdd,$dataArray)
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

        public function __construct($id, $bdd){     
            parent::__construct($id, $bdd);
            $this->Initialise($id, $bdd);
        }

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


?>
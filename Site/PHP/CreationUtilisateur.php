<?php
     if(isset($_REQUEST["post"]))
        {
            $champs = json_decode($_POST["tabChamp"]);
         //   var_dump($champs);
            $utilisateurs = array();
            foreach($champs as $champ){
                $utilisateurs[$champ->nom] = $champ->value;
            }
         //   var_dump($utilisateurs);
               // var_dump($utilisateurs["userType"]);

            switch ($utilisateurs["userType"])
            {
                case "2" : creationEmploye($bdd, $utilisateurs);
                    break;
                case "3": creationEnseignant($bdd, $utilisateurs);
                    break;
                case "5": creationStagiaire($bdd, $utilisateurs);
                    break;
                default: echo 'type d\'utilisateur inconnu';
                    break;
            }
        }

        else {
             $content =
            '

            <article class="stagiaire">
                <div id="modifStagiaire" >
                     <p class="label labelForInput">Selectionnez le type d\'utilisateur</p>
                            <select class="value" class = "infosStage" name = "userType" onChange="changeUserType(this)">
                                <option value = "2">Employé d\'entreprise</option>
                                <option value = "5">Stagiaire</option>
                                <option value = "3">Enseignant</option>
                            </select>
                <div class = "champ" id = "Prenom">
                    <br>
                    <p class="label labelForInput">Prenom :</p>
                    <input type="text" value="" id="prenom" class="value" name = "prenom" onchange="regexCreationUtilisateur();"/>
                </div>

               <div class = "champ" id = "Nom">
                <br>
                <p class="label labelForInput">Nom :</p>
                <input type="text" value="" class="value" name = "nom" id="nom" onchange="regexCreationUtilisateur();"/>
                </div>

                <div class = "champ" id = "courriel">
                 <br>
                <p class="label labelForInput">Courriel :</p>
                <input type="text" value="" class="value" name = "courriel" id="Courriel" onchange="regexCreationUtilisateur();"/>
                </div>
                    <div class="champ" id = "dropDownEntreprise">
                        <p class="label labelForInput">Entreprise</p>
                        <select class="value" name = "Entreprise" name = "entreprise">
                            ' . showEnterprises($bdd) . '
                        </select>
                </div>
                <div class = "champ" id = "noTelEntreprise">
                <br>
                <p class="label labelForInput">Numero de telephone entreprise :</p>
                <input type="text" value="" class="value" name = "noTelEntreprise" id="numTelEntreprise" onchange="regexCreationUtilisateur();"/>
                </div>

                <div class = "champ" id = "posteTelEntreprise">
                <br>
                <p class="label labelForInput">Poste téléphonique :</p>
                <input type="text" value="" class="value" name = "posteTelEntreprise" id="posteTel" maxlength="7" onchange="regexCreationUtilisateur();"/>
                </div>

                <div class = "champ" id = "courrielPersonnel">
                <br>
                <p class="label labelForInput">courriel personnel (facultatif) :</p>
                <input type="text" value="" class="value" name = "courrielPersonnel" id="courrielPersonnel" onchange="regexCreationUtilisateur();"/>
                </div>

                <div class = "champ" id = "noTelPersonnel">
                <br>
                <p class="label labelForInput">Numéro de téléphone personnel (facultatif) :</p>
                <input type="text" value="" class="value" name = "noTelPersonnel" id="noTelPersonnel" onchange="regexCreationUtilisateur();"/>
                </div>

                <div class = "champ" id="posteEntreprise">
                <input type="checkbox" name="Superviseur" id = "chkSuperviseur" class = "value" value="superviseur" onchange = "checkSuperviseur(this);" name = "false"  > l\'eployé est un superviseur<br>
                <input type="checkbox" name="Responsable" id = "chkResponsable" class = "value" value="Responsable" onchange = "checkResponsable(this);" name = "false">L\'employé est un responsable<br>
                </div>



                <br>
                <input type="button" id="Save" class="bouton" value="Sauvegarder" onclick ="Post(testerRetour , \'../PHP/TBNavigation.php?nomMenu=CreationUtilisateur.php&post\')" />     
                <input type="button" id="Cancel" class="bouton" value="Retour" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeUtilisateur.php\')" />            
            </div>
            </article>';
            return $content;


        }

    function creationStagiaire($bdd, $utilisateurs)
    {

        
        if (validerCourrielUnique($bdd, $utilisateurs))
            {
                insertionTblUtilisateur($bdd, $utilisateurs);
            
                $result = $bdd->Request("SELECT Id from tblUtilisateur where Courriel like :courriel;", 
                    array('courriel'=>$utilisateurs["courriel"]) ,'stdClass');

                foreach($result as $resultat){
                   $idUtilisateur =  $resultat->Id;
                } 

            $bdd->Request("  INSERT into tblStagiaire (Prenom, Nom, CourrielScolaire, IdUtilisateur)
                            values (:Prenom, :Nom,  :courriel, :IdUtilisateur)",
                            array('courriel'=>$utilisateurs["courriel"], 
                                    'Prenom'=>$utilisateurs["prenom"],
                                    'Nom'=>$utilisateurs["nom"],
                                    'IdUtilisateur'=>$idUtilisateur), 
                            'stdClass'); 
            $bdd->Request("INSERT into tblUtilisateurRole (IdUtilisateur, IdRole)
                            values (:idUtilisateur,  5)", 
                            array( 'idUtilisateur'=>$idUtilisateur), 
                                   'stdClass');        
        }
        else 
        {
                echo '-1';            
        }
        
    }

    function creationEmploye($bdd, $utilisateurs)
    {
        //vérifier mail unique

        if (validerCourrielUnique($bdd, $utilisateurs))
        {
            //insérer tblUtilisateur
            insertionTblUtilisateur($bdd, $utilisateurs);
        
            $result = $bdd->Request("SELECT Id from tblUtilisateur where Courriel like :courriel;", 
                array('courriel'=>$utilisateurs["courriel"]) ,'stdClass');

            foreach($result as $resultat){
               $idUtilisateur =  $resultat->Id;
               var_dump($idUtilisateur);
            }

            $bdd->Request(" INSERT into tblEmploye (CourrielEntreprise, Nom, Prenom, NumTelEntreprise, Poste, IdEntreprise, IdUtilisateur)
                            values (:courriel, :Nom, :Prenom , :NumTelEntreprise, :posteTelEntreprise, :idEntreprise, :idUtilisateur)",
                            array(  'courriel'=>$utilisateurs["courriel"], 
                                    'Prenom'=>$utilisateurs["prenom"],
                                    'Nom'=>$utilisateurs["nom"],
                                    'NumTelEntreprise'=>$utilisateurs["noTelEntreprise"],
                                    'posteTelEntreprise'=>$utilisateurs["posteTelEntreprise"],
                                    'idEntreprise'=>$utilisateurs["Entreprise"],
                                    'idUtilisateur'=>$idUtilisateur), 
                                    'stdClass');    

            if ($utilisateurs["Superviseur"] == "true"){
                /*insert into tblUtilisateurRole (IdUtilisateur, IdRole)
                values (160,  3) */
                $bdd->Request("INSERT into tblUtilisateurRole (IdUtilisateur, IdRole)
                                values (:idUtilisateur,  4)", 
                            array( 'idUtilisateur'=>$idUtilisateur), 
                                   'stdClass');    
            }
                //insérer tbl utilisateurRole en superviseur
            if ($utilisateurs["Responsable"] == "true")
            {

                $bdd->Request("INSERT into tblUtilisateurRole (IdUtilisateur, IdRole)
                            values (:idUtilisateur,  2)", 
                            array( 'idUtilisateur'=>$idUtilisateur), 
                                   'stdClass'); 
            }
               //insérer tbl utilisateurRole en Responsable
        }
        else 
        {
                echo '-1';            
        }
    }

    function creationEnseignant($bdd, $utilisateurs)
    {
        if (validerCourrielUnique($bdd, $utilisateurs))
            {
                insertionTblUtilisateur($bdd, $utilisateurs);
            
                $result = $bdd->Request("SELECT Id from tblUtilisateur where Courriel like :courriel;", 
                    array('courriel'=>$utilisateurs["courriel"]) ,'stdClass');

                foreach($result as $resultat){
                   $idUtilisateur =  $resultat->Id;
                } 

            $bdd->Request(" INSERT into tblEmploye (CourrielEntreprise, Nom, Prenom, IdEntreprise, IdUtilisateur)
                                    values (:courriel, :Nom, :Prenom, 51, :IdUtilisateur)",
                            array('courriel'=>$utilisateurs["courriel"], 
                                    'Prenom'=>$utilisateurs["prenom"],
                                    'Nom'=>$utilisateurs["nom"],
                                    'IdUtilisateur'=>$idUtilisateur), 
                            'stdClass');   
            //insertion dans la tblUtilisateurRole
            $bdd->Request("INSERT into tblUtilisateurRole (IdUtilisateur, IdRole)
                values (:idUtilisateur,  3)", 
                array( 'idUtilisateur'=>$idUtilisateur), 
                       'stdClass');      
        }
        else 
        {
                echo '-1';            
        }
    }

    function insertionTblUtilisateur($bdd, $utilisateurs)
    {
          $bdd->Request(" INSERT into tblUtilisateur (Courriel, MotDePasse)
                            values (:courriel , '$2y$10\$\J\/WmC4JWR42JtTeMp0yBpuTGd.Kc9D6lHlOtisNcOLZloa9ekK/Ee')",
                            array('courriel'=>$utilisateurs["courriel"]), 'stdClass');


    }


    function showEnterprises($bdd)
    {
        $returnValue = "";
        $entreprises = $bdd->Request("select Nom, Id from vEntreprise;", null, "stdClass");

        foreach($entreprises as $entreprise){
            $returnValue = $returnValue . '<option value= "' . $entreprise->Id . '">' . $entreprise->Nom . '</option>';

        }
                return $returnValue;

    }

    function validerCourrielUnique($bdd, $utilisateurs)
    {
         $nbCourrielUnique = -1;
            $result = $bdd->Request("SELECT count(*) as 'nbCourrielUnique' from tblUtilisateur where courriel like :courriel;", 
                array('courriel'=>$utilisateurs["courriel"]),'stdClass');
                    


                    foreach($result as $resultat){
                       $nbCourrielUnique =  $resultat->nbCourrielUnique;
                    }
            if ($nbCourrielUnique == 0 )
                return true;
            else
                return false;


    }

    
?>
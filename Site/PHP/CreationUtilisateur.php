<?php

/* onclick= "Execute(12, \'../PHP/TBNavigation.php?&nomMenu=InsertStage\'
2 = responsable
3 = enseignant
4 = superviseur
5 = stagiaire */
     if(isset($_REQUEST["post"]))
        creationUtilisateur($bdd);


        function creationUtilisateur($bdd)
        {
        $champs = json_decode($_POST["tabChamp"]);
               // var_dump($champs[3]->value);

        $entreprise = array();
        
        foreach($champs as $champ){
            $entreprise[$champ->nom] = $champ->value;
        }
        
        $bdd->Request(" INSERT into tblUtilisateur (Courriel, MotDePasse)
                        values (:courriel , '$2y$10\$\J\/WmC4JWR42JtTeMp0yBpuTGd.Kc9D6lHlOtisNcOLZloa9ekK/Ee')",
                        array('courriel'=>$champs[3]->value), 'stdClass');
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

     $content =
            '

            <article class="stagiaire">
                <div id="modifStagiaire" >
                     <p class="label labelForInput">Selectionnez le type d\'utilisateur</p>
                            <select class="value" class = "infosStage" name = "userType" onChange="changeUserType(this)">
                                <option disabled selected value> -- select an option -- </option>
                                <option value = "5">Stagiaire</option>
                                <option value = "2">Employé d\'entreprise</option>
                                <option value = "3">Enseignant</option>
                            </select>
                <div class = "champ" id = "Prenom">
                    <br>
                    <p class="label labelForInput">Prenom :</p>
                    <input type="text" value="" id="prenom" class="value" name = "prenom"/>
                </div>

               <div class = "champ" id = "Nom">
                <br>
                <p class="label labelForInput">Nom :</p>
                <input type="text" value="" class="value" name = "nom"/>
                </div>

                <div class = "champ" id = "courriel">
                 <br>
                <p class="label labelForInput">Courriel :</p>
                <input type="text" value="" class="value" name = "courriel"/>
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
                <input type="text" value="" class="value" name = "noTelEntreprise"/>
                </div>

                <div class = "champ" id = "posteTelEntreprise">
                <br>
                <p class="label labelForInput">Poste téléphonique :</p>
                <input type="text" value="" class="value" name = "posteTelEntreprise"/>
                </div>

                <div class = "champ" id="posteEntreprise">
                <input type="checkbox" name="Superviseur" value="superviseur" name = "estSuperviseur"> l\'eployé est un superviseur<br>
                <input type="checkbox" name="Responsable" value="Responsable" checked name = "estResponsable">L\'employé est un responsable<br>
                </div>


                <br>
                <input type="button" id="Save" class="bouton" value="Sauvegarder" onclick ="Execute(5, \'../PHP/TBNavigation.php?nomMenu=CreationUtilisateur.php&post\')" />
                
            </div>
            </article>';
            return $content;

?>
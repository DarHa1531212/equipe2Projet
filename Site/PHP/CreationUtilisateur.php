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
                    var_dump($_POST["tabChamp"]);

            $entreprise = array();

            foreach($champs as $champ){
                $entreprise[$champ->nom] = $champ->value;
            }

            $bdd->Request(" INSERT INTO tblEntreprise (CourrielEntreprise, Nom, NumTel, NumCivique, Rue, Ville, Province, CodePostal, Logo) 
                            VALUES (:courriel, :nom, :numTel, :numCivique, :rue, :ville, :province, :codePostal, :logo)",
                            array(
                            'courriel'=>$entreprise["courriel"],
                            'nom'=>$entreprise["nom"],
                            'numTel'=>$entreprise["numTel"],
                            'numCivique'=>$entreprise["numCivique"],
                            'rue'=>$entreprise["rue"],
                            'ville'=>$entreprise["ville"],
                            'province'=>$entreprise["province"],
                            'codePostal'=>$entreprise["codePostal"],
                            'logo'=>$entreprise["logo"]),
                            'stdClass');
        }

    $content =
    '
    <article class="stagiaire">
        <div id="modifStagiaire" >
             <p class="label labelForInput">Selectionnez le type d\'utilisateur</p>
                    <select class="value" class = "infosStage"  onChange="changeUserType(this)">
                        <option disabled selected value> -- select an option -- </option>
                        <option value = "5">Stagiaire</option>
                        <option value = "2">Employé d\'entreprise</option>
                        <option value = "3">Enseignant</option>
                    </select>
        <div class = "champ" id = "Prenom">
            <br>
            <p class="label labelForInput">Prenom :</p>
            <input type="text" value="" id="prenom" class="value"/>
        </div>

       <div class = "champ" id = "Nom">
        <br>
        <p class="label labelForInput">Nom :</p>
        <input type="text" value="" class="value"/>
        </div>

        <div class = "champ" id = "courriel">
         <br>
        <p class="label labelForInput">Courriel :</p>
        <input type="text" value="" class="value"/>
        </div>

        <div class = "champ" id = "noTelEntreprise">
        <br>
        <p class="label labelForInput">Numero de telephone entreprise :</p>
        <input type="text" value="" class="value"/>
        </div>

        <div class = "champ" id = "posteTelEntreprise">
        <br>
        <p class="label labelForInput">Poste téléphonique :</p>
        <input type="text" value="" class="value"/>
        </div>

        <div class = "champ" id="posteEntreprise">
        <input type="checkbox" name="Superviseur" value="superviseur"> l\'eployé est un superviseur<br>
        <input type="checkbox" name="Responsable" value="Responsable" checked>L\'employé est un responsable<br>
        </div>


        <br>
        <input type="button" id="Save" class="bouton" value="Sauvegarder" onclick ="Execute(5, \'../PHP/TBNavigation.php?nomMenu=CreationUtilisateur.php&post\')" />


        <input type="button" value = "Stgiaire" onclick="afficherChampsStagiaire();">
    </div>
    </article>';
    return $content;

?>
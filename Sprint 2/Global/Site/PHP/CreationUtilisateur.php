<?php

/* onclick= "Execute(12, \'../PHP/TBNavigation.php?&nomMenu=InsertStage\'
2 = responsable
3 = enseignant
4 = superviseur
5 = stagiaire */


     $content =
            '
            <script src="../js/creationUtilisateur.js"></script>

            <article class="stagiaire">
                <div id="modifStagiaire" >

                     <p class="label labelForInput">Selectionnez le type d\'utilisateur</p>
                            <select class="value" class = "infosStage"  onChange="Execute(13, \'../PHP/TBNavigation.php?&nomMenu=InsertStage\', this)">
                                <option value = "5">Stagiaire</option>
                                <option value = "2">Responsable</option>
                                <option value = "4">Superviseur</option>
                                <option value = "3">Enseignant</option>


                            </select>
                <br>
                <p class="label labelForInput">Prenom :</p>
                <input type="text" value="" class="value"/>

                <br>
                <p class="label labelForInput">Nom :</p>
                <input type="text" value="" class="value"/>

                 <br>
                <p class="label labelForInput">Courriel :</p>
                <input type="text" value="" class="value"/>

                <br>
                <p class="label labelForInput">Numero de telephone entreprise :</p>
                <input type="text" value="" class="value"/>
            
                <br>
                <p class="label labelForInput">Poste téléphonique :</p>
                <input type="text" value="" class="value"/>

                <br>
                <p class="label labelForInput">Courriel en entreprise :</p>
                <input type="text" value="" class="value"/>

                <br>
                <p class="label labelForInput">Code permanent :</p>
                <input type="text" value="" class="value"/>

                <br>
                <p class="label labelForInput">Courriel personnel :</p>
                <input type="text" value="" class="value"/>

                <br>
                <p class="label labelForInput">Numéro de téléphone personnel :</p>
                <input type="text" value="" class="value"/>

                <br>
                <input type="button" id="Save" class="bouton" value="Sauvegarder" />
            </div>
            </article>';
            return $content

    }

?>
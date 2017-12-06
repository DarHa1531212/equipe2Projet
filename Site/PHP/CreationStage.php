<?php
    
    if(isset($_REQUEST["post"]))
        CreateStage($bdd);
        
    function CreateStage($bdd){
        $champs = json_decode($_POST["tabChamp"]);
        $stage = array();
        
        foreach($champs as $champ){
            $stage[$champ->nom] = $champ->value;
        }

        $bdd->Request(" INSERT INTO tblStage (IdResponsable, IdSuperviseur, IdStagiaire, IdEnseignant, DescriptionStage, CompetenceRecherche, HoraireTravail, NbHeureSemaine, SalaireHoraire, DateDebut, DateFin ) 
                        VALUES (:idResponsable, :idSuperviseur, :idStagiaire, :idEnseignant, :description, :competence, :horaire, :nbHeure, :salaire, :dateDebut, :dateFin);",
                        array(
                            'idResponsable'=>$stage["Responsable"], 
                            'idSuperviseur'=>$stage["Superviseur"], 
                            'idStagiaire'=>$stage["Stagiaire"], 
                            'idEnseignant'=>$stage["Enseignant"],
                            'description'=>$stage["DescStage"], 
                            'competence'=>$stage["CompetancesRecherchees"], 
                            'horaire'=>$stage["SalaireHoraire"], 
                            'nbHeure'=>$stage["HeuresSemaine"],
                            'salaire'=>$stage["SalaireHoraire"], 
                            'dateDebut'=>$stage["DateDebut"], 
                            'dateFin'=>$stage["DateFin"]), 
                            'stdClass');
    }

    //affiche les entreprises dans le dropdown menu
    function showEnterprises($bdd)
    {
        $returnValue = "";
        $entreprises = $bdd->Request("select Nom, Id from vEntreprise;", null, "stdClass");

        foreach($entreprises as $entreprise){
            $returnValue = $returnValue . '<option value= "' . $entreprise->Id . '">' . $entreprise->Nom . '</option>';

        }
        
        return $returnValue;
    }

    function showEmployees($bdd){
        if(isset($_POST["tabChamp"])){
            
        }
        $champs = json_decode($_POST["tabChamp"]);
        $test = array();
        

        foreach($champs as $champ){
            $test[$champ->nom] = $champ->value;
        }
        
        $superviseurs = $bdd->Request(" SELECT IdUtilisateur, CONCAT(Prenom, ' ', Nom) AS Nom
                                        FROM vEmploye
                                        WHERE IdEntreprise : idEntreprise",
                                        array("idEntreprise"=>$test["Entreprise"]), "stdClass");
            
        var_dump($test);
    }
 
    //affiche les entreprises dans le dropdown menu
    function showProfessors($bdd)
    {
        $returnData = "";
        $profs = $bdd->Request("select concat (Prenom, ' ' , Nom) as nomEnseignant, IdEnseignant from vEnseignant;", null, "stdClass");

        foreach($profs as $prof)
            $returnData = $returnData . '<option value= "' . $prof->IdEnseignant .'">' . $prof->nomEnseignant . '</option>';
        
        return $returnData;
    }

    // affiche les stagiaires dans le dropdown menu
    function showInterns($bdd)
    {
        $returnValue = "";
        $stagiaires = $bdd->Request("select concat (Prenom, ' ' , Nom) as nomStagiaire, Id from vStagiaire;", null, "stdClass");

        foreach($stagiaires as $stagiaire)
            $returnValue = $returnValue . '<option value= "' . $stagiaire->Id . '">' . $stagiaire->nomStagiaire . '</option>';

        return $returnValue;
    }

    $content =
    '<script src="../js/creationStage.js"></script>
    <article class="stagiaire">
        <div class="infoStagiaire">
            <h2>Stages</h2>
        </div>

        <div class="separateur">
            <h3>Création d\'un Stage</h3>
        </div>

        <div class="blocInfo infoProfil">
            <div class="champ">
                <p class="label labelForInput">Entreprise</p>
                <select class="value" name = "Entreprise" onchange="Post(ExecuteQuery, \'../PHP/TBNavigation.php?nomMenu=CreationStage.php\')">
                    ' . showEnterprises($bdd) . '
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Stagiaire</p>
                <select class="value"  name = "Stagiaire">
                    ' . showInterns($bdd) . '
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Responsable</p>
                <select class="value"  name = "Responsable">
                    <option value = "1">Responsable 1</option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Superviseur</p>
                <select class="value"  name = "Superviseur">
                <option value = "1">SUPERVISEUR 1</option>                
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Enseignant</p>
                <select class="value"  name = "Enseignant">
                    ' . showProfessors($bdd) . '
                    </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Heure / Semaine</p>
                <input class="value" type="text"  name = "HeuresSemaine" id="heureSem" onchange="regexCreationStage();"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Rémunéré</p>
                <div>
                    <label for="oui">Oui</label>
                    <input id="oui" type="radio" name="remunere" value="1" checked onclick="DisableSalaire(this)"/>
                    <label for="non">Non</label>
                    <input id="non" type="radio" name="remunere" value="0" onclick="DisableSalaire(this)"/>
                </div>
            </div>
            <div class="champ">
                <p class="label labelForInput">Salaire Horaire</p>
                <input class="value" type="text"  name = "SalaireHoraire" id="salaire" onchange="regexCreationStage();"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Date Début</p>
                <input class="value"  name = "DateDebut" type="date"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Date Fin</p>
                <input class="value"  name = "DateFin" type="date"/>
            </div>

            <br/>

            <div class="champArea">
                <p class="label labelForInput labelArea">Description du stage</p>
                <textarea class="value" class="valueArea"  name = "DescStage"></textarea>
            </div>  
            <div class="champArea">
                <p class="label labelForInput labelArea">Compétences recherchées</p>
                <textarea class="value" class="valueArea"  name = "CompetancesRecherchees"></textarea>
            </div>

        <!--afficher les inforations détaillées d\'un stage -->
        <div id="readStage"></div>

		<br>
            <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeStage.php\')"/>      
            <input class="bouton" type="button" id="Save" style="width: 100px;" value=" Sauvegarder " onclick= "Post(AfficherPage, \'../PHP/TBNavigation.php?&nomMenu=CreationStage.php&post\')"/>
            <br/><br/>
    </div>   
    <br>

<!-- Fin de section création de stage -->';


return $content;

?>
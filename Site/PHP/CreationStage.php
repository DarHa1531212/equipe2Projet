<?php
    
    if(isset($_REQUEST["post"]))
        CreateStage($bdd);
        
    function CreateStage($bdd){
        $champs = json_decode($_POST["tabChamp"]);
        $stage = array();
        
        foreach($champs as $champ){
            $stage[$champ->nom] = $champ->value;
        }


      //  var_dump($stage);

        $bdd->Request(" INSERT INTO tblStage ( IdResponsable, IdSuperviseur, IdStagiaire, IdEnseignant, DescriptionStage, CompetenceRecherche, NbHeureSemaine, SalaireHoraire, DateDebut, DateFin, IdSession) VALUES (:idResponsable, :idSuperviseur, :idStagiaire, :idEnseignant, :description, :competence, :nbHeure, :salaire, :dateDebut, :dateFin, :idSession);",
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
                            'idSession'=>$stage["Session"]), 
                            'stdClass');
    }

    //affiche les entreprises dans le dropdown menu
    function showEnterprises($bdd)
    {
        $returnValue = "";
        $entreprises = $bdd->Request("SELECT Nom, Id from vEntreprise;", null, "stdClass");

        foreach($entreprises as $entreprise){
            $returnValue = $returnValue . '<option value= "' . $entreprise->Id . '">' . $entreprise->Nom . '</option>';
        }
        
        return $returnValue;
    }

    function showSessions ($bdd)
    {
        $returnValue = "";
        $sessions = $bdd->Request("SELECT concat (Periode, ' ' , Annee) as 'Session', Id from vSession;", null, "stdClass");

        foreach ($sessions as $session) 
        {
            $returnValue = $returnValue.  '<option value= "' . $session->Id . '">' . $session->Session . '</option>';
        }

        return $returnValue;
    }

    //Requete pour rechercher les employes qui travaille pour l'entreprise sélectionnée et les insères dans les dropDownList.
    if(isset($_REQUEST["populate"]))
        return showEmployees($bdd);

    function showEmployees($bdd){
        $champs = json_decode($_POST["tabChamp"]);
        $entreprise = array();
        $option = "";

        foreach($champs as $champ){
            $entreprise[$champ->nom] = $champ->value;
        }
        
        $employes = $bdd->Request(" SELECT IdUtilisateur, CONCAT(Prenom, ' ', Nom) AS Nom
                                    FROM vEmploye
                                    WHERE IdEntreprise = :idEntreprise",
                                    array("idEntreprise"=>$entreprise["Entreprise"]), "stdClass");

        return $employes;
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
    '
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
                <select class="value" name = "Entreprise" onchange="Post(PopulateListEmploye, \'../PHP/TBNavigation.php?nomMenu=CreationStage.php&populate\')">
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
                <p class="label labelForInput">Session</p>
                <select class="value"  name = "Session">
                    ' . showSessions($bdd) . '
                </select>
            </div>

            <div class="champ">
                <p class="label labelForInput">Responsable</p>
                <select class="value"  name = "Responsable" id="responsable">
                    <option value = "1">Responsable</option>
                </select>
            </div>

            <div class="champ">
                <p class="label labelForInput">Superviseur</p>
                <select class="value"  name = "Superviseur" id="superviseur">
                <option value = "1">Superviseur</option>                
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
                <input class="value" type="text"  name = "HeuresSemaine" id="heureSem" onblur="VerifierRegex(this);" pattern="'.$regxHeure.'"/>
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
                <input class="value" type="text"  name = "SalaireHoraire" id="salaire" onblur="VerifierRegex(this);" pattern="'.$regxSalaire.'"/>
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
                <textarea class="value valueArea" name="DescStage"></textarea>
            </div>  
            <div class="champArea">
                <p class="label labelForInput labelArea">Compétences recherchées</p>
                <textarea class="value valueArea" name="CompetancesRecherchees"></textarea>
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
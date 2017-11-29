<?php

    include 'ConnexionBD.php';
    $Stage = new cStage($bdd);

    //affiche les entreprises dans le dropdown menu
    function showEnterprises($bdd)
    {
     $returnValue = "";
      $query = $bdd->prepare("select Nom, Id from vEntreprise;");

          $query->execute(array());     
          $entrees = $query->fetchAll();
          
          foreach($entrees as $entree){
              $nomEntreprise = $entree["Nom"];
              $idEntreprise = $entree["Id"];

              $returnValue = $returnValue . '<option value= "' . $idEntreprise . '">' . $nomEntreprise . '</option>';
              }
        return $returnValue;
    }

   
 
 //affiche les entreprises dans le dropdown menu
    function showProfessors($bdd)
    {
      $returnData = "";
      $query = $bdd->prepare("select concat (Prenom, ' ' , Nom) as nomEnseignant, IdEnseignant from vEnseignant;");

          $query->execute(array());     
          $entrees = $query->fetchAll();
          
          foreach($entrees as $entree){
              $nomEnseignant = $entree["nomEnseignant"];
              $IdEnseignant = $entree["IdEnseignant"];
              $returnData = $returnData . '<option value= "' . $IdEnseignant .'">' . $nomEnseignant . '</option>';
            }
  return $returnData;
  }

  // affiche les stagiaires dans le dropdown menu

  function showInterns($bdd)
  {
     $returnValue = "";
     $query = $bdd->prepare("select concat (Prenom, ' ' , Nom) as nomStagiaire, Id from vStagiaire;");

      $query->execute(array());     
      $entrees = $query->fetchAll();
      
      foreach($entrees as $entree){
          $nomStagiaire = $entree["nomStagiaire"]; 
          $idStagiaire = $entree["Id"];
          $returnValue = $returnValue . '<option value= "' . $idStagiaire . '">' . $nomStagiaire . '</option>';
       }
       return $returnValue;
  }

 //   $dropDownInterns = "patate";
    $dropDownInterns = showInterns($bdd);
    $professors = showProfessors($bdd);
    $enterprises = showEnterprises($bdd);



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
                <select class="value" name = "Entreprise">
                    ' . $enterprises . '
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Stagiaire</p>
                <select class="value"  name = "Stagiaire">
                    ' . $dropDownInterns . '
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
                    ' . $professors . '
                    </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Heure / Semaine</p>
                <input class="value" type="text"  name = "HeuresSemaine"/>
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
                <input class="value" type="text"  name = "SalaireHoraire" id="salaire"/>
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


            <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Execute(1, \'../PHP/TBNavigation.php?nomMenu=Stage\')"/>
           

            <input class="bouton" type="button" id="Save" style="width: 100px;" value=" Sauvegarder " onclick= "Execute(12, \'../PHP/TBNavigation.php?&nomMenu=InsertStage\')"/>

            <br/><br/>
        </div>   
    <br>

<!-- Fin de section création de stage -->';


return $content;

?>
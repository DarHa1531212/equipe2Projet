<?php

include 'ConnexionBD.php';
   
 
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

 //récupère les stages dans la BD et les affiche dans le tableau
    function showInternships($bdd)
    {
       $returnData = "";
       $query = $bdd->prepare("Select concat (vStagiaire.Prenom, ' ' , vStagiaire.Nom ) as 'Stagiaire',  vEntreprise.Nom, vStage.Id from vStage
    join vStagiaire on vStagiaire.IdUtilisateur = vStage.IdStagiaire
    join vSuperviseur on vSuperviseur.IdUtilisateur = vStage.IdSuperviseur
    join vEntreprise on vEntreprise.id = vSuperviseur.IdEntreprise;");
 
 
      $query->execute(array());     
      $entrees = $query->fetchAll();
      //
      foreach($entrees as $entree){
          $nomStagiaire = $entree["Stagiaire"];
          $entreprise = $entree["Nom"];
          $idStage = $entree["Id"];
          $returnData = $returnData .  '<tr>
                  <th  id="' 
                  . $idStage . '" value="' 
                  . $idStage . '
                  "  onclick="Execute(1,\'../PHP/TBNavigation.php?nomMenu=ReadStage\',\'&idStage=\',this.id)">
                  ' . $nomStagiaire . '</th>
                  <th>' . $entreprise . '</th>
                  <th>Lettre dentente</th>
                  <th>Offre de stage</th>
                </tr>';
      }      
        return $returnData;
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
    $internships = showInternships($bdd);
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
                <select class="value" class = "infosStage">
                    ' . $enterprises . '
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Stagiaire</p>
                <select class="value" class = "infosStage">
                    ' . $dropDownInterns . '
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Responsable</p>
                <select class="value" class = "infosStage">
                    <option></option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Superviseur</p>
                <select class="value" class = "infosStage">
                    <option></option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Enseignant</p>
                <select class="value" class = "infosStage">
                    ' . $professors . '
                    </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Heure / Semaine</p>
                <input class="value" type="text"/>
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
                <input class="value" type="text" id="salaire"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Date Début</p>
                <input class="value" type="date"/>
            </div>
            <div class="champ">
                <p class="label labelForInput">Date Fin</p>
                <input class="value" type="date"/>
            </div>

            <br/>

            <div class="champArea">
                <p class="label labelForInput labelArea">Description du stage</p>
                <textarea class="valueArea"></textarea>
            </div>  
            <div class="champArea">
                <p class="label labelForInput labelArea">Compétences recherchées</p>
                <textarea class="valueArea"></textarea>
            </div>

    <!--afficher les inforations détaillées d\'un stage -->
  <div id="readStage"></div>

		<br>


            <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye=\'.$_SESSION [\'id\'].\'&nomMenu=Main\')"/>
            <input class="bouton" type="button" id="Save" style="width: 100px;" value="Sauvegarder"/>

            <br/><br/>
        </div>

        <div class="separateur">
        </div>

        <div class="blocInfo infoProfil">
            <table class="stage">
                <thead>
                    <th>Entreprise </th>
                    <th>Stagiaire</th>
                    <th>Lettre d\'entente</th>
                    <th>Offre de Stage</th>
                    <th></th>
                </thead>

      </select>
    <br>

  <!--onchange="Execute(7,\'../PHP/TBNavigation.php?nomMenu=CRUDStage\')" -->


    <br>

	<BR>

<!-- Fin de section création de stage -->





<!-- section affichege de stages -->
  <h2>Stages actuellement dans le système</h2>
  <table>
    <tr>
      <th>Employe</th>
      <th>Travaille pour</th>
    </tr> ' . $internships . '
   
    </table>
<!-- fin de section affichege de stages -->

	</body>
</html> ';

return $content;

?>
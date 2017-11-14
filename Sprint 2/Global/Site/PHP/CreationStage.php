 <!DOCTYPE html>

<!-- 
Nom: Hans Darmstadt-Bélanger
Date: 31 octobre 2017
But: Un écran de CRUD qui permet de gérer des stages
-->
<html>
  <head>

    <!--/!\SUPPRIMER CETTE LIGNE LORSQUE LA PAGE SERA LIÉE AU REST DU SITE/!\ -->
    <script src="../js/navigation.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/creationStage.js"></script>
    <!--/!\SUPPRIMER CETTE LIGNE LORSQUE LA PAGE SERA LIÉE AU REST DU SITE/!\ -->


    <?php
    include 'connexionBD.php'; 
    include 'Session.php';
    ?>

    <!-- Section création de stage -->
   		<meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Creation stage</title>
          <meta name="description" content="An interactive getting started guide for Brackets.">
          <link rel="stylesheet" href="../CSS/style.css">
          <link rel="shortcut icon" href="../Images/LogoDICJ2Petit.ico">
  </head>
  <body>

  <form  action="insertion.php" method="POST">
    <h2>Créer un stage</h2>
    <br>
      <select id="stagiaire"  name="stagiaire" value="-1" class = "infosStage"  selected="selected">
          <option disabled="disabled" selected >Sélectionnez un stagiaire</option>
          <?php 

          // affiche les stagiaires dans le dropdown menu

          showInterns($bdd);
          function showInterns($bdd)
          {
             $query = $bdd->prepare("select concat (Prenom, ' ' , Nom) as nomStagiaire, Id from vStagiaire;");

              $query->execute(array());     
              $entrees = $query->fetchAll();
              
              foreach($entrees as $entree){
                  $nomStagiaire = $entree["nomStagiaire"]; 
                  $idStagiaire = $entree["Id"];
                  echo '<option value= "' . $idStagiaire . '">' . $nomStagiaire . '</option>';
               }
          }

          ?>

      </select>
    <br>
       <select id="entreprise" name = "entreprise" class = "infosStage" onchange="Execute(7,'../PHP/TBNavigation.php?nomMenu=CRUDStage')" > 
          <option value="-1"  disabled="disabled" selected >Sélectionnez une entreprise</option>
          <?php 
          
            //affiche les entreprises dans le dropdown menu
            showEnterprises($bdd);
            function showEnterprises($bdd)
            {
              $query = $bdd->prepare("select Nom, Id from vEntreprise;");

                  $query->execute(array());     
                  $entrees = $query->fetchAll();
                  
                  foreach($entrees as $entree){
                      $nomEntreprise = $entree["Nom"];
                      $idEntreprise = $entree["Id"];

                      echo '<option value= "' . $idEntreprise . '">' . $nomEntreprise . '</option>';
                      }
          }
          ?>

      </select>
    <br>
       <select id="responsableStage" name = "responsableStage" class = "infosStage">
          <option  value="-1"  disabled="disabled" selected >Sélectionnez un responsable de stage</option>
          <option value="1">One</option>
          <option value="2">Two</option>
      </select>
    <br>
       <select id="superviseurStage" name= "superviseurStage" class = "infosStage" >
          <option  value="-1" disabled="disabled" selected>Sélectionnez un superviseur de stage</option>
          <option value="1">One</option>
          <option value="2">Two</option>
        </select>
    <br>
        <select id="enseignant" name = "enseignant" class = "infosStage">
          <option  value="-1"  disabled="disabled" selected >Sélectionnez un enseignant</option>
          <?php 
                //affiche les entreprises dans le dropdown menu
                showProfessors($bdd);
                function showProfessors($bdd)
                {
                  $query = $bdd->prepare("select concat (Prenom, ' ' , Nom) as nomEnseignant, IdEnseignant from vEnseignant;");

                      $query->execute(array());     
                      $entrees = $query->fetchAll();
                      
                      foreach($entrees as $entree){
                          $nomEnseignant = $entree["nomEnseignant"];
                          $IdEnseignant = $entree["IdEnseignant"];
                          echo '<option value= "' . $IdEnseignant .'">' . $nomEnseignant . '</option>';
                        }
              }
            ?>
      </select>
    <br>

    <p>Descrption de stage:</p>
    <textarea id="descStage" rows="5" name = "descStage" class = "infosStage"  cols="100" maxlength="500" name="descStage" wrap="hard"></textarea>
                <br>
    <p>compétances recherchées</p>
    <textarea  id="competencesRecherchees" name = "competencesRecherchees" class = "infosStage" rows="5" cols="100" maxlength="500" name="competancesRecherchees" wrap="hard"></textarea>
                <br>
    Horaire de travail <input id="horaireTravail" name = "horaireTravail" class = "infosStage" type="text" name="horaireTravail" value="temps plein/ partiel"><br>
    Heures par semaine <input id="heuresTravail" name = "heuresTravail" class = "infosStage" type="text" name="heuresTravail" value="heures par semaine"><br>
    <br>
    Taux horaire (laisser vide si stage non rémunété) <input name = "tauxHoraire" id="tauxHoraire" type="text" class = "infosStage" name="tauxHoraire" value="Taux Horaire"><br>
    Date de début:  <input name = "dateDebut" id="dateDebut" class = "infosStage" type="date" name="dateDebut"> <br>
    Date de fin:  <input  name = "dateFin" id="dateFin" class = "infosStage" type="date" name="dateFin"> <br>


    <input type="button" id="Save" class="bouton" value="Sauvegarder" onclick="Execute(6, '../PHP/TBNavigation.php?nomMenu=CRUDStage')" />
 	 </form>
    <br>

  <BR>

<!-- Fin de section création de stage -->


<!-- section affichege de stages -->
  <h2>Stages actuellement dans le système</h2>
  <table>
    <tr>
      <th>Employe</th>
      <th>Travaille pour</th>
    </tr>
    

  <?php
    showInternships($bdd);
    //récupère les stages dans la BD et les affiche dans le tableau
    function showInternships($bdd)
    {
       $query = $bdd->prepare("Select concat (vStagiaire.Prenom, ' ' , vStagiaire.Nom ) as 'Stagiaire',  vEntreprise.Nom, vStage.Id from vStage
    join vStagiaire on vStagiaire.IdUtilisateur = vStage.IdStagiaire
    join vResponsable on vResponsable.IdUtilisateur = vStage.IdResponsable
    join vEntreprise on vEntreprise.id = vResponsable.IdEntreprise
    ;");
 
 
      $query->execute(array());     
      $entrees = $query->fetchAll();
      
      foreach($entrees as $entree){
          $nomStagiaire = $entree["Stagiaire"];
          $entreprise = $entree["Nom"];
          $idStage = $entree["Id"];
          echo '<tr>
                  <th id="' . $idStage .'" onClick="readStage(8,\'../PHP/TBNavigation.php?nomMenu=CRUDStage\', this.id)">' . $entreprise . '</th>
                  <th>' . $nomStagiaire . '</th>
                  <th>Lettre dentente</th>
                  <th>Offre de stage</th>
                </tr>';
      }      
    }
  ?>
    </table>
<!-- fin de section affichege de stages -->

  </body>
</html> 
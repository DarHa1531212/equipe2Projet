 <!DOCTYPE html>

<!-- 
Nom: Hans Darmstadt-Bélanger
Date: 12 Novembre 2017
But: Un écran de CRUD qui permet de gérer des employés des entreprises
-->
<html>
  <head>

    <!--/!\SUPPRIMER CETTE LIGNE LORSQUE LA PAGE SERA LIÉE AU REST DU SITE/!\ -->
    <script src="../js/navigation.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/creationEmployeEntreprise.js"></script>

    <?php
    include 'connexionBD.php'; 
    include 'Session.php';
    ?>

    <!-- Section création de stagiaire -->
   		<meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Creation Employe</title>
          <meta name="description" content="An interactive getting started guide for Brackets.">
          <link rel="stylesheet" href="../CSS/style.css">
          <link rel="shortcut icon" href="../Images/LogoDICJ2Petit.ico">
  </head>
  <body>
    <h2>Créer un employé</h2>
    <br>
    Prenom de l'employé <input id="prenomEmploye" class = "data" type="text" name="prenomEmploye" value="prenom"><br>
    Nom de l'employe <input id="nomEmploye" class = "data" type="text" name="nomEmploye" value="nom"><br>
    Courriel de l'employé <input id="courrielEmployé" class = "data" type="text" name="courrielEmployé" value="nom.prenom@entreprise.ca"><br>
	Numéro de téléphone de l'employé<input id="telEmploye" class = "data" type="text" name="telEmploye" value="(123) 132-1234"><br>
	Poste téléphonique de l'employé<input id="posteTelEmploye" class = "data" type="text" name="posteTelEmploye" value="1234567"><br>


<select id="entreprise" name = "entreprise" class = "data" >
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
    

    
    <!-- paramètre à passer (dans l'ordre): prenomStagiaire, nomStagiaire, courrielStagiaire-->
    <input type="button" id="Save" class="bouton" value="Sauvegarder" onclick="Execute(6, '../PHP/TBNavigation.php?nomMenu=CRUDEmployeEntreprise');" />
    <br>

  <BR>

<!-- Fin de section création de stagiaire -->


<!-- section affichage de stagiaires -->
  <h2>Employés actuellement dans le système</h2>
  <table>
    <tr>
      <th>Nom Employe</th>
      <th>Courriel Entreprise</th>
    </tr>
    

  <?php
    showInternships($bdd);
    //récupère les stages dans la BD et les affiche dans le tableau
    function showInternships($bdd)
    {

      $query = $bdd->prepare("select concat (vEmploye.Prenom, ' ', vEmploye.Nom) as 'NomEmploye', vEmploye.CourrielEntreprise as 'CourrielEntreprise', vEmploye.IdUtilisateur as 'IdEmploye'from vEmploye ");
      $i = 0;
      $query->execute(array());     
      $entrees = $query->fetchAll();
      
      foreach($entrees as $entree){
          $NomEmploye = $entree["NomEmploye"];
          $CourrielEntreprise = $entree["CourrielEntreprise"];
          $IdEmploye = $entree["IdEmploye"];

            echo '<tr>
                  <th id="' . $IdEmploye .'" value="' . $IdEmploye . '" onClick="Execute(10,\'../PHP/TBNavigation.php?nomMenu=CRUDStage\', this.id)">' . $NomEmploye . '</th>
                  <th>' . $CourrielEntreprise . '</th>
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
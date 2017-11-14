 <!DOCTYPE html>

<!-- 
Nom: Hans Darmstadt-Bélanger
Date: 5 Novembre 2017
But: Un écran de CRUD qui permet de gérer des stagiaires
-->
<html>
  <head>

    <!--/!\SUPPRIMER CETTE LIGNE LORSQUE LA PAGE SERA LIÉE AU REST DU SITE/!\ -->
    <script src="../js/navigation.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/creationStagiaire.js"></script>

    <?php
    include 'connexionBD.php'; 
    include 'Session.php';
    ?>

    <!-- Section création de stagiaire -->
   		<meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Creation stage</title>
          <meta name="description" content="An interactive getting started guide for Brackets.">
          <link rel="stylesheet" href="../CSS/style.css">
          <link rel="shortcut icon" href="../Images/LogoDICJ2Petit.ico">
  </head>
  <body>
    <h2>Créer un stagiaire</h2>
    <br>
    Prenom du stagiaire <input id="prenomStagiaire" class = "data" type="text" name="prenomStagiaire" value="prenom"><br>
    Nom du stagiaire <input id="nomStagiaire" class = "data" type="text" name="nomStagiaire" value="nom"><br>
    Courriel scholaire <input id="courrielStagiaire" class = "data" type="text" name="courrielStagiaire" value="nom.prenom@etu.cegepjonquiere.ca"><br>

    
    <!-- paramètre à passer (dans l'ordre): prenomStagiaire, nomStagiaire, courrielStagiaire-->
    <input type="button" id="Save" class="bouton" value="Sauvegarder" onclick="Execute(4, '../PHP/TBNavigation.php?nomMenu=CRUDStagiaire', 'getValuesFromUser()'); Execute(5, '../PHP/TBNavigation.php?nomMenu=CRUDStagiaire')" />
    <br>

  <BR>

<!-- Fin de section création de stagiaire -->


<!-- section affichage de stagiaires -->
  <h2>Stagiaires actuellement dans le système</h2>
  <table>
    <tr>
      <th>Nom stagiaire</th>
      <th>Courriel scolaire</th>
    </tr>
    

  <?php
    showInternships($bdd);
    //récupère les stages dans la BD et les affiche dans le tableau
    function showInternships($bdd)
    {

      $query = $bdd->prepare("Select concat (Prenom, ' ' , Nom) as 'nomStagiaire', CourrielScolaire from vStagiaire;");
      $i = 0;
      $query->execute(array());     
      $entrees = $query->fetchAll();
      
      foreach($entrees as $entree){
          $nomStagiaire = $entree["nomStagiaire"];
          $courrielScolaire = $entree["CourrielScolaire"];
          echo  '<tr>
                  <th>' . $nomStagiaire . '</th>
                  <th>' . $courrielScolaire . '</th>
                </tr>';

      }      
    }
  ?>
    </table>
<!-- fin de section affichege de stages -->

  </body>
</html> 
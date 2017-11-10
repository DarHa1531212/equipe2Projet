<!DOCTYPE html>

<!-- 
Nom: Hans Darmstadt-Bélanger
Date: 6 Novembre 2017
But: Un écran de CRUD qui permet de gérer des entreprises
-->
<html>
  <head>

    <!--/!\SUPPRIMER CETTE LIGNE LORSQUE LA PAGE SERA LIÉE AU REST DU SITE/!\ -->
    <script src="../js/creationEntreprise.js"></script>
    <script src="../js/navigation.js"></script>
    <script src="../js/jquery.min.js"></script>

    <?php
    include 'connexionBD.php'; 
    include 'Session.php';
    ?>

    <!-- Section création de stagiaire -->
   		<meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Gestion Entreprise</title>
          <meta name="description" content="An interactive getting started guide for Brackets.">
          <link rel="stylesheet" href="../CSS/style.css">
          <link rel="shortcut icon" href="../Images/LogoDICJ2Petit.ico">
  </head>
  <body>
    <h2>Créer une entreprise</h2>
    <br>
    Nom entreprise <input id="nomEntreprise" class = "data" type="text" name="nomEntreprise" value="nom entreprise"><br>
    Adresse entreprise <input id="adresseEntreprise" class = "data" type="text" name="adresseEntreprise" value="adresse entreprise"><br>
    No téléphone entreprise <input id="noTelEntreprise" class = "data" type="text" name="noTelEntreprise" value="numero téléphone"><br>
    <p>description entreprise</p>
    <textarea  id="descEntreprise" name = "descEntreprise" class = "data" rows="5" cols="100" wrap="hard"></textarea>

    <BR> <br>
    <!-- paramètre à passer (dans l'ordre): prenomStagiaire, nomStagiaire, courrielStagiaire-->
    <input type="submit" id="Save" class="bouton" value="Sauvegarder" onclick="Execute(6, '../PHP/TBNavigation.php?nomMenu=CRUDEntreprise'); Execute(5, '../PHP/TBNavigation.php?nomMenu=CRUDEntreprise')" />
    <br>

  <BR>

<!-- Fin de section création de stagiaire -->


<!-- section affichage de stagiaires -->
  <h2>Stagiaires actuellement dans le système</h2>
  <table>
    <tr>
      <th>Entreprise</th>
      <th>Numéro téléphone</th>
      <th>modifier entreprise</th>

    </tr>
    

  <?php 
    showInternships($bdd);
    //récupère les stages dans la BD et les affiche dans le tableau
    function showInternships($bdd)
    {

      $query = $bdd->prepare("select nom, concat (NumCivique, ' ' , Rue, ' ' , Province) as 'adresse' from vEntreprise");
      $i = 0;
      $query->execute(array());     
      $entrees = $query->fetchAll();
      
      foreach($entrees as $entree){
          $nomEntreprise = $entree["nom"];
          $adresseEntreprise = $entree["adresse"];
          echo $i . '<tr>
                  <th>' . $nomEntreprise . '</th>
                  <th>' . $adresseEntreprise . '</th>
                </tr>';

      }    
      if ($i ==0)
      {
      	echo 'aucune entrée trouvée';
      }  
    } 
  ?>
    </table>
<!-- fin de section affichege de stages -->

  </body>
</html> 
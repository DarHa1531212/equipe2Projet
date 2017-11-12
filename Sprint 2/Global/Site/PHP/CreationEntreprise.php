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
	numéro civique <input id="numCiviqueEntreprise" class = "data" type="text" name="numCiviqueEntreprise" value="Numéro civique"><br>
	Rue<input id="rueEntreprise" class = "data" type="text" name="rueEntreprise" value="Rue"><br>
	ville <input id="villeEntreprise" class = "data" type="text" name="villeEntreprise" value="Ville"><br>
	<p>Sélectionnez une province</p>
	<select id="provinceEntreprise" name = "provinceEntreprise" class = "data">
          <option  value="-1"  disabled="disabled" selected >Sélectionnez une province</option>
          <option value="AB">Alberta</option>
          <option value="BC">Colombie Britannique</option>
		  <option value="PE">Île-du-Prince-Édouard</option>
		  <option value="MB">Manitoba</option>
		  <option value="NB">Nouveau-Brunswick</option>
		  <option value="NS">Nouvelle-Écosse</option>
		  <option value="ON">Ontario</option>
		  <option value="QC">Québec</option>
		  <option value="SK">Saskatchewan</option>
		  <option value="NL">Terre-Neuve-et-Labrador</option>
		  <option value="NU">Nunavut</option>
		  <option value="NT">Territoires du Nord-Ouest</option>
  		  <option value="YT">Yukon</option>
    </select>
	<BR>
	Code postal<input id="codePostallEntreprise" class = "data" type="text" name="codePostalEntreprise" value="CodePostal"><br>
	No téléphone entreprise <input id="noTelEntreprise" class = "data" type="text" name="noTelEntreprise" value="numero téléphone"><br>
    <p>description entreprise</p>
    <textarea  id="descEntreprise" name = "descEntreprise" class = "data" rows="5" cols="100" wrap="hard"></textarea><br>
	courriel entreprise <input id="courrielEntreprise" class = "data" type="text" name="courrielEntreprise" value="courriel@entreprise.com"><br>


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
      <th>Adresse</th>

    </tr>
    

  <?php 
    showInternships($bdd);
    //récupère les stages dans la BD et les affiche dans le tableau
    function showInternships($bdd)
    {

      $query = $bdd->prepare("select Nom, concat (NumCivique, ' ' , Rue, ' ' , Province) as 'adresse' from vEntreprise");
      $query->execute(array());     
      $entrees = $query->fetchAll();
      
      foreach($entrees as $entree){
          $nomEntreprise = $entree["Nom"];
          $adresseEntreprise = $entree["adresse"];
          echo '<tr>
                  <th>' . $nomEntreprise . '</th>
                  <th>' . $adresseEntreprise . '</th>
                </tr>';

      }    
    } 
  ?>
    </table>
<!-- fin de section affichege de stages -->

  </body>
</html> 
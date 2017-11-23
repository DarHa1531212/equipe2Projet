<?php

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
                <select class="value">
                    <option>test</option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Stagiaire</p>
                <select class="value">
                    <option></option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Responsable</p>
                <select class="value">
                    <option></option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Superviseur</p>
                <select class="value">
                    <option></option>
                </select>
            </div>
            <div class="champ">
                <p class="label labelForInput">Enseignant</p>
                <select class="value">
                    <option></option>
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

    <!--afficher les inforations détaillées d'un stage -->
  <div id="readStage"></div>


	<form  action="insertion.php" method="POST">
		<h2>Créer un stage</h2>
		<br>
			<select id="stagiaire"  name="stagiaire" value="-1" class = "infosStage"  selected="selected">
					<option disabled="disabled" selected >Sélectionnez un stagiaire</option>
					<?php 

            <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Execute(1, \'../PHP/TBNavigation.php?idEmploye='.$id.'&nomMenu=Main\')"/>
            <input class="bouton" type="button" id="Save" style="width: 100px;" value="Sauvegarder"/>

            <br/><br/>
        </div>

        <div class="separateur">
            <h3>Liste des stages</h3>
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

  <!--onchange="Execute(7,'../PHP/TBNavigation.php?nomMenu=CRUDStage')" -->
       <select id="entreprise" name = "entreprise" class = "infosStage"  > 
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

?>





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
    join vSuperviseur on vSuperviseur.IdUtilisateur = vStage.IdSuperviseur
    join vEntreprise on vEntreprise.id = vSuperviseur.IdEntreprise;");
 
 
      $query->execute(array());     
      $entrees = $query->fetchAll();
      
      foreach($entrees as $entree){
          $nomStagiaire = $entree["Stagiaire"];
          $entreprise = $entree["Nom"];
          $idStage = $entree["Id"];
          echo '<tr>
                  <th id="' . $idStage .'" value="' . $idStage . '" onClick="Execute(8,\'../PHP/TBNavigation.php?nomMenu=CRUDStage\', this.id)">' . $nomStagiaire . '</th>
                  <th>' . $entreprise . '</th>
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
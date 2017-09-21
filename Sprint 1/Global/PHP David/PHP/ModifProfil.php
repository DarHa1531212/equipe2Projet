<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Modification du profil</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
		<link href="../CSS/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" media="screen and (max-width: 1240px)" href="../CSS/style-1240px.css" />
        <link rel="stylesheet" media="screen and (max-width: 1040px)" href="../CSS/style-1040px.css" />
        <link rel="stylesheet" media="screen and (max-width: 735px)" href="../CSS/style-735px.css" />
		<?php include'connexionBDTest.php'; ?>
		<?php include'vProfilStagiaire.php'; ?>
    </head>
    <body>
        <header class="bootstrap">
            <aside class="left">
                <a href="http://dicj.info">
                    <img id="logo" src="../Images/LogoDICJ2.png"/>
                </a>
            </aside>
            
            <div class="conteneur">
            
            </div>
            
            <aside class="right" id="profil">
                <a class="zoneCliquable" href="ProfilStagiaire.php">
                    <h3>Bonjour</h3>
                    <h3><?php echo $prenomStagiaire . ' ' . $nomStagiaire; ?></h3>
                </a>
            </aside>
        </header>
        
        <content>
            
            <div class="conteneur lolipop">
                <div class="entete">
                    <h1>Modification de votre profil</h1>
                </div>
                
                	<form class="form-horizontal" action="ModifBDStagiaire.php" method="POST">
						<div class="panel panel-default groupboxFormulaire">
						  <div class="panel-heading">Informations personnelles</div>
						  
						  <div class="panel-body">
							  
									<div class="col-md-6">
										
										  <div class="form-group">
											<label class="control-label col-sm-4" for="nom">Nom:</label>
											<div class="col-sm-5">
											  <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez votre nom" value=<?php echo'"' . $nomStagiaire . '"'; ?>>
											</div>
										  </div>
										  
										  <!--<div class="form-group">
											<label class="control-label col-sm-4 col-md-offset-2" for="nom">Numero de téléphone</label>
										  </div>-->
										  
										  
										  <div class="form-group">
											<label class="control-label col-sm-4" for="numeroCellulaire">Numero cellulaire :</label>
											<div class="col-sm-5"> 
											  <input type="text" class="form-control" name="numTelPersonnel" id="numeroCellulaire" placeholder="Entrez le numero de cellulaire" value=<?php echo'"' . $numTelPersonnelStagiaire . '"'; ?>>
											</div>
										  </div>
										  
										
									</div>
								
									<div class="col-md-6">
									
										<div class="form-group">
											<label class="control-label col-sm-4" for="prenom">Prenom:</label>
											<div class="col-sm-5">
											  <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Entrez votre nom" value=<?php echo'"' . $prenomStagiaire . '"'; ?>>
											</div>
										  </div>
										  
										  <!--<div class="form-group">
											<label class="control-label col-sm-4 col-md-offset-2" for="nom">Numero de téléphone</label>
										  </div>-->
										  
										  
										  <div class="form-group">
											<label class="control-label col-sm-4" for="numeroMaison">Numero maison :</label>
											<div class="col-sm-5"> 
											  <input type="text" class="form-control" name="numTelMaison" id="numeroMaison" placeholder="Entrez le numero de maison" value=<?php echo'"' . $numTelMaisonStagiaire . '"'; ?>>
											</div>
										  </div>
							
									</div>
								
							</div>
						  
						</div>
						
						<div class="panel panel-default groupboxFormulaire">
						  <div class="panel-heading">Informations entreprises</div>
						  
						  <div class="panel-body">
									<div class="col-md-6">
										
										  <div class="form-group">
											<label class="control-label col-sm-4" for="numeroEntreprise">Numero entreprise:</label>
											<div class="col-sm-5">
											  <input type="text" class="form-control" name="numTelEntreprise" id="numeroEntreprise" placeholder="Entrez le numero de l'entreprise" value=<?php echo'"' . $numTelEntrepriseStagiaire . '"'; ?>>
											</div>
										  </div>
										  
										  <!--<div class="form-group">
											<label class="control-label col-sm-4 col-md-offset-2" for="nom">Numero de téléphone</label>
										  </div>-->
										  
										  
										  <div class="form-group">
											<label class="control-label col-sm-4" for="courriel">Courriel :</label>
											<div class="col-sm-5"> 
											  <input type="email" class="form-control" name="courrielEntreprise" id="courriel" placeholder="Entrez le courriel" value=<?php echo'"' . $courrielEntrepriseStagiaire . '"'; ?>>
											</div>
										  </div>
										  
										
									</div>
								
									<div class="col-md-6">
									
										<div class="form-group">
											<label class="control-label col-sm-4" for="poste">Poste:</label>
											<div class="col-sm-5">
											  <input type="text" class="form-control" name="poste" id="poste" placeholder="Entrez votre poste" value=<?php echo'"' . $posteStagiaire . '"'; ?>>
											</div>
										 </div>
										  
										  <!--<div class="form-group">
											<label class="control-label col-sm-4 col-md-offset-2" for="nom">Numero de téléphone</label>
										  </div>-->
										  
									
							
									</div>
						  </div>
						  
						</div>
						
						<div class="panel panel-default groupboxFormulaire">
						  <div class="panel-heading">Modifier votre mot de passe</div>
						  
						  <div class="panel-body">
							<div class="col-md-6">
										
										  <div class="form-group">
											<label class="control-label col-sm-4" for="newPwd">Nouveau mot de passe:</label>
											<div class="col-sm-6">
											  <input type="password" class="form-control" name="newPwd" id="newPwd" placeholder="Entrez le nouveau mot de passe">
											</div>
										  </div>
										  
										  <!--<div class="form-group">
											<label class="control-label col-sm-4 col-md-offset-2" for="nom">Numero de téléphone</label>
										  </div>-->
										  
										  
										  <div class="form-group">
											<label class="control-label col-sm-4" for="confirmationNewPwd">Confirmer nouveau mot de passe:</label>
											<div class="col-sm-6">
											  <input type="password" class="form-control" name="confirmNewPwd" id="confirmationNewPwd" placeholder="Entrez le nouveau mot de passe">
											</div>
										  </div>
										  
										  
										  
										
							</div>
								
							<div class="col-md-2">
									
							
							</div>
							
							<div class="col-md-4" >
									
								<textarea rows="7" style="width:80%;" >
Condition de mot de passe   
        
- 8 caractères minimum
- Au moins une majuscule
- Au moins un chiffre(0-9)
								</textarea>
										
							</div>
							
							<button type="button" class="bouton" onClick="document.location.href='ProfilStagiaire.php';" >Annuler</button>
							<button type="submit" class="bouton" ocClick="document.location.href='ProfilStagiaire.php';">Sauvegarder</button>
							
						  </div>
						  
						</div>
						
						
					</form>
                   
                    
            </div>
         
        </content>
        
        <footer>
        
        </footer>
		
    </body>
</html>
<?php include 'Session.php'; ?>
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
        <link rel="shortcut icon" href="../Images/LogoDICJ2Petit.ico">
        <script src="../js/regexProfilStag.js"></script>

		<?php include 'ConnexionBD.php'; ?>
		<?php include'vProfil.php'; ?>
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
                <a class="zoneCliquable" href="Profil.php">
                    <h3>Bonjour</h3>
                    <h3><?php if (verifyTimeout()) { echo $_SESSION['PrenomConnecte'] . ' ' . $_SESSION['NomConnecte']; } ?></h3>
                </a>
            </aside>
        </header>
        
        <content>
            
            <div class="conteneur lolipop">
                <div class="entete">
                    <h1>Modification de votre profil</h1>
                </div>
                
                	<form action="ModifBDStagiaire.php" class="form-horizontal" method="POST">
						<div class="panel panel-default groupboxFormulaire">
						  <div class="panel-heading">Informations personnelles</div>
						  
						  <div class="panel-body">
							  
									<div class="col-md-6">
										
										  <div class="form-group">
											<label class="control-label col-sm-4" for="nom">Nom:</label>
											<div class="col-sm-5">
											  <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez votre nom" value=<?php echo'"' . $nom . '"'; ?> disabled> 
											</div>
										  </div>
										  
										  <!--<div class="form-group">
											<label class="control-label col-sm-4 col-md-offset-2" for="nom">Numero de téléphone</label>
										  </div>-->
										  
										  
										  <div class="form-group">
											<label class="control-label col-sm-4" for="numeroCellulaire">Numero de téléphone cellulaire :</label>
											<div class="col-sm-5"> 
											  <input type="text" class="form-control" name="numTelPersonnel" id="numeroCellulaire" onkeyup="RegexProfilStagiaire();" maxlength="14" placeholder="Entrez le numero de téléphone" value=<?php echo'"' . $numTel . '"'; ?>>Standard : (123) 123-1234
											</div>
										  </div>

										  <div class="form-group">
											<label class="control-label col-sm-4" for="courriel">Courriel personnel :</label>
											<div class="col-sm-5"> 
											  <input type="email" class="form-control" name="courrielPersonnel" id="courrielPersonnel" onkeyup="RegexProfilStagiaire();" placeholder="Entrez votre courriel" value=<?php echo'"' . $courrielPerso . '"'; ?>>
											</div>
										  </div>
										  
										
									</div>
								
									<div class="col-md-6">
									
										<div class="form-group">
											<label class="control-label col-sm-4" for="prenom">Prenom:</label>
											<div class="col-sm-5">
											  <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Entrez votre nom" value=<?php echo'"' . $prenom . '"'; ?> disabled>
											</div>
										  </div>
										  
										  <!--<div class="form-group">
											<label class="control-label col-sm-4 col-md-offset-2" for="nom">Numero de téléphone</label>
										  </div>-->
										  
										  
										  <!--<div class="form-group">
											<label class="control-label col-sm-4" for="numeroMaison">Numero de téléphone à la  maison :</label>
											<div class="col-sm-5"> 
											  <input type="text" class="form-control" name="numTelMaison" id="numeroMaison" onkeyup="RegexProfilStagiaire();" maxlength="14" placeholder="Entrez le numero de téléphone" value=<?php echo'"' . $numTelMaisonStagiaire . '"'; ?>>Standard : (123) 123-1234
											</div>
										  </div>-->

									</div>
								
							</div>
						  
						</div>
						
						<div class="panel panel-default groupboxFormulaire">
						  <div class="panel-heading">Informations entreprises</div>
						  
						  <div class="panel-body">
									<div class="col-md-6">
										
										  <div class="form-group">
											<label class="control-label col-sm-4" for="numeroEntreprise">Numero de téléphone:</label>
											<div class="col-sm-5">
											  <input type="text" class="form-control" name="numTelEntreprise" id="numeroEntreprise" onkeyup="RegexProfilStagiaire();" maxlength="14" placeholder="Entrez le numero de téléphone" value=<?php echo'"' . $numTelEntreprise . '"'; ?>>Standard : (123) 123-1234
											</div>
										  </div>
										  
										  <!--<div class="form-group">
											<label class="control-label col-sm-4 col-md-offset-2" for="nom">Numero de téléphone</label>
										  </div>-->
										  
										  
										  <div class="form-group">
											<label class="control-label col-sm-4" for="courriel">Courriel :</label>
											<div class="col-sm-5"> 
											  <input type="email" class="form-control" name="courrielEntreprise" id="courrielEntreprise" onkeyup="RegexProfilStagiaire();" placeholder="Entrez le courriel" value=<?php echo'"' . $courrielEntreprise . '"'; ?>>
											</div>
										  </div>
										  
										
									</div>
								
									<div class="col-md-6">
									
										<div class="form-group">
											<label class="control-label col-sm-4" for="poste">Poste:</label>
											<div class="col-sm-5">
											  <input type="text" class="form-control" name="poste" id="poste" onkeyup="RegexProfilStagiaire();" placeholder="Entrez votre poste" maxlength="7" value=<?php echo'"' . $poste . '"'; ?>>
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
											  <input type="password" class="form-control" name="newPwd" id="newPwd" onkeyup="RegexProfilStagiaire();" placeholder="Entrez le nouveau mot de passe">
											</div>
										  </div>
										  
										  <!--<div class="form-group">
											<label class="control-label col-sm-4 col-md-offset-2" for="nom">Numero de téléphone</label>
										  </div>-->
										  
										  
										  <div class="form-group">
											<label class="control-label col-sm-4" for="confirmationNewPwd">Confirmer nouveau mot de passe:</label>
											<div class="col-sm-6">
											  <input type="password" class="form-control" name="confirmNewPwd" id="confirmationNewPwd" onkeyup="RegexProfilStagiaire();" placeholder="Entrez le nouveau mot de passe">
											</div>
										  </div>
												
							</div>
								
							<div class="col-md-2">
									
							
							</div>
							
							<div class="col-md-4" >
									
								<textarea rows="7" style="width:80%;" disabled>
Condition de mot de passe   

- 8 caractères minimum
- Au moins une majuscule
- Au moins un chiffre(0-9)
								</textarea>
										
							</div>	
                            	<input type="submit" id="Save" class="bouton" value="Sauvegarder"/>
                            
	
						  </div>
						  
						</div>
						
					</form>
                    
                    <form action="profil.php" method="post">
                        <input type="submit" class="bouton" value="Annuler"/>
                    </form>
                    
            </div>
         
        </content>
        
        <footer>
        
        </footer>
		
    </body>
</html>
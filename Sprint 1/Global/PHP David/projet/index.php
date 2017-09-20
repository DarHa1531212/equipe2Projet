<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tableau de bord - Étudiant</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="CSS/style.css">
        <link rel="stylesheet" media="screen and (max-width: 1240px)" href="CSS/style-1240px.css" />
        <link rel="stylesheet" media="screen and (max-width: 1040px)" href="CSS/style-1040px.css" />
        <link rel="stylesheet" media="screen and (max-width: 735px)" href="CSS/style-735px.css" />
        <?php include 'PHP/connexionBDTest.php' ?>
        <?php include 'PHP/vProfilStagiaire.php' ?>
    </head>
    <body>
        <header>
            <aside class="left" id="dicj">
                <a href="http://dicj.info">
                    <img id="logo" src="Images/LogoDICJ2.png"/>
                </a>
            </aside>
            
            <div class="conteneur">
            
            </div>
            
            <aside class="right "id="profil">
                <a class="zoneCliquable" href="PHP/ProfilStagiaire.php">
                    <h3>Bonjour</h3>
                    <h3><?php echo $prenomStagiaire . ' ' . $nomStagiaire; ?></h3>
                </a>
            </aside>
        </header>
        
        <content>
            <div class="conteneur">
                <div class="entete">
                    <h1>Ressources</h1>
                </div>
                
                <ul class="item">
                    <li>Cahier stagiaire 2017.pdf</li>
                    <li>Lettre d'entente 2017.pdf</li>
                </ul>
            </div>
            
            <div class="conteneur">
                <div class="entete">
                    <h1>Informations</h1>
                </div>
                
                <div class="infoStagiaire">
                    <div class="zoneProfil">
                            <div class="element">
                                <div class="entete">
                                    <h2>Stagiaire</h2>
                                </div>

                                <a class="zoneCliquable" href="PHP/ProfilStagiaire.php">
                                    <p><?php echo $prenomStagiaire . ' ' . $nomStagiaire; ?></p>
                                    <p><?php echo $numTelPersonnelStagiaire; ?></p>
                                </a>
                            </div>

                            <div class="element">
                                <div class="entete">
                                    <h2>Superviseur</h2>
                                </div>

                                <div class="infoProfil">
                                    <a class="zoneCliquable" href="PHP/ProfilSuperviseur.php">
                                        <p>Martin Mystère</p>
                                        <p>(418) 666-7777</p>
                                    </a>
                                </div>
                            </div>

                            <div class="element">
                                <div class="entete">
                                    <h2>Enseignant</h2>
                                </div>

                                <div class="infoProfil">
                                    <a class="zoneCliquable" href="ProfilEntreprise.html">
                                        <p>Martin Mystère</p>
                                        <p>(418) 666-7777</p>
                                    </a>
                                </div>
                            </div>
                    </div>
                    
                    <div class="evaluation">
                        <table class="table" class="tableauEvaluation">
							<thead>
								<tr>
									<th>
										Rapport
									</th>
									<th>
										Statut
									</th>
									<th>
										Date début
									</th>
									<th>
										Date limite
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										Rapport 1
									</td>
									<td>
										Complétée
									</td>
									<td>
								        2017-09-07
									</td>
									<td>
										2017-12-07
									</td>
								</tr>
								<tr>
									<td>
										Rapport 2
									</td>
									<td>
										Non complétée
									</td>
									<td>
										2018-01-15
									</td>
									<td>
										2018-03-15
									</td>
								</tr>
							</tbody>
						</table>
                    </div>
                    
                    <div class="evaluation">
                        <table class="table" class="tableauEvaluation">
							<thead>
								<tr>
									<th>
										Autre
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										Auto-Évaluation
									</td>
								</tr>
								<tr>
									<td>
                                        <a href="JournalBord.html" class="zoneCliquable">
                                            Journal de bord
                                        </a>
									</td>
								</tr>
							</tbody>
						</table>
                    </div>
                </div>
            </div>
        </content>
        
        <footer>
        
        </footer>
    </body>
</html>
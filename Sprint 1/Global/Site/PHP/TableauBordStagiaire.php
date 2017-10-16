<?php 
    if(session_id() == '' || !isset($_SESSION))
    {
        session_start();
    }
 ?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tableau de bord - Étudiant</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" media="screen and (max-width: 1240px)" href="CSS/style-1240px.css" />
        <link rel="stylesheet" media="screen and (max-width: 1040px)" href="CSS/style-1040px.css" />
        <link rel="stylesheet" media="screen and (max-width: 735px)" href="CSS/style-735px.css" />
        <link rel="shortcut icon" href="../Images/LogoDICJ2Petit.ico">
        <?php include 'vTableauBord.php' ?>
    </head>
    <body>
        <header>
                <aside class="left" id="dicj">
                    <a href="http://dicj.info">
                        <img id="logo" src="../Images/LogoDICJ2.png"/>
                    </a>
                </aside>
            
            <div class="conteneur">
            
            </div>
            
            <aside class="right "id="profil">
                <a class="zoneCliquable" href="ProfilStagiaire.php">
                    <h3>Bonjour</h3>
                    <h3><?php echo $_SESSION['PrenomConnecte'] . ' ' . $_SESSION['NomConnecte']; ?></h3>
                </a>
            </aside>
        </header>
        
        <content>
            <div class="conteneur">
                <div class="entete">
                    <h1>Ressources</h1>
                </div>
                
                <ul class="item">
                    <li><a href="../PDF/Cahier%20stagiaire%202017.pdf">Cahier stagiaire 2017.pdf</a></li>
                    <li><a href="../PDF/Lettre%20d'entente%202017.docx">Lettre d'entente 2017.docx</a></li>
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

                                <form action="ProfilStagiaire.php" method="post">
                                    <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                        <input type="hidden" value="<?php echo $idStagiaire; ?>" name="idStagiaire"/>
                                        <p><?php echo $prenomStagiaire." ".$nomStagiaire; ?></p>
                                        <p><?php echo $telPerso; ?></p>
                                    </a>
                                </form>
                            </div>

                            <div class="element">
                                <div class="entete">
                                    <h2>Superviseur</h2>
                                </div>

                                <div class="infoProfil">
                                    <form action="ProfilSuperviseur.php" method="post">
                                        <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                            <input type="hidden" value="<?php echo $idSup; ?>" name="idSuperviseur"/>
                                            <p><?php echo $prenomSup." ".$nomSup; ?></p>
                                            <p><?php echo $cellSup; ?></p>
                                        </a>
                                    </form>
                                </div>
                            </div>

                            <div class="element">
                                <div class="entete">
                                    <h2>Enseignant</h2>
                                </div>

                                <div class="infoProfil">
                                    <form action="ProfilEnseignant.php" method="post">
                                        <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                            <input type="hidden" value="<?php echo $idProf; ?>" name="idProf"/>
                                            <p><?php echo $prenomProf." ".$nomProf; ?></p>
                                            <p><?php echo $telProf; ?></p>
                                        </a>
                                    </form>
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
                                        <form action="JournalBord.php" method="post">
                                            <a class="zoneCliquable" href="javascript:;" onclick="parentNode.submit();">
                                                <input type="hidden" value="<?php echo $idStagiaire; ?>" name="idStagiaire"/>
                                                Journal de bord
                                            </a>
                                        </form>
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
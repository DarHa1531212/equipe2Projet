<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Profil</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="../CSS/style.css">
        <?php include 'connexionBDTest.php' ?>
        <?php include 'vProfilStagiaire.php' ?>
    </head>
    <body>
        <header>
            <aside class="left">
                <a href="http://dicj.info">
                    <img id="logo" src="../Images/LogoDICJ2.png"/>
                </a>
            </aside>
            
            <div class="conteneur">
            
            </div>
            
            <aside class="right" id="profil">
                <a class="zoneCliquable" href="ProfilSuperviseur.php">
                    <h3>Bonjour</h3>
                    <h3><?php echo $prenom . ' ' . $nom; ?></h3>
                </a>
            </aside>
        </header>
        
        <content>
            <div class="conteneur">
                <div class="entete" >   
                    <h1>Profil Stagiaire</h1>
                </div>
                
                <div class="content">
                    <input class="bouton" id="retourTBL" value="Retour au tableau de bord" onClick="document.location.href='../index.php';" type="button"/>
                    <div class="containerInfoProfil">  
                        <div class="bordureBleu">
                        
                        </div>
                        
                        <div class="contentInfo">
                            <div class="infoPerso">
                                <p>
                                    <?php echo $prenom . ' ' . $nom ?><br/>
                                    Stagiaire Cégep Jonquière<br/><br/>
                                    Téléphone : <?php echo $numTelMaison ?><br/>
                                    Cellulaire : <?php echo $numTelPersonnel ?><br/><br/>
                                    Courriel personnel : <?php echo $courrielPersonnel ?><br/>
                                    Courriel étudiant : <?php echo $courrielScolaire ?>
                                </p>
                            </div>

                            <div class="infoPerso">
                                <p>
                                    <br/><br/>
                                    Téléphone : <?php echo $numTelEntreprise ?><br/>
                                    Poste : <?php echo $poste ?><br/><br/>
                                    Courriel : <?php echo $courrielEntreprise ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="commentaireContainer">
                        <input class="bouton" id="boutonProfilStagiaire" value="Modifier" onClick="document.location.href='ModifProfil.php';" type="button"/>
                    </div>
                </div>
            </div>
        </content>
        
        <footer>
        
        </footer>
    </body>
</html>

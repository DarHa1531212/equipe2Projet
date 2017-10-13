<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Profil</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="shortcut icon" href="../Images/LogoDICJ2Petit.ico">
        <?php include 'ConnexionBDLocal.php'; ?>
        <?php include 'vProfilStagiaire.php' ?>
        <?php include 'vProfilEntreprise.php' ?>
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
                <a class="zoneCliquable" href="ProfilEntreprise.php">
                    <h3>Bonjour</h3>
                    <h3><?php echo $prenomStagiaire . ' ' . $nomStagiaire; ?></h3>
                </a>
            </aside>
        </header>
        
        <content>
            <div class="conteneur">
                <div class="entete" >   
                    <h1>Profil de l'entreprise</h1>
                </div>
                
                <div class="content">
                    <input class="bouton" id="retourTBL" value="Retour au tableau de bord" onClick="document.location.href='TableauBordStagiaire.php';" type="button"/>
                    <div class="containerInfoProfil">  
                        <div class="bordureBleu">
                        
                        </div>
                        
                        <div class="contentInfo">
                            <div class="infoPersoEntreprise">
                                <p><br/>
                                    <?php echo $nomEntreprise?><br/><br/>
                                    <br/><br/>
                                    Téléphone : <?php echo $numTelEntreprise ?><br/><br/>
                                    Courriel de l'entreprise : <?php echo $courrielEntrepriseEnt ?><br/><br/>
                                    Adresse : <?php echo $numCivique . ' ' . $rue . ' ' . $ville . ' ' . $province;?><br/><br/>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </content>
        
        <footer>
        
        </footer>
    </body>
</html>

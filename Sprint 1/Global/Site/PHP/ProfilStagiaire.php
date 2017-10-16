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
        <title>Profil</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="shortcut icon" href="../Images/LogoDICJ2Petit.ico">
        <?php include 'ConnexionBD.php'; ?>
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
                <a class="zoneCliquable" href="ProfilStagiaire.php">
                    <h3>Bonjour</h3>
                    <h3><?php echo $_SESSION['PrenomConnecte'] . ' ' . $_SESSION['NomConnecte']; ?></h3>
                </a>
            </aside>
        </header>
        
        <content>
            <div class="conteneur">
                <div class="entete" >   
                    <h1>Profil Stagiaire</h1>
                </div>
                
                <div class="content">
                    
                    <form action="TableauBordStagiaire.php" method="POST">
                        <input class="bouton" id="retourTBL" value="Retour au tableau de bord" type="submit"/>
                    </form>
                    
                    <div class="containerInfoProfil">  
                        <div class="bordureBleu">
                        
                        </div>
                        
                        <div class="contentInfo">
                            <div class="infoPerso">
                                <p>
                                    <?php echo $prenomStagiaire . ' ' . $nomStagiaire ?><br/>
                                    Stagiaire Cégep Jonquière<br/><br/>
                                    Téléphone : <?php echo $numTelMaisonStagiaire ?><br/>
                                    Cellulaire : <?php echo $numTelPersonnelStagiaire ?><br/><br/>
                                    Courriel personnel : <?php echo $courrielPersonnelStagiaire ?><br/>
                                    Courriel étudiant : <?php echo $courrielScolaireStagiaire ?>
                                </p>
                            </div>

                            <div class="infoPerso">
                                <p>
                                    <h4>Informations Professionnelles</h4>
                                    Téléphone : <?php echo $numTelEntrepriseStagiaire?>
                                    <span class="poste">Poste : <?php echo $posteStagiaire ?></span><br/><br/>
                                    Courriel : <?php echo $courrielEntrepriseStagiaire ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="commentaireContainer">
                        <?php if($_SESSION['RoleConnecte'] == 'Stagiaire')
                        {
                            echo '<form action="ModifProfil.php" method="post">
                                    <input type="hidden" name="idStagiaire" value="<?php echo $idStagiaire; ?>"/>
                                    <input class="bouton" id="boutonProfilStagiaire" value="Modifier" type="submit"/>
                                </form>';
                        } 

                        ?>
                                               
                    </div>
                </div>
            </div>
        </content>
        
        <footer>
        
        </footer>
    </body>
</html>
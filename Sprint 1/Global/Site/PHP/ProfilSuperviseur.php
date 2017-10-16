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
        <?php include 'connexionBDTest.php' ?>
        <?php include 'vProfilEmployeEntreprise.php' ?>
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
                <a class="zoneCliquable" href="<?php if($_SESSION['RoleConnecte'] == 'Stagiaire'){echo'ProfilStagiaire.php';}else{} ?>">
                    <h3>Bonjour</h3>
<<<<<<< HEAD
                    <h3><?php echo $_SESSION['PrenomConnecte'] . ' ' . $_SESSION['NomConnecte']; ?></h3>
=======
                    <h3>Martin Mystère</h3>
>>>>>>> 2eab736c45c47d1d130320a4d72aea76897f0b6d
                </a>
            </aside>
        </header>
        
        <content>
            <div class="conteneur">
                <div class="entete" >   
                    <h1>Profil Superviseur</h1>
                </div>
                
                <div class="content">
                    <input class="bouton" id="retourTBL" value="Retour au tableau de bord" onClick="document.location.href='<?php if($_SESSION['RoleConnecte'] == 'Stagiaire'){echo'TableauBordStagiaire.php';}else{echo'TBEntreprise.php';} ?>';" type="button"/>
                    <div class="containerInfoProfil">  
                        <div class="bordureBleu">
                        
                        </div>
                        
                        <div class="contentInfo">
                            <div class="infoPerso">
                                <p>
<<<<<<< HEAD
                                    <?php echo $prenomSup . ' ' . $nomSup . '   '; //. $posteEmploi? ?><br/><br/>
=======
                                    <?php echo $prenomSup . ' ' . $nomSup . '   '; //. $posteEmploi??><br/><br/>
>>>>>>> 2eab736c45c47d1d130320a4d72aea76897f0b6d
                                    Employé de (<?php echo $nomEntrepriseSup ?>)<br/><br/>
                                    Cellulaire : <?php echo $numTelCellSup ?><br/><br/>
                                    Courriel personnel : <?php echo $courrielPersonnelSup ?><br/>
                                </p>
                            </div>
                            
                            <div class="infoPerso">
                                <p>
                                    Informations professionnelles
                                    <br/><br/>
                                    Téléphone : <?php echo $numTelEntrepriseSup ?><br/>
                                    Poste : <?php echo $posteSup ?><br/><br/>
                                    Courriel : <?php echo $courrielEntrepriseSup ?>
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
